@extends('layouts.layout')
@section('title','Create new Film')
@section('content')
    <form method="post" action="{{route('storeFilm')}}" enctype="multipart/form-data">
        <div class="row">
            <label for="name">Film Name:</label>
            <input id="film_Name" name="film_Name" required>{{ old('film_Name') }}</input>
            @if ($errors->has('film_Name')) <p style="color:red;">{{ $errors->first('film_Name') }}</p> @endif
        </div>
        <div class="row">
            <label for="description">Description:</label>
            <input id="description" name="description" required>{{ old('description') }}</input>
            @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p> @endif
        </div>
        <div class="row">
            <label for="release">Release:</label>
            <input id="release" name="release" required>{{ old('release') }}</input>
            @if ($errors->has('release')) <p style="color:red;">{{ $errors->first('release') }}</p> @endif
        </div>
        <div class="row">
            <label for="rating">Rating:</label>
            <input id="rating" name="rating" required>{{ old('rating') }}</input>
            @if ($errors->has('rating')) <p style="color:red;">{{ $errors->first('rating') }}</p> @endif
        </div>
        <div class="row">
            <label for="ticket">Ticket:</label>
            <input id="ticket" name="ticket" required>{{ old('ticket') }}</input>
            @if ($errors->has('ticket')) <p style="color:red;">{{ $errors->first('ticket') }}</p> @endif
        </div>
        <div class="row">
            <label for="price">Price:</label>
            <input id="price" name="price" required>{{ old('price') }}</input>
            @if ($errors->has('price')) <p style="color:red;">{{ $errors->first('price') }}</p> @endif
        </div>
        <div class="row">
            <label for="country">Country:</label>
            <input id="country" name="country" required>{{ old('country') }}</input>
            @if ($errors->has('country')) <p style="color:red;">{{ $errors->first('country') }}</p> @endif
        </div>
        <input id="userId" name="userId" type="hidden" value="{{Auth::user()->id}}">
        <div class="row">
            <div class="input-group control-group increment" >
                <label for="photo">Photo:</label>
                <input id="photo" type="file" name="photo" class="form-control" required>
            </div>
            @if ($errors->any())
                @foreach($errors->all() as $error)
                    <div class="row" style = "color:red"> {{$error}}</div>
                @endforeach
            @endif
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
