<?php
    namespace App\Controller\Pages;
    // namespace App\Controller\Pages\Components;
    use \App\Session\Admin\Login as SessionLogin;
    use \App\Model\Entity\Pedidos as PedidosEntity;
    use \App\Model\Entity\Comentarios as ComentariosEntity;
    use \App\Model\Entity\Bolos as BolosEntity;
    use \App\Model\Entity\User;
    use \App\Utils\View;
    use \App\Controller\Pages\Components\PedidosCard;

    class Comentarios extends Index {

        public static function getComentariosJson($obBolos){
            // $boloInfo = BolosEntity::getBolosById($obBolos->id_bolo)->fetchObject(BolosEntity::class);

            $json = [
                'ID' => $obBolos->ID,
                'data_emissao' => $obBolos->data_emissao,
                'id_cliente' => $obBolos->id_cliente,
                'id_bolo' => $obBolos->id_bolo,
                'ativo' => $obBolos->ativo,
                'texto' => $obBolos->texto,
            ];

            return $json;
        }

        public static function getComentariosItens(){
            $itens = [];
            $results = ComentariosEntity::getComentariosByUser('1');

            while($obBolos = $results->fetchObject(ComentariosEntity::class)){
                // array_push($itens, self::getComentariosJson($obBolos));
                array_push($itens, $obBolos);
            }
            return json_encode($itens);
        }

        public static function postComentariosItens($request){
            $queryVars = $request->getQueryParams();
            $results = ComentariosEntity::createComentario($queryVars['texto']);

            return json_encode($results);
        }
    }

?>