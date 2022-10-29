<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;
    use \App\Model\Entity\Bolos as BolosEntity;

    class Recuperacao extends Index {

        public static function getCardsRecuperacao(){
            $itens = '';
            $results = BolosEntity::getBolos(null, 'id DESC');

            while($obBolos = $results->fetchObject(BolosEntity::class)){
                $itens .= View::render('pages/components/card', [
                    'nome' => $obBolos->nome,
                    'desc' => $obBolos->descricao
                ]);
            }

            return $itens;
        }
            
        public static function getRecuperacao(){
            $content = View::render('pages/recuperacao', [
                'variavel' => 'cainan',
                'cards' => self::getCardsRecuperacao()
            ]);
            $css = View::getStyleView('recuperacao');
            $js = View::getScriptView('recuperacao');

            return parent::getindex('Teste Titulo', $content, $css, $js);
        }
    
    }

?>