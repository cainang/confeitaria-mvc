<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;

    class Card {
            
        public static function getCard($obBolos){
            $url = getenv('URL') . '/compra?id=' . $obBolos->ID;
            
            $content = View::render('pages/components/card', [
                'titulo' => $obBolos->nome,
                'descricao' => $obBolos->descricao,
                'preco' => $obBolos->preco,
                'imagem_url' => $obBolos->imagem_url,
                'url' => $url
            ]);

            return $content;
        }
    
    }

?>