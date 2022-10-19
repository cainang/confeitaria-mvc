<?php

namespace App\Config;

use \PDO;
use PDOException;

 class Connection {

     private static $instance;

     public static function getConnection() {
        try {
			if(!self::$instance) {
                self::$instance = new PDO('mysql:host=18.118.111.187;dbname=confeitaria', 'root', 'Dudu@18?#');
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
		} catch (PDOException $e) {
			echo "Erro: " . $e->getMessage();
		}
        
        return self::$instance;
     }

 }