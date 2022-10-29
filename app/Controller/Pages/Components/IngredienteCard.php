<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class IngredienteCard {
            
        public static function getIngredienteCard($obIng){
            
            $content = View::render('pages/components/ingrediente_card', [
                'nome_ing' => $obIng->nome,
                'ingId' => $obIng->ID
            ]);

            return $content;
        }
    
    }

?>