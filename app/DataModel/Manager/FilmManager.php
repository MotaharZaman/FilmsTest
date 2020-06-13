<?php

namespace App\DataModel\Manager;

use App\DataModel\DBManager\Database;
use App\DataModel\Model\Film;

class FilmManager
{
    public function getAllFilms($offset, $limit)
    {
        $tmpList = $this->getAllFilmsData($offset, $limit);
        $postList = $this->mapFilms($tmpList);
        return $postList;
    }

    public function getAllFilmsData($offset, $limit)
    {
        $startFrom = ($offset-1)*$limit;
        $queryString = "SELECT f.id, f.name AS filmName, f.description, f.release, f.date, f.rating, f.ticket, f.price, f.country,
                        f.photo, f.created_at, u.id AS userId, u.name AS userName, email, s.commentCount from film f
                        INNER JOIN users u ON u.id = f.user_id
                        LEFT JOIN
                        (
                            SELECT COUNT(c.id) AS commentCount, c.film_id FROM comment c GROUP BY c.film_id
                        ) AS s
                        ON s.film_id = f.id WHERE f.status = 1 ORDER BY f.created_at DESC LIMIT ?, ?";
        $parameter = array($startFrom, $limit);

        return (new Database())->executeQueryDataReturnWithParameter($queryString,$parameter);
    }

    public function mapFilms($tmpList){

        if($tmpList != null && count($tmpList) > 0)
        {
            $filmList = array();
            for($i = 0; $i < count($tmpList); $i++) {

                /*if(isset($filmList[$tmpList[$i]["id"]])){
                    $filmList[$tmpList[$i]["id"]]->addGenre($tmpList[$i]["genre"]);
                }
                else{
                    $filmList[$tmpList[$i]["id"]] = $film;
                }*/
                $film = new Film();
                $film->setId($tmpList[$i]["id"]);
                $film->setName($tmpList[$i]["filmName"]);
                $film->setDescription($tmpList[$i]["description"]);
                $film->setRelease($tmpList[$i]["release"]);
                $film->setDate($tmpList[$i]["date"]);
                $film->setRating($tmpList[$i]["rating"]);
                $film->setTicket($tmpList[$i]["ticket"]);
                $film->setPrice($tmpList[$i]["price"]);
                $film->setCountry($tmpList[$i]["country"]);
                $film->setPhoto($tmpList[$i]["photo"]);
                $film->setCreatedAt($tmpList[$i]["created_at"]);
                //$film->addGenre($tmpList[$i]["genre"]);
                $film->setCommentCount($tmpList[$i]["commentCount"] ? $tmpList[$i]["commentCount"] : 0);
                $film->getUser()->setId($tmpList[$i]["userId"]);
                $film->getUser()->setName($tmpList[$i]["userName"]);
                $film->getUser()->setEmail($tmpList[$i]["email"]);

                array_push($filmList, $film);
            }
        }
        return $filmList;
    }

    public function filmCount(){
        $queryString = "SELECT COUNT(id) FROM film WHERE status = 1";

        $data = (new Database())->executeQueryDataReturn($queryString);
        $count = $data[0]["COUNT(id)"];
        return $count;
    }

    public function getFilmById($id)
    {
        $tmpList = $this->getFilmData($id);
        $postList=$this->mapFilmsWithComments($tmpList);
        return $postList;
    }

    public function getFilmData($id){
        $queryString = "SELECT f.id, f.name AS filmName, f.description, f.release, f.date, f.rating, f.ticket, f.price, f.country,
                        f.photo, f.created_at, u.id AS userId, u.name AS userName, email, g.genre, s.commentCount from film f
                        INNER JOIN users u ON u.id = f.user_id LEFT JOIN film_genre g ON g.film_id = f.id
                        LEFT JOIN
                        (
                            SELECT COUNT(c.id) AS commentCount, c.film_id FROM comment c GROUP BY c.film_id
                        ) AS s
                        ON s.film_id = f.id WHERE f.status = 1 ORDER BY f.created_at DESC LIMIT ?, ?";
        $parameter = array($id);

        return (new Database())->executeQueryDataReturnWithParameter($queryString,$parameter);
    }

    public function mapFilmsWithComments($tmpList)
    {
    }
}
