@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h4>Edit category</h4>
            <hr>
            @include('inc.messages')
            <form method="POST" action="{{route('categories.update', $contractCategory)}}">
                @csrf
                @method('PUT')
               <div class="form-group">
                <div class="row" style="margin-bottom:1em;">
                    <div class="col-md-4">
                        <label for="category">Category name</label>
                        <input type="text" class="form-control" name="category" value="{{$contractCategory}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </div>
               </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')

@endsection    
@endsection