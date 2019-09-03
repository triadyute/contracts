<?php

namespace App\Http\Controllers;

use App\ContractCategory;
use Illuminate\Http\Request;

class ContractCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ContractCategory::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = request()->validate([
        'category' => 'string|max:255',
        ]);
        //return $validated_data;
        $category = ContractCategory::create($validated_data);
        $category->save();
        return redirect()->action('ContractCategoryController@index')->with('status', 'Category added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContractCategory  $contractCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ContractCategory $contractCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContractCategory  $contractCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContractCategory  $contractCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContractCategory $category)
    {
        request()->validate([
            'category' => 'string|max:255',
            ]);
            $category->category = empty(request()->category) ? $category->category : request()->category;
            $category->save();
            return redirect()->action('ContractCategoryController@index')->with('status', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContractCategory  $contractCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractCategory $contractCategory)
    {
        //
    }
}
