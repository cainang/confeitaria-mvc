<?php
    namespace App\Controller\Pages;
    // namespace App\Controller\Pages\Components;
    use \App\Session\Admin\Login as SessionLogin;
    use \App\Model\Entity\Pedidos as PedidosEntity;
    use \App\Model\Entity\Bolos as BolosEntity;
    use \App\Model\Entity\User;
    use \App\Utils\View;
    use \App\Controller\Pages\Components\PedidosCard;

    class ModalUser extends Index {

        public static function getPedidosJson($obBolos){
            $boloInfo = BolosEntity::getBolosById($obBolos->id_bolo)->fetchObject(BolosEntity::class);

            $json = [
                'id' => $obBolos->ID,
                'andares' => $obBolos->andares,
                'nomedobolo' => $boloInfo->nome,
                'categoria' => $boloInfo->categoria,
                'preco' => $boloInfo->preco,
                'descricao' => $boloInfo->descricao,
                'datadeentrega' => $obBolos->data_entrega,
            ];

            return $json;
        }

        public static function getBolosItens(){
            $itens = [];
            $results = PedidosEntity::getPedidosByUser($_SESSION['admin']['user']['id']);

            while($obBolos = $results->fetchObject(PedidosEntity::class)){
                array_push($itens, self::getPedidosJson($obBolos));
            }
            return json_encode($itens);
        }
            
        public static function getModalUser(){
            if(!SessionLogin::isLogged()){
                return;
            }

            $content = View::render('pages/modalUser', [
                "nome" => $_SESSION['admin']['user']['nome'],
                "email" => $_SESSION['admin']['user']['email'],
                "token" => User::getUserToken($_SESSION['admin']['user']['email'],$_SESSION['admin']['user']['nome'])
            ]);

            return $content;
        }
    
    }

?>