<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;
    use \App\Controller\Pages\Components\Button;

    class Home extends Index {
            
        public static function getHome(){
            
            $content = View::render('pages/home', [
                'result' => 'Ola mundo',
                'button' => Button::getButton('PRODUTOS', '', '#categorias'),
                'btn_login' => Button::getButton('LOGIN', 'secundario', "login")
            ]);
            $css = View::getStyleView('home');
            $js = View::getScriptView('home');

            return parent::getindex('Home', $content ,$css, $js);
        }
    
    }

?>