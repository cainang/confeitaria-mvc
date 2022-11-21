<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Comentarios {
    public $ID;
    public $texto;
    public $data_emissao;
    public $id_cliente;
    public $id_bolo;
    public $ativo;

    static public function getComentariosByUser($id, $limit = '') {
        return (new Database('COMENTARIOS'))->select('', $order = 'ID DESC', $limit);
    }

    static public function createComentario($texto) {
        // $currentDate = new DateTime();
        try {
            $id = (new Database('COMENTARIOS'))->insert([
                'data_emissao' => date('Y-m-d'),
                'id_cliente' =>'1',
                'id_bolo' => '1',
                'ativo' => true,
                'texto' => $texto
            ]);
            return 'Sucesso!';
        } catch (\PDOException $th) {
            return 'ERRO EM ALGO';
        }

        return (new Database('COMENTARIOS'))->select("ID = '". $id ."'")->fetchObject(self::class);
    }
}