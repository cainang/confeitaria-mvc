<?php
    namespace App\Controller\Pages;
    // namespace App\Controller\Pages\Components;
    use \App\Session\Admin\Login as SessionLogin;
    use \App\Model\Entity\Pedidos as PedidosEntity;
    use \App\Utils\View;
    use \App\Controller\Pages\Components\PedidosCard;

    class ModalUser extends Index {

        public static function getBolosItens($id){
            $itens = '';
            $results = PedidosEntity::getPedidosByUser($id);

            while($obBolos = $results->fetchObject(PedidosEntity::class)){
                $itens .= PedidosCard::getPedidosCard($obBolos);
            }
            return $itens;
        }
            
        public static function getModalUser(){
            // var_dump($_SESSION);
            // return;
            if(!SessionLogin::isLogged()){
                return;
            }
            $params = $_SESSION['admin']['user']['id'];

            $content = View::render('pages/modalUser', [
                "nome" => $_SESSION['admin']['user']['nome'],
                "email" => $_SESSION['admin']['user']['email'],
                "cards" => self::getBolosItens($_SESSION['admin']['user']['id'])
            ]);

            return $content;
        }
    
    }

?>