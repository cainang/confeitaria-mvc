<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;
    use \App\Controller\Pages\Components\Button;
    use \App\Session\Admin\Login as SessionLogin;

    class Navbar{
        public static function ReturnLoginButton(){
            if (!SessionLogin::isLogged()) {
                return Button::getButton('entre no sistema', 'comum', 'login');
            }
            return  Button::getButton('', 'usuario', '');
        }
        public static function getNavbar(){
            
            $content = View::render('pages/components/navbar', [
                'btn_login' => Navbar::ReturnLoginButton()
                // 'btn_cadastrar' => Button::getButton('cadastre-se', 'secundario', "cadastro")
            ]);

            return $content;
        }
    
    }

?>