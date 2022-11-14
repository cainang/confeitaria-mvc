<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User {
    public $ID;
    public $nome;
    public $email;
    public $senha;
    public $ativo;

    static public function getUserByEmail($email) {
        return (new Database('CLIENTES'))->select("email = '". $email ."'")->fetchObject(self::class);
    }

    static public function getUserToken($email, $nome) {
        return md5($email . $nome);
    }

    static public function setNewPassword($id, $novasenha) {
        return (new Database('CLIENTES'))->update("ID = '". $id ."'", [
            'senha' => $novasenha
        ]);
    }

    static public function createUser($email, $senha, $nome) {
        $id;
        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
        
        try {
            $id = (new Database('CLIENTES'))->insert([
                'email' => $email,
                'senha' => $hashSenha,
                'nome' => $nome,
                'ativo' => true
            ]);
        } catch (\PDOException $th) {
            return false;
        }

        return (new Database('CLIENTES'))->select("ID = '". $id ."'")->fetchObject(self::class);
    }
}