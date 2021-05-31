<?php

namespace Libs;

class Dao
{
    protected $pdo;

    public function loadConnection()
    {
        $pdo = Connecion::getInstance()->getConnection();
    }
}