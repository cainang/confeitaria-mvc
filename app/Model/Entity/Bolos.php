<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Bolos {
    public $ID;
    public $nome;
    public $descricao;
    public $categoria;
    public $preco;
    public $imagem_url;
    public $tempo;
    public $ativo;

    static public function getBolos($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('BOLOS'))->select($where, $order, $limit, $fields);
    }

    static public function getBolosByCategory($categoria = '') {
        return (new Database('BOLOS'))->select('categoria = "'.$categoria.'"');
    }

    static public function getBolosById($id = '') {
        return (new Database('BOLOS'))->select('id = "'.$id.'"');
    }
}