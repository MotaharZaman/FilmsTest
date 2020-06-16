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
                                <input type="text" id="film_Name" name="film_Name"placeholder="Film Name" value="{{ old('film_Name') }}" required>
                                @if ($errors->has('film_Name')) <p style="color:red;">{{ $errors->first('film_Name') }}</p> @endif
                            </div>
                            <div class="row">
                                <label for="description">Description:</label>
                                <input type="text" id="description" name="description" placeholder="Description" value="{{ old('description') }}" required>
                                @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p> @endif
                            </div>
                            <div class="row">
                                <label for="release">Release:</label>
                                <input type="date" id="release" name="release" value="{{ old('release') }}" required>
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
                                <input type="text" id="ticket" name="ticket" placeholder="Ticket" value="{{ old('ticket') }}" required>
                                @if ($errors->has('ticket')) <p style="color:red;">{{ $errors->first('ticket') }}</p> @endif
                            </div>
                            <div class="row">
                                <label for="price">Price:</label>
                                <input type="number" id="price" name="price" placeholder="Price" value="{{ old('price') }}" required>
                                @if ($errors->has('price')) <p style="color:red;">{{ $errors->first('price') }}</p> @endif
                            </div>
                            <div class="row">
                                <label for="country">Country:</label>
                                <input type="text" id="country" name="country" placeholder="Country" value="{{ old('country') }}" required>
                                @if ($errors->has('country')) <p style="color:red;">{{ $errors->first('country') }}</p> @endif
                            </div>
                            <div class="row">
                                <div class="input-group control-group increment" >
                                    <label for="photo">Photo:</label>
                                    <input class="col-lg-5" id="photo" type="file" name="photo" class="form-control" required>
                                </div>
                                @if ($errors->has('photo')) <p style="color:red;">{{ $errors->first('photo') }}</p> @endif
                            </div>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <input id="userId" name="userId" type="hidden" value="{{Auth::user()->id}}">
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
