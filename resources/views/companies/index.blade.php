@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <h4>Companies</h4>
            <hr>
            @include('inc.messages')
            <table class="table myTable" id="myTable">
                <thead>
                    <tr>
                        <th>
                            Company Name
                        </th>
                        <th>
                            Sector
                        </th>
                        <th class="text-center">
                            Number of employees
                        </th>
                        <th class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>
                            {{$company->company_name}}
                        </td>
                        <td>
                            {{$company->sector}}
                        </td>
                        <td class="text-center">
                            {{$company->number_of_employees}}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('company.edit', $company) }}"><i class="fa fa-edit" style="margin-right: .75em;" title="edit"></i></a>
                            <a href="#"><i class="fa fa-trash" style="margin-right: .75em;" title="delete"></i></a>
                            <a href="{{route('company.show', $company)}}"><i class="fa fa-info" style="margin-right: .75em;" title="info"></i></a>
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
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
@endsection