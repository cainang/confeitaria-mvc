<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Button {
            
        public static function getClassButton($class){
            $tipos = array(
                "comum" => "",
                "secundario" => "secundario",
                "usuario" => "button_usuario"
            );

            return $tipos[$class];
        }
        public static function getIconButton($class){
            $tipos = array(
                "usuario" => "<span class='material-symbols-outlined'>person</span>"
            );
            try {
                if (!isset($tipos[$class])){
                    return '';
                }
                return $tipos[$class];

            } catch (\Throwable $th) {
                return '';
            }
        }
        public static function getExtrasUserModal($class){
            if($class != 'usuario'){
                return '';
            }
            return "data-toggle='modal' data-target='#exampleModal'";

        }

        public static function getButton($texto = '', $class = 'comum', $link = '', $extras = ''){
            $tipo = Button::getClassButton($class);
            // 
            $content = View::render('pages/components/button', [
                'texto' => $texto,
                'class' => $tipo,
                'icon' =>  Button::getIconButton($class),
                'link' => $link == ''? '#': $link, 
                'extras' => Button::getExtrasUserModal($class),
            ]);

            return $content;
        }
    
    }

?>