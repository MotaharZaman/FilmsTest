@extends('layouts.app')
@section('styles')
@stop
@section('content')
    <form method="post" action="{{route('posts.index')}}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="name">Write Post:</label>
                <textarea rows="4" cols="50" name="post_body" required>{{ old('post_body') }}</textarea>
                @if ($errors->has('post_body')) <p style="color:red;">{{ $errors->first('post_body') }}</p> @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">

                <div class="input-group control-group increment" >
                    <label for="name">Add Images:</label>
                    <input type="file" name="images[]" class="form-control" multiple >
                </div>
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="row" style = "color:red"> {{$error}}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success" style="margin-left:38px">Submit Post</button>
            </div>
        </div>
    </form>
@stop
@section('scripts')
@stop
