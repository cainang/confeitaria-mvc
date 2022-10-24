<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Model\Entity\Bolos as BolosEntity;

    class Bolos extends Index {

        public static function getBolosItens(){
            $itens = '';
            $results = BolosEntity::getBolos(null, 'id DESC');

            while($obBolos = $results->fetchObject(BolosEntity::class)){
                var_dump($obBolos);
            }

            return $itens;
        }
            
        public static function getBolos(){
            /* $con = new Connection();
            $con = $con->getConnection();

            $sql = "SELECT * FROM BOLOS";

            $rs = $con->prepare($sql);
            $rs->execute();
            $result = $rs->fetchAll(PDO::FETCH_ASSOC); */
            
            $content = View::render('pages/bolos', [
                'itens' => self::getBolosItens()
            ]);

            return parent::getindex('Bolos', $content);
        }

        public static function renderBolos($request){
            return self::getBolos();
        }
    
    }

?>