<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User {
    public $nome;
    public $email;
    public $senha;

    static public function getUserByEmail($email) {
        return (new Database('CLIENTES'))->select("email = '". $email ."'")->fetchObject(self::class);
    }
}