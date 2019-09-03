@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <div class="row">
                <div class="col-md-6">
                    <h4>My profile</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('users.edit', $user)}}"><span class="float-right"><button class="btn btn-primary btn-sm add-btn"><i class="fa fa-user"></i> Edit profile</button></span></a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="" height="100">
                </div>
                <div class="col-md-3">
                   <p>Name: {{$user->name}}</p>
                   <p>Email: {{$user->email}}</p>
                   <p>Company: {{$user->company->company_name}}</p>
                </div>
                <div class="col-md-3">
                    <p>Account created: {{$user->created_at}}</p>
                    <p>Role: </p>
                    <p>Company: </p>
                 </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                        <h4 style="margin-top:2em;">My Contract Alerts</h4>
                        <hr>
                        <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">SUPPLIER</th>
                                <th scope="col">REFERENCE</th>
                                <th scope="col">ALERT DATE</th>
                                <th scope="col">PRIMARY CONTACT</th>
                                <th scope="col">END DATE</th>
                                <th scope="col">CONTRACT VAL.</th>
                                <th scope="col">CATEGORY</th>
                                <th scope="col">FILES</th>
                                <th scope="col">ACTIONS</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($contract_alerts as $contract_alert)
                                <tr>
                                <td>{{$contract_alert->supplier}}</td>
                                <td>{{$contract_alert->reference}}</td>
                                <td>{{\Carbon\Carbon::parse($contract_alert->alert_date)->toFormattedDateString()}}</td>
                                <td>{{$contract_alert->primary_contact->name}}</td>
                                <td>{{\Carbon\Carbon::parse($contract_alert->end_date)->toFormattedDateString()}}</td>
                                <td>
                                    @if($contract_alert->currency == "usd")
                                    &dollar;
                                    @elseif($contract_alert->currency == "eur")
                                    &euro;
                                    @elseif($contract_alert->currency == "gbp")
                                    &pound;
                                    @endif
                                    {{$contract_alert->contract_value}}
                                </td>
                                <td>{{$contract_alert->category}}</td>
                                <td>
                                    @if(!is_null($contract_alert->file))
                                    <a href="../storage/files/{{$contract_alert->file}}"><i class="fa fa-paperclip"></i> Download</a>
                                    @else
                                    <i class="fa fa-paperclip"></i> No file
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('contract.show', $contract_alert)}}"><i class="fa fa-info-circle" style="margin-right: .75em;"  title="view"></i></a>
                                    <a href="{{route('contract.edit', $contract_alert)}}"><i class="fa fa-edit" style="margin-right: .75em;" title="edit"></i></a>
                                    <a href="#" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" title="delete"></i></a>

                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    } );
</script>
@endsection    
@endsection