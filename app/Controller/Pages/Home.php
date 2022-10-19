<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;

    class Home extends Index {
            
        public static function getHome(){
            $con = new Connection();
            $con = $con->getConnection();

            $sql = "SELECT * FROM BOLOS";

            $rs = $con->prepare($sql);
            $rs->execute();
            $result = $rs->fetchAll(PDO::FETCH_ASSOC);
            
            $content = View::render('pages/home', [
                'result' => json_encode($result)
            ]);

            return parent::getindex('Home', $content);
        }
    
    }

?>