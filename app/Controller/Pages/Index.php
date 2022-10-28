<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;

    class Index {
            
        public static function getindex($title, $content, $css = '', $js = '', $alert = []){
            return View::render('pages/index', [
                'title' => $title,
                'content' => $content,
                'css' => $css,
                'script' => $js,
                'alert' => $alert['alert'] ?? '',
                'alertJs' => $alert['alertJs'] ?? ''
            ]);
        }
    
    }

?>