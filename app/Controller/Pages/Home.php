<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;

    class Home extends Index {
            
        public static function getHome(){
            
            $content = View::render('pages/home', [
                'result' => 'Ola mundo'
            ]);

            return parent::getindex('Home', $content);
        }
    
    }

?>