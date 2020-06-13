<?php

namespace App\DataModel\DBManager;

use Illuminate\Support\Facades\DB;

class Database {

    public function executeQueryDataReturn($query)
    {
        try {
            $result = DB::select($query);
            return $result;
        } catch(\Illuminate\Database\QueryException $ex){
            return null;
        }
    }

    public function executeQueryDataReturnWithParameter($query, $parameter)
    {
        try {
            $result = DB::select($query,$parameter);
            return $result;
        } catch(\Illuminate\Database\QueryException $ex){
            return null;
        }
    }

    public function executeQueryInsert($query,$parameter)
    {
        DB::insert($query,$parameter);
        $lastInsertRowId = DB::getPdo()->lastInsertId();
        return $lastInsertRowId;
    }

    public function executeQueryWithParameter($query,$parameter)
    {
        DB::update($query,$parameter);
    }

    public function executeQuery($query)
    {
        DB::update($query);
    }

    public function executeQueryDeleteWithParameter($query,$parameter)
    {
        DB::delete($query,$parameter);
    }

    public function executeQueryDelete($query)
    {
        DB::delete($query);
    }
}
