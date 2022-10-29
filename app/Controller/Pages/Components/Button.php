<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Button {
            
        public static function getButton($texto = '', $class = '', $link = ''){
            
            $content = View::render('pages/components/button', [
                'texto' => $texto == '' ? 'Boatão sem texto': $texto,
                'class' => $class == '' ? ' ': $class,
                'link' => $link == ''? '#': $link
            ]);

            return $content;
        }
    
    }

?>