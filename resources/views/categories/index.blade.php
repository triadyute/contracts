@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 small">
            <div class="row">
                <div class="col-md-6">
                    <h4>Categories</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('categories.create')}}"><button class="btn btn-primary btn-sm float-right">Add new category</button></a>
                </div>
            </div>
            <hr>
            @include('inc.messages')
        @foreach ($categories as $category)
        <p style="display: inline;">{{$category->category}}</p>
            <a href="{{route('categories.edit', $category)}}"><button class="btn btn-primary btn-sm pull-right" style="display: inline;">Edit</button></a>
            <form method="POST" action="#" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary btn-sm pull-right" style="margin-right: .5em;">Remove</button>
            </form>
<hr>
    @endforeach

        </div>
    </div>
</div>
@section('scripts')

@endsection    
@endsection