<?php

namespace App;

class Database
{
    private static $user = 'yanis';
    private static $password = 'wac';

    public static function connect(){
        $pdo = new \PDO('mysql:host=localhost;dbname=twitter', self::$user, self::$password);
        return($pdo);
    }

}