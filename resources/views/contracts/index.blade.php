@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <div class="row">
                <div class="col-md-6">
                    <h4>Contract alerts</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('contract.create')}}"><button class="dt-button float-right"><span><i class="fa fa-plus"></i></span></button></a>
                </div>
            </div>
            <hr>
            @include('inc.messages')
                       <!--<th scope="col">SUPPLIER</th>
                        <th scope="col">REFERENCE</th>
                        <th scope="col">ALERT DATE</th>
                        <th scope="col">PRIMARY CONTACT</th>
                        <th scope="col">END DATE</th>
                        <th scope="col">CONTRACT VALUE</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">FILES</th>
                        <th scope="col">ACTIONS</th>-->
                        <table class="table table-striped" id="myTable">
                            <thead>
                              <tr>
                                    <th scope="col">SUPPLIER</th>
                                    <th scope="col">REFERENCE</th>
                                    <th scope="col">ALERT DATE</th>
                                    <th scope="col">PRIMARY CONTACT</th>
                                    <th scope="col">END DATE</th>
                                    <th scope="col">CONTRACT VALUE</th>
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
                                <td>{{$contract_alert->alert_date}}</td>
                                <td>{{$contract_alert->primary_contact}}</td>
                                <td>{{$contract_alert->end_date}}</td>
                                <td>{{$contract_alert->contract_value}}</td>
                                <td>{{$contract_alert->category}}</td>
                                <td>
                                    @if(!is_null($contract_alert->file))
                                    <a href="../storage/files/{{$contract_alert->file}}"><i class="fa fa-paperclip"></i> Download</a>
                                    @else
                                    <i class="fa fa-paperclip"></i> No file
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('contract.show', $contract_alert)}}" title="view"><span><i class="fa fa-eye"></i></span></a>
                                </td>
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
