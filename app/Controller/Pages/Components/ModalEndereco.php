<?php
    namespace App\Controller\Pages\Components;
    // namespace App\Controller\Pages\Components;
    use \App\Session\Admin\Login as SessionLogin;
    use \App\Model\Entity\Pedidos as PedidosEntity;
    use \App\Model\Entity\Bolos as BolosEntity;
    use \App\Model\Entity\User;
    use \App\Utils\View;
    use \App\Controller\Pages\Components\PedidosCard;
    use \App\Controller\Pages\Index;

    class ModalEndereco extends Index {
            
        public static function getModalEndereco(){
            $content = View::render('pages/components/modalEndereco', [
                'modalJs' => View::getScriptView('modalEndereco')
            ]);

            return $content;
        }
    
    }

?>