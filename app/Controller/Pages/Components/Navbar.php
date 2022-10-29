<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Navbar {
            
        public static function getNavbar(){
            
            $content = View::render('pages/components/navbar', []);

            return $content;
        }
    
    }

?>