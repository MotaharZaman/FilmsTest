@extends('layouts.app')
@section('title','Create new Film')
@section('content')
    <div class="container">
        <div class="row">
            <!-- Latest Posts -->
            <main class="posts-listing col-lg-11">
                <div class="container">
                    <div class="row">
                        <form class="col-lg-11" method="post" action="{{route('storeFilm')}}" enctype="multipart/form-data">
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
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3" selected>3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                @if ($errors->has('rating')) <p style="color:red;">{{ $errors->first('rating') }}</p> @endif
                            </div>
                            <div class="row">
                                <label for="genre">Genre:</label>
                                <fieldset required>
                                    <input type='checkbox' name='genre[]' value= 1 checked> Action
                                    <input type='checkbox' name='genre[]' value= 2 > Adventure
                                    <input type='checkbox' name='genre[]' value= 3 > Comedy
                                    <input type='checkbox' name='genre[]' value= 5 >Crime
                                    <input type='checkbox' name='genre[]' value= 6 >Fantasy
                                    <input type='checkbox' name='genre[]' value= 7 >Historical
                                    <input type='checkbox' name='genre[]' value= 8 >Horror
                                    <input type='checkbox' name='genre[]' value= 9 checked>Romantic
                                </fieldset>
                                @if ($errors->has('genre')) <p style="color:red;">{{ $errors->first('genre') }}</p> @endif
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
                                    <input class="col-lg-5" id="photo" type="file" name="photo" class="form-control" required>
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
                                    <button type="submit" class="btn" style="margin-left:38px">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
@stop
