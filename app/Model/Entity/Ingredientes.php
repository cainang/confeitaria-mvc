<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Ingredientes {
    public $ID;
    public $nome;
    public $tipo;
    public $ativo;

    static public function getIngredientes($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('INGREDIENTES'))->select($where, $order, $limit, $fields);
    }

    static public function getIngredienteByType($tipo = '') {
        return (new Database('INGREDIENTES'))->select('tipo = "'.$tipo.'"');
    }

    static public function getIngredienteById($id = '') {
        return (new Database('INGREDIENTES'))->select('ID = "'.$id.'"');
    }
}