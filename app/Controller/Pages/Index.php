<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;

    class Index {
            
        public static function getindex($title, $content){
            return View::render('pages/index', [
                'title' => $title,
                'content' => $content
            ]);
        }
    
    }

?>