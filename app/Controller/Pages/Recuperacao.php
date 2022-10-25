<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;

    class Recuperacao extends Index {
            
        public static function getRecuperacao(){
            $content = View::render('pages/recuperacao', [
                'variavel' => 'cainan'
            ]);

            return parent::getindex('Teste Titulo', $content);
        }
    
    }

?>