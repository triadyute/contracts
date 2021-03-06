@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <h3>Add contract alert</h3>
            <hr>
            <form method="POST" action="/contract" enctype="multipart/form-data" autocomplete="off">
                @include('inc.messages')
                @csrf
                <h5>Alert information</h5>
                <hr>
                <div class="row">
                    <div class="form-group-sm col-md-3">
                        <label for="supplier">Supplier</label>
                        <input type="text" class="form-control" data-date-format="mm/dd/yyyy" name="supplier" id="supplier" placeholder="Supplier" required>
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group col-md-2 datepiker">
                        <label for="alert_date">Alert date</label>
                        <input type="text" class="form-control datepicker" name="alert_date" id="datepicker" placeholder="Alert date" required>
                    </div>
                    <div class="form-group col-md-3 service-small">
                        <label for="primary_contact">Primary Contact</label>
                        <select name="primary_contact" class="form-control" id="primary_contact" required>
                            <option value="" selected disabled>Select contact</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}" @if($user->id == Auth::user()->id) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Reference #</label>
                        <input type="text" class="form-control" name="reference" id="exampleInputPassword1" placeholder="Reference Number" required>
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
                        <select class="form-control" name="category" id="currency">
                            <option selected disabled>-- no category --</option>
                            @foreach($categories as $category)
                                <option value="{{$category->category}}">{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1.5  service-small">
                        <label for="currency">Contract value</label>
                        <select class="form-control" name="currency" id="currency">
                            <option value="usd">USD&nbsp;&nbsp;</option>
                            <option value="gbp">GBP</option>
                            <option value="eur">EUR</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 no-label">
                        <input type="text" class="form-control" name="contract_value" placeholder=".00" />
                    </div>
                    <div class="form-group col-md-1.5 no-label service-small">
                        <select class="form-control service-small" name="contract_period">
                            <option value="yearly">per year</option>
                            <option value="weekly">per week</option>
                            <option value="monthly">per month</option>
                            <option value="quarterly">per quarter</option>
                            <option value="biannually">per half year</option>
                            <option value="biennially">per two years</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="startDate">Start Date</label>
                        <input id="startDate" name="startDate" type="text" class="form-control" />
                    </div>
                    <div class="form-group col-md-2 date">
                        <label for="endDate">End Date</label>
                        <input id="endDate" name="endDate" type="text" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2 service-small">
                        <label for="notice_period">Notice Period</label>
                        <select class="form-control service-small" name="notice_period">
                            <option value="1 month">1 month</option>
                            <option value="2 months">2 months</option>
                            <option value="3 months">3 months</option>
                            <option value="6 months">6 months</option>
                            <option value="12 moths">12 months</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-check-label no-label-checkbox" for="no-end-date">
                            <input type="checkbox" value="1" name="no_end_date" id="indefinite">
                            Indefinite (No end date)
                        </label>
                    </div>
                </div>
                <h5>Additional information</h5>
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
                        <div class="form-group col-md-2 service-small">
                            <label for="secondary_contact">Secondary contact</label>
                            <select name="secondary_contact" class="form-control" id="secondary_contact">
                                <option value="" selected disabled>Select contact</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}"> {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 service-small">
                            <label for="notes">Notes</label>
                            <input type="text" class="form-control" name="notes">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="file">Upload file</label>
                            <input type="file" name="file" id="file">
                        </div>
                        <div id="myId"></div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Save contract alert</button>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(function () {
        $("#indefinite").click(function () {
            if ($(this).is(":checked")) {
                $( "#endDate" ).prop( "disabled", true ).val('No end date');
                console.log('checked');
            } else {
                $( "#endDate" ).prop( "disabled", false ).val('');
                console.log('unchecked');
            }
        });
    });
</script>
<script>
        $(function () {
            $(".datepicker").datepicker({ 
        format: "yyyy-mm-dd", 
        });
    });
</script>
<script>
    var bindDateRangeValidation = function (f, s, e) {
    if(!(f instanceof jQuery)){
			console.log("Not passing a jQuery object");
    }
  
    var jqForm = f,
        startDateId = s,
        endDateId = e;
  
    var checkDateRange = function (startDate, endDate) {
        var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
        return isValid;
    }

    var bindValidator = function () {
        var bstpValidate = jqForm.data('bootstrapValidator');
        var validateFields = {
            startDate: {
                validators: {
                    notEmpty: { message: 'This field is required.' },
                    callback: {
                        message: 'Start Date must less than or equal to End Date.',
                        callback: function (startDate, validator, $field) {
                            return checkDateRange(startDate, $('#' + endDateId).val())
                        }
                    }
                }
            },
            endDate: {
                validators: {
                    notEmpty: { message: 'This field is required.' },
                    callback: {
                        message: 'End Date must greater than or equal to Start Date.',
                        callback: function (endDate, validator, $field) {
                            return checkDateRange($('#' + startDateId).val(), endDate);
                        }
                    }
                }
            },
          	customize: {
                validators: {
                    customize: { message: 'customize.' }
                }
            }
        }
        if (!bstpValidate) {
            jqForm.bootstrapValidator({
                excluded: [':disabled'], 
            })
        }
      
        jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
        jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);
      
    };

    var hookValidatorEvt = function () {
        var dateBlur = function (e, bundleDateId, action) {
            jqForm.bootstrapValidator('revalidateField', e.target.id);
        }

        $('#' + startDateId).on("dp.change dp.update blur", function (e) {
            $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
            dateBlur(e, endDateId);
        });

        $('#' + endDateId).on("dp.change dp.update blur", function (e) {
            $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
            dateBlur(e, startDateId);
        });
    }

    bindValidator();
    hookValidatorEvt();
};


$(function () {
    var sd = new Date(), ed = new Date();
  
    $('#startDate').datetimepicker({ 
      pickTime: false, 
      format: "YYYY-MM-DD", 
      defaultDate: sd, 
      maxDate: ed 
    });
  
    $('#endDate').datetimepicker({ 
      pickTime: false, 
      format: "YYYY-MM-DD", 
      defaultDate: ed, 
      minDate: sd 
    });

    //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
    bindDateRangeValidation($("#form"), 'startDate', 'endDate');
});
</script>
@endsection    
@endsection