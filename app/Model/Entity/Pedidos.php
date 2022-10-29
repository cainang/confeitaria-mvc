<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Pedidos {
    public $ID;
    public $data_entrega;
    public $id_cliente;
    public $id_bolo;
    public $ativo;

    static public function getPedidosByUser($id) {
        return (new Database('PEDIDOS'))->select("id_cliente = '". $id ."'")->fetchObject(self::class);
    }

    static public function createPedido($data_entrega, $id_cliente, $id_bolo) {
        $id;
        
        try {
            $id = (new Database('PEDIDOS'))->insert([
                'data_entrega' => $data_entrega,
                'id_cliente' => $id_cliente,
                'id_bolo' => $id_bolo,
                'ativo' => true
            ]);
        } catch (\PDOException $th) {
            return false;
        }

        return (new Database('PEDIDOS'))->select("ID = '". $id ."'")->fetchObject(self::class);
    }

    static public function createPedidoIng($id_pedido, $ingredientes) {
        $ingredientes = json_decode($ingredientes);

        try {
            for ($i=0; $i < count($ingredientes); $i++) { 
                $id = (new Database('INGREDIENTESPEDIDOS'))->insert([
                    'id_ingrediente' => $ingredientes[$i],
                    'id_pedido' => $id_pedido,
                    'ativo' => true
                ]);
            }
        } catch (\PDOException $th) {
            return false;
        }

        return true;
    }
}