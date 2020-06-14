<?php

namespace App\DataModel\Manager;

use App\DataModel\DBManager\Database;
use App\DataModel\Model\Comment;
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
        $queryString = "SELECT f.id, f.name AS filmName, f.description, f.release, f.rating, f.ticket, f.price, f.country,
                        f.photo, f.created_at, u.id AS userId, u.name AS userName, email, s.commentCount FROM film f
                        INNER JOIN users u ON u.id = f.user_id LEFT JOIN
                        (
                            SELECT COUNT(c.id) AS commentCount, c.film_id FROM comment c GROUP BY c.film_id
                        ) AS s
                        ON s.film_id = f.id WHERE f.status = ? ORDER BY f.created_at DESC LIMIT ?, ?";
        $parameter = array(1, $startFrom, $limit);

        return (new Database())->executeQueryDataReturnWithParameter($queryString,$parameter);
    }

    public function mapFilms($tmpList)
    {
        if ($tmpList != null && count($tmpList) > 0) {

            $filmList = array();
            for ($i = 0; $i < count($tmpList); $i++) {

                if (isset($filmList[$tmpList[$i]["id"]])) {
                    $filmList[$tmpList[$i]["id"]]->addGenre($tmpList[$i]["genre"]);
                }
                else
                {
                    $film = new Film();
                    $film->setId($tmpList[$i]["id"]);
                    $film->setName($tmpList[$i]["filmName"]);
                    $film->setDescription($tmpList[$i]["description"]);
                    $film->setRelease($tmpList[$i]["release"]);
                    $film->setRating($tmpList[$i]["rating"]);
                    $film->setTicket($tmpList[$i]["ticket"]);
                    $film->setPrice($tmpList[$i]["price"]);
                    $film->setCountry($tmpList[$i]["country"]);
                    $film->setPhoto($tmpList[$i]["photo"]);
                    $film->setCreatedAt($tmpList[$i]["created_at"]);
                    $film->addGenre($tmpList[$i]["genre"] ?? null);
                    $film->setCommentCount($tmpList[$i]["commentCount"] ? $tmpList[$i]["commentCount"] : 0);
                    $film->getUser()->setId($tmpList[$i]["userId"]);
                    $film->getUser()->setName($tmpList[$i]["userName"]);
                    $film->getUser()->setEmail($tmpList[$i]["email"]);

                    $filmList[$tmpList[$i]["id"]] = $film;
                }
            }
            return $filmList;
        }
        return null;
    }

    public function filmCount()
    {
        $queryString = "SELECT COUNT(id) FROM film WHERE status = 1";

        $data = (new Database())->executeQueryDataReturn($queryString);
        $count = $data[0]["COUNT(id)"];
        return $count;
    }

    public function getFilmById($id)
    {
        $tmpList = $this->getFilmDataById($id);
        $filmData = $this->mapFilms($tmpList);
        $commentList = $this->getCommentByFilmId($id);
        return $this->mapFilmsWithComments($filmData, $commentList, $id);
    }

    public function getFilmDataById($id)
    {
        $queryString = "SELECT f.id, f.name AS filmName, f.description, f.release, f.rating, f.ticket, f.price, f.country,
                        f.photo, f.created_at, u.id AS userId, u.name AS userName, email, g.genre, s.commentCount FROM film f
                        INNER JOIN users u ON u.id = f.user_id LEFT JOIN film_genre g ON g.film_id = f.id LEFT JOIN
                        (
                            SELECT COUNT(c.id) AS commentCount, c.film_id FROM comment c GROUP BY c.film_id
                        ) AS s
                        ON s.film_id = f.id WHERE f.id = ? AND f.status = ?";
        $parameter = array($id, 1);

        return (new Database())->executeQueryDataReturnWithParameter($queryString, $parameter);
    }

    public function getCommentByFilmId($id)
    {
        $queryString = "SELECT c.id, c.film_id, c.user_id, c.comment, c.created_at, u.name, email FROM
                        comment c INNER JOIN users u ON u.id = c.user_id WHERE c.film_id = ? AND c.status = ?";
        $parameter = array($id, 1);

        return (new Database())->executeQueryDataReturnWithParameter($queryString, $parameter);
    }

    public function mapFilmsWithComments($filmData, $commentList, $id)
    {
        if(isset($commentList) && count($commentList) > 0){
            for($i = 0; $i < count($commentList); $i++){
                $comment = new Comment();

                $comment->setId($commentList[$i]['id']);
                $comment->setFilmId($commentList[$i]['film_id']);
                $comment->setBody($commentList[$i]['comment']);
                $comment->setCreatedAt($commentList[$i]['created_at']);
                $comment->getUser()->setId($commentList[$i]['user_id']);
                $comment->getUser()->setName($commentList[$i]['name']);
                $comment->getUser()->setEmail($commentList[$i]['email']);

                $filmData[$id]->addCommentList($comment);
            }
        }
        return $filmData;
    }

    public function storeCommentData($comment, $filmId, $userId)
    {
        $queryString = "INSERT INTO comment(film_id, user_id, comment, status) VALUES (?, ?, ?, ?)";
        $queryParameter = array($filmId, $userId, $comment, 1);

        return (new Database())->executeQueryInsert($queryString, $queryParameter);
    }

    public function storeFilmData(Film $film)
    {
        $queryString = "INSERT INTO film(user_id, name, description, `release`, rating, ticket, price, country, photo, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $queryParameter = array($film->getUser()->getId(), $film->getName(), $film->getDescription(), $film->getRelease(),
            $film->getRating(), $film->getTicket(), $film->getPrice(), $film->getCountry(), $film->getPhoto(), 1);

        return (new Database())->executeQueryInsert($queryString, $queryParameter);
    }
}
