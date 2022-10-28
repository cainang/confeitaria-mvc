<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Alert {
            
        public static function getAlert($titulo, $tipoIcon){

            $tipo = $tipoIcon == 'erro' ? 'resources\img\error_icon.svg' : 'resources\img\success_icon.svg';
            
            $content = View::render('pages/components/alert', [
                'titulo' => $titulo,
                'tipo' => $tipo
            ]);

            return $content;
        }

        public static function getAlertScript(){
            $js = View::getScriptView('alert');

            return $js;
        }
    
    }

?>