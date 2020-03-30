<?php

namespace App\Data\DB;
use Core\Database\Database;

class Classrooms{

    public static function get_all_bulding(Database $connection){
        $result =  $connection->query('SELECT * FROM get_all_housing()');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    public static function get_all_classrooms(Database $connection){
        $result =  $connection->query('SELECT * FROM get_all_classes()');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    public static function get_all_classrooms_in_building(Database $connection, $num_building){
        $result =  $connection->query('SELECT * FROM get_all_classes_in_building('.$num_building.')');
        $arr = pg_fetch_all($result);
        return $arr;
    }
}