@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <h3>Edit contract alert</h3>
            <form method="POST" action="/contract" enctype="multipart/form-data">
                @include('inc.messages')
                @csrf
                <h5>Alert information</h5>
                <hr>
                <div class="row">
                    <div class="form-group-sm col-md-3">
                        <label for="supplier">Supplier</label>
                        <input type="text" class="form-control" name="supplier" id="supplier" value="{{$contract->supplier}}">
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group col-md-2">
                        <label for="supplier">Alert date</label>
                        <input type="text" class="form-control" name="alert_date" id="supplier" value="{{$contract->alert_date}}">
                    </div>
                    <div class="form-group col-md-3 service-small">
                        <label for="primary_contact">Primary Contact</label>
                        <select name="primary_contact" class="form-control" id="primary_contact">
                            <option value="" selected disabled>Select contact</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($contract->primary_contact->name == $user->name) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Reference #</label>
                        <input type="text" class="form-control" name="reference" id="exampleInputPassword1" value="{{$contract->reference}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="form-check-label" for="add_to_calendar">
                            <input type="checkbox" value="1" name="add_to_calendar" id="add_to_calendar">
                            Add as a Calendar Appointment
                        </label>
                    </div>
                </div>
                <h5>Contract information</h5>
                <hr>
                <div class="row">
                    <div class="form-group col-md-3 service-small">
                        <label for="category">Category</label>
                        <select class="form-control" name="category" id="currency" required>
                            <option selected disabled>-- no category --</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category}}" @if ($contract->category == $category->category) selected @endif>{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1.5  service-small">
                        <label for="currency">Contract value</label>
                        <select class="form-control" name="currency" id="currency" required>
                            <option value="usd"  @if ($contract->currency == 'usd') selected @endif>USD&nbsp;&nbsp;</option>
                            <option value="gbp" @if ($contract->currency == 'gbp') selected @endif>GBP</option>
                            <option value="eur" @if ($contract->currency == 'eur') selected @endif>EUR</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 no-label">
                        <input type="text" class="form-control" name="contract_value" value="{{$contract->contract_value}}" required />
                    </div>
                    <div class="form-group col-md-1.5 no-label service-small">
                        <select class="form-control service-small" name="contract_period" required>
                            <option value="yearly" @if ($contract->contract_period == 'yearly') selected @endif>per year</option>
                            <option value="weekly" @if ($contract->contract_period == 'weekly') selected @endif>per week</option>
                            <option value="monthly" @if ($contract->contract_period == 'monthly') selected @endif>per month</option>
                            <option value="quarterly" @if ($contract->contract_period == 'quarterly') selected @endif>per quarter</option>
                            <option value="biannually" @if ($contract->contract_period == 'biannually') selected @endif>per half year</option>
                            <option value="biennially" @if ($contract->contract_period == 'biennially') selected @endif>per two years</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="start_date">Start date</label>
                        <input type="text" class="form-control" name="start_date" id="start_date" value="{{$contract->start_date}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="end_date">End date</label>
                        <input type="text" class="form-control" name="end_date" id="end_date" placeholder="Alert date"value="{{$contract->end_date}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 service-small">
                        <label for="notice_period">Notice Period</label>
                        <select class="form-control service-small" name="notice_period" required>
                            <option value="1 month" @if ($contract->notice_period == '1 month') selected @endif>1 month</option>
                            <option value="2 months" @if ($contract->notice_period == '2 months') selected @endif>2 months</option>
                            <option value="3 months" @if ($contract->notice_period == '3 months') selected @endif>3 months</option>
                            <option value="6 months" @if ($contract->notice_period == '6 months') selected @endif>6 months</option>
                            <option value="12 moths" @if ($contract->notice_period == '12 months') selected @endif>12 months</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-check-label no-label-checkbox" for="no-end-date">
                            <input type="checkbox" value="1" name="no_end_date" id="indefinite">
                            Indefinite (No end date)
                        </label>
                    </div>
                </div>
                <h5>Contract information</h5>
                <hr>
                <div class="row">
                        <div class="form-group col-md-3">
                            <label for="visible_to">This contract will only be visible to</label>
                            <select name="visible_to[]" class="form-control" id="" multiple>
                                <option value="all_users" selected>All users</option>
                                @foreach($users->except(Auth::user()->id) as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 service-small">
                            <label for="secondary_contact">Secondary contact</label>
                            <select name="secondary_contact" class="form-control" id="secondary_contact">
                                <option value="" selected disabled>Select contact</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}" @if($contract->secondary_contact->name == $user->name) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 service-small">
                            <label for="notes">Notes</label>
                            <input type="text" class="form-control" name="notes" value="{{$contract->notes}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="file">Upload file</label>
                            <input type="file" name="file" id="file">
                        </div>
                        <div id="myId"></div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>
@endsection    
@endsection