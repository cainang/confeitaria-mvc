<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Model\Entity\Bolos as BolosEntity;

    class Bolos extends Index {

        public static function getBolosItens(){
            $itens = '';
            $results = BolosEntity::getBolos(null, 'id DESC');

            while($obBolos = $results->fetchObject(BolosEntity::class)){
                $itens .= View::render('pages/bolos/itens', [
                    'nome' => $obBolos->nome,
                    'desc' => $obBolos->descricao
                ]);
            }

            return $itens;
        }
            
        public static function getBolos(){
            
            $content = View::render('pages/bolos', [
                'itens' => self::getBolosItens()
            ]);

            return parent::getindex('Bolos', $content);
        }

        public static function renderBolos($request){
            return self::getBolos();
        }
    
    }

?>