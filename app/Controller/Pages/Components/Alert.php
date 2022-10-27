<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Alert {
            
        public static function getAlert($titulo){
            
            $content = View::render('pages/components/alert', [
                'title' => $titulo
            ]);

            return $content;
        }
    
    }

?>