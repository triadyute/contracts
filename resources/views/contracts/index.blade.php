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
                    <a href="{{route('contract.create')}}"><span class="float-right"><button class="btn btn-primary btn-sm add-btn"><i class="fa fa-plus"></i> New contract alert</button></span></a>
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
                                    <th scope="col">CONTRACT VAL.</th>
                                    <th scope="col">CATEGORY</th>
                                    <th scope="col">FILES</th>
                                    <th scope="col">ACTIONS</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($contracts as $contract)
                              <tr>
                                <td>{{$contract->supplier}}</td>
                                <td>{{$contract->reference}}</td>
                                <td>{{\Carbon\Carbon::parse($contract->alert_date)->toFormattedDateString()}}</td>
                                <td>{{$contract->primary_contact->name}}</td>
                                <td>{{\Carbon\Carbon::parse($contract->end_date)->toFormattedDateString()}}</td>
                                <td>
                                    @if($contract->currency == "usd")
                                    &dollar;
                                    @elseif($contract->currency == "eur")
                                    &euro;
                                    @elseif($contract->currency == "gbp")
                                    &pound;
                                    @endif
                                    {{$contract->contract_value.' '.$contract->contract_period}}
                                </td>
                                <td>{{$contract->category}}</td>
                                <td>
                                    @if(!is_null($contract->file))
                                    <a href="../storage/files/{{$contract->file}}"><i class="fa fa-paperclip"></i> Download</a>
                                    @else
                                    <i class="fa fa-paperclip"></i> No file
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('contract.show', $contract)}}"><i class="fa fa-info-circle" style="margin-right: .75em;"  title="view"></i></a>
                                    <a href="{{route('contract.edit', $contract)}}"><i class="fa fa-edit" style="margin-right: .75em;" title="edit"></i></a>
                                    <form method="POST" action="{{route('contract.destroy', $contract)}}" class="user-delete" style="display:inline;">
                                        @csrf 
                                        @method('DELETE')
                                        <a href="#"><button type="submit" class="text-primary" style="padding:0; background:transparent; border:0; position:relative; top: -1px;" onclick="return confirm('Are you sure?')"><i class="fa fa-user-times" style="display:inline;" title="delete"></i></button></a>
                                    </form>

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
