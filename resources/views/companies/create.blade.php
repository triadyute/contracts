@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <h4>Companies</h4>
            <hr>
            @include('inc.messages')
            <form method="POST" action="{{ route('company.store') }}" aria-label="{{ __('Company') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
            
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required autofocus>
            
                            @if ($errors->has('company_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sector" class="col-md-4 col-form-label text-md-right">{{ __('Sector') }}</label>
                        <div class="col-md-6">
                            <select name="sector" class="form-control" id="">
                                <option selected disabled>Select a sector</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Automobiles">Automobiles</option>
                                <option value="Banks">Banks</option>
                                <option value="Capital Goods">Capital Goods</option>
                                <option value="Commercial Services">Commercial Services</option>
                                <option value="Consumer Durables">Consumer Durables</option>
                                <option value="Diversified Financials">Diversified Financials</option>
                                <option value="Energy">Energy</option>
                                <option value="Food & Beverage">Food & Beverage</option>
                                <option value="Government">Government</option>
                                <option value="Health Care">Health Care</option>
                                <option value="Hotels, Restaurants & Leisure">Hotels, Restaurants & Leisure</option>
                                <option value="Household & Personal Products">Household & Personal Products</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Materials">Materials</option>
                                <option value="Media">Media</option>
                                <option value="Pharmaceuticals & Biotechnology">Pharmaceuticals & Biotechnology</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Retail staples">Retail staples</option>
                                <option value="Retailing">Retailing</option>
                                <option value="Semiconductors">Semiconductors</option>
                                <option value="Software & Services">Software & Services</option>
                                <option value="Technology Hardware">Technology Hardware</option>
                                <option value="Telecommunication">Telecommunication</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Utilities">Utilities</option>
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Number of employees') }}</label>
                        <div class="col-md-6">
                            <select name="number_of_employees" class="form-control" id="">
                                <option selected disabled>Select</option>
                                <option value="1 - 10">1 - 10</option>
                                <option value="11 - 50">11 - 50</option>
                                <option value="51 -250">51 -250</option>
                                <option value="251 - 1000">251 - 1000</option>
                                <option value="Over 1000">Over 1000</option>
                            </select>
                        </div>
                    </div>
            
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" style="margin-left:2em;">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
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