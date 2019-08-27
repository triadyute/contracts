<?php

namespace App\Http\Controllers;

use App\Contract;
use App\ContractCategory;
use App\User;
use App\ChangeLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\CalendarLinks\Link;
use Carbon\Carbon;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contract_alerts = Contract::all();
        return view('contracts.index', compact('contract_alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = ContractCategory::all();
        return view('contracts.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());
        $validated_data = request()->validate([
            'supplier' => 'string|max:255',
            'alert_date' => 'date',
            'primary_contact' => 'integer',
            'reference' => 'string|max:255',
            'add_to_calendar' => 'nullable|boolean',
            'category' => 'nullable|string',
            'currency' => 'nullable|string',
            'contract_value' => 'nullable|string',
            'contract_period' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'notice_period' => 'nullable|string',
            'end_date' => 'nullable|date',
            'no_end_date' => 'nullable|boolean',
            //'visible_to' => 'nullable|array',
            'secondary_contact' => 'nullable|integer',
            'notes' => 'nullable|string',
            'file' => 'nullable|mimes:doc,docx,pdf|max:2048',
         ]);

         $contract = Contract::create($validated_data);
            $user = User::find($contract->primary_contact);
            if (request()->add_to_calendar == true) {
                $from = Carbon::parse($contract->alert_date);
                $to = Carbon::parse($contract->alert_date);
                //return $from;
                
                $link = Link::create('Contract Alert for ' . $contract->supplier, $from, $to)
                ->description("Supplier: $contract->supplier\nAlert date: $contract->alert_date\nCategory: $contract->category\nContract value: $contract->contract_value/$contract->contract_period\nEnd date: $contract->end_date\nPrimary Contact: $user->email");
                $contract->link = $link->ics();
                $contract->google_link = $link->google();
            }

            if(request()->visible_to == ['all_users']){
                $contract->visible_to = request()->visible_to;
            }
            elseif (request()->visible_to != 'all_users')
            {
                $contract->requires_special_privileges = true;
                $users = request()->visible_to;
                array_push($users,  (string)Auth::user()->id);
                //return $users;
                foreach ($users as $user){
                    $specialprivileges = ContractUser::create();
                    $specialprivileges->user_id = $user;
                    $specialprivileges->contract_id = $contract->id;
                    $specialprivileges->save();
                }
            }

            if(!is_null(request()->file))
            {
                $fileNameWithExt = $request->file('file')->getClientOriginalName();
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('file')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
                ///return $path;
                $contract->file = $fileNameToStore;
            }
            $contract->created_by = Auth::user()->id;
            $contract->company_id = Auth::user()->company_id;
            $contract->save();
            $changelog = Changelog::create();
            $changelog->contract_id = $contract->id;
            $changelog->changes = 'Alert created';
            $changelog->changed_by = Auth::user()->name;
            $changelog->save();

            return redirect()->action('ContractController@index')->with('status', 'Contract alert added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract, ChangeLog $changelog)
    {
       $changelog = ChangeLog::where('contract_id', $contract->id)->get();
       $contract->primary_contact = User::find($contract->primary_contact);
       $contract->secondary_contact = User::find($contract->secondary_contact);
       return view('contracts.show', compact('contract', 'changelog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $users = User::all();
        $categories = ContractCategory::all();
        return view('contracts.edit', compact('contract', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
