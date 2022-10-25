<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;

    class Teste extends Index {
            
        public static function getTeste(){
            /* $con = new Connection();
            $con = $con->getConnection();

            $sql = "SELECT * FROM BOLOS";

            $rs = $con->prepare($sql);
            $rs->execute();
            $result = $rs->fetchAll(PDO::FETCH_ASSOC); */
            
            $content = View::render('pages/teste', [
                'variavel' => 'cainan'
            ]);

            return parent::getindex('Teste Titulo', $content);
        }
    
    }

?>