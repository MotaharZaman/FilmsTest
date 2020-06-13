<?php

namespace App\Http\Controllers;

use App\DataModel\Manager\DataManager;
use App\DataModel\Manager\FilmManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FilmController extends Controller
{
    public function create()
    {
        return view('owner.film.create');
    }

    public function showFilms(Request $request)
    {
        $limit = 3;
        if(Input::get('page'))
            $offset = Input::get('page');
        else
            $offset = 1;

        $film = (new FilmManager())->getAllFilms($offset, $limit);
        $films = (new DataManager())->convertObjectListToArrayList($film);
        $countFilms = (new FilmManager())->filmCount();

        return view('owner.film.showFilm')->with(['films'=>$films, 'countFilms' => $countFilms, 'limit' => $limit]);
    }

    public function filmWithComments($id)
    {
        $film = (new FilmManager())->getFilmById($id);

        if(isset($film) && count($film) > 0){
            $filmWithComment = (new DataManager())->convertObjectListToArrayList($film);
            return view('owner.film.showComment')->with(['film'=>$filmWithComment]);
        }
        else
            return view('owner.film.showComment')->with(['film'=>null]);
    }
}
