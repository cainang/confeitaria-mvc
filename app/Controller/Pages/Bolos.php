<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Model\Entity\Bolos as BolosEntity;
    use \App\Controller\Pages\Components\Navbar;
    use \App\Controller\Pages\Components\Footer;
    use \App\Controller\Pages\Components\Card;

    class Bolos extends Index {

        public static function getBolosItens($categoria = ''){
            $itens = '';
            $results = BolosEntity::getBolosByCategory($categoria);

            while($obBolos = $results->fetchObject(BolosEntity::class)){
                $itens .= Card::getCard($obBolos);
            }

            return $itens;
        }
            
        public static function getBolos($request){
            $params = $request->getQueryParams();

            if (!isset($params['categoria'])) {
                throw new \Exception("Categoria não encontrada", 404);
            }
            
            $content = View::render('pages/bolos', [
                'cards' => self::getBolosItens($params['categoria']),
                'categoria'=> $params['categoria'],
            ]);
            $css = View::getStyleView('bolos');

            return parent::getindex('Bolos', $content, $css);
        }

        public static function renderBolos($request){
            return self::getBolos();
        }
    
    }

?>