@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="display:inline-block" class="pull-left">Contract Details</h4>
                    @can('manage-contract')
                        <div style="display:inline-block" class="pull-right"><a href="{{route('contract.edit', $contract)}}"><button class="btn btn-primary">Edit contract alert</button></a></div>
                    @endcan
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <strong>Contract ID:</strong> {{$contract->id}}<br>
                        <strong>Reference #:</strong> {{$contract->reference}}<br>
                        <strong>Supplier:</strong> {{$contract->supplier}}<br>
                        <strong>Alert date:</strong> {{Carbon\Carbon::parse($contract->alert_date)->toFormattedDateString()}}<br>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Contract Period:</strong> {{ucfirst($contract->contract_period)}} <br>
                        <strong>Start date:</strong> {{Carbon\Carbon::parse($contract->start_date)->toFormattedDateString()}}<br>
                        <strong>End date:</strong> {{Carbon\Carbon::parse($contract->end_date)->toFormattedDateString()}} <br>
                        <strong>Notice period:</strong> {{$contract->notice_period}}
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Contract Value:</strong> ${{ucfirst($contract->contract_value)}} <br>
                        <strong>Category:</strong> {{$contract->category}} <br>
                        <strong>Primary contact:</strong> {{$contract->primary_contact->name}} <br>
                        <strong>Secondary contact:</strong> {{$contract->secondary_contact->name}}
                    </p>
                </div>
            </div>
            <h4>Changelog</h4>
            <table class="table table-striped">
                <thead  class="">
                    <th>ID</th>
                    <th>Changed by</th>
                    <th>Changes</th>
                    <th>Date</th>
                </thead>
                <tbody>
                    @foreach($changelog as $changes)
                        <tr class="">
                            <td>{{$changes->id}}</td>
                            <td>{{$changes->changed_by}}</td>
                            <td>                    
                                
                                    @if(is_array($changes->changes))
                                    <ul style="margin-left:-2.5em;">
                                    @foreach($changes->changes as $change)
                                    <li>{{ucfirst($change)}}</li>
                                    @endforeach
                                    </ul>
                                    @else
                                    {{$changes->changes}}
                                    @endif
                                
                            </td>
                            <td>{{Carbon\Carbon::parse($changes->created_at)->toFormattedDateString()}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
