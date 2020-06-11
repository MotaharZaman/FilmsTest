<?php

namespace App\DataModel\Manager;

use App\DataModel\DBManager\Database;

class FilmManager
{
    public function getFilms()
    {
        $queryString = "SELECT * From films WHERE status = 1";
        $queryParameter = array();

        $data = (new Database())->executeQueryDataReturn($queryString, $queryParameter);
    }
}
