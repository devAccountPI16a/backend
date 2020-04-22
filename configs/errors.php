<?php
return [
    'connection_prefix'=>'1',
    'token_prefix'=>'1',

    //коды ошибок подключений
    'connection'=>[
        'not_connect_with_data'=>'1',
        'invalid_login_or_password'=>'2',
        'error_connect_to_db'=>'3',
        'empty_login_or_password'=>'4',
    ],
    'token'=>[
        'update_token'=>'1',
        'remove_token'=>'2',
        'invalid_token'=>'3',
    ],

];