<?php

namespace web\api\infrastructure;

use Illuminate\Database\Capsule\Manager as DB;


class Eloquent
{
    public static function init(string $path)
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($path));
        $db->setAsGlobal();
        $db->bootEloquent();

    }
}