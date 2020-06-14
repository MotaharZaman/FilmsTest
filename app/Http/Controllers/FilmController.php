<?php

namespace App\Http\Controllers;

use App\DataModel\Manager\DataManager;
use App\DataModel\Manager\FilmManager;
use App\DataModel\Model\Film;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FilmController extends Controller
{
    public function create()
    {
        return view('owner.film.create');
    }

    public function showFilms()
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
            return view('owner.film.showComment')->with(['films'=>$filmWithComment]);
        }
        else
            return view('owner.film.showComment')->with(['films'=>null]);
    }

    public function storeComment(Request $request)
    {
        $data = $request->all();
        $comment = $data['comment_body'];
        $filmId = $data['film_id'];
        $userId = $data['user_id'];
        $id = (new FilmManager())->storeCommentData($comment, $filmId, $userId);

        return redirect()->route('filmDetails', ['id' => $filmId]);
    }

    public function storeFilm(Request $request)
    {
        $data = $request->all();

        $film = new Film();
        $film->setName($data['film_Name']);
        $film->getUser()->setId($data['userId']);
        $film->setDescription($data['description']);
        $film->setRelease($data['release']);
        $film->setRating($data['rating']);
        $film->setTicket($data['ticket']);
        $film->setPrice($data['price']);
        $film->setCountry($data['country']);
        $film->setStatus(1);

        for($i = 0; $i < count($data['genre']); $i++){
            $film->addGenre((int)$data['genre'][$i]);
        }

        $file = $request->file('photo');
        $path = public_path('filmImage/');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $imgName = Carbon::now()->timestamp.$data['film_Name'].".".$file->getClientOriginalExtension();
        $target_file = $path . $imgName;
        move_uploaded_file($file->getRealPath(), $target_file);
        $film->setPhoto($imgName);

        $id = (new FilmManager())->storeFilmData($film);
        (new FilmManager())->storeFilmGenre($film, $id);

        return redirect()->route('showFilms');
    }
}
