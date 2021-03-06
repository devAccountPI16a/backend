<?php

namespace App\Data\DB;
use Core\Database\Database;
use Core\helpers\Config;
use Core\Validation\Validator;

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

        $validator = new Validator;

        //правила для валидации (входное - массив ассоциативный)
        $validation = $validator->validate(['num_building'=>$num_building], [
            'num_building'   => 'required|numeric'
        ]);

        //проверяем, есть ли ошибки
        if ($validation->fails()) {
            //если ошибка - выкидывай исключение
            throw(new \Exception(Config::get('errors.token_prefix').Config::get('errors.token.invalid_token')));
        }
        //ошибок нет



        $result = $connection->query('SELECT * FROM get_all_classes_in_building(\''.$num_building.'\')');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    /* return string ('Запись уже существует!', 'Запись добавлена!') */
    public static function add_classroom(Database $connection, $num_input_building, $num_input_class){
        $result = $connection->query('SELECT * FROM add_classroom(\''.$num_input_building.'\',\''.$num_input_class.'\')');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    /*return string ('Запись успешно удалена!', 'Записи не существует!')*/
    public static function delete_building(Database $connection, $num_building_for_delete){
        $result = $connection->query('SELECT * FROM delete_building(\''.$num_building_for_delete.'\')');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    /*return string ('Запись успешно удалена!', 'Аудитории не существует в базе!', 'Здания не существует в базе!')*/
    public static function delete_classroom(Database $connection, $num_building_for_delete, $num_class_for_delete){
        $result = $connection->query('SELECT * FROM delete_classroom(\''.$num_building_for_delete.'\',\''.$num_class_for_delete.'\')');
        $arr = pg_fetch_all($result);
        return $arr;
    }

    public static function get_num_building_and_class_by_ID(Database $connection, $id_input_classroom){
        $result = $connection->query('SELECT * FROM "get_num_building_and_class_by_ID"('.$id_input_classroom  .')');
        $buildings_array = array();
        $i=0;
        while($row = pg_fetch_assoc($result)){
            $buildings_array[$i] = [
                'num_building' => $row['num_building'],
                'num_class' => $row['num_class'],
            ];
            $i++;

        }
        return $buildings_array;
    }

    public static function get_id_classroom(Database $connection, $num_housing, $num_classroom){
        $result = $connection->query('SELECT * FROM get_id_classroom('.$num_housing.', '.$num_classroom.')');
        $arr = pg_fetch_all($result);
        return $arr;
    }
}