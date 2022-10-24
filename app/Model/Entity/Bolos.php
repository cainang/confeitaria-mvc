<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Bolos {
    public $nome;
    public $descricao;

    static public function getBolos($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('depoimentos'))->select($where, $order, $limit, $fields);
    }
}