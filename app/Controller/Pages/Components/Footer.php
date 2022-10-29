<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Footer {
            
        public static function getFooter(){

            $content = View::render('pages/components/footer', []);

            return $content;
        }
    
    }

?>