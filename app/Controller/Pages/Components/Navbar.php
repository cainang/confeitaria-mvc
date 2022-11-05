<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;
    use \App\Controller\Pages\Components\Button;

    class Navbar{
            
        public static function getNavbar(){
            
            $content = View::render('pages/components/navbar', [
                'btn_login' => Button::getButton('entre no sistema', '', 'login'),
                // 'btn_cadastrar' => Button::getButton('cadastre-se', 'secundario', "cadastro")
            ]);

            return $content;
        }
    
    }

?>