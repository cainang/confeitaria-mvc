<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;

    class Index {
        /**
         * @param string $title
         * @param string $content
         * @param string $css
         * @param string $js
         * @param array $alert
         */
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