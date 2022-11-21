<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Config\Connection;
    use \PDO;
    use \App\Controller\Pages\Components\Button;
    use \App\Model\Entity\Comentarios as ComentariosEntity;

    class Home extends Index {
            
        public static function getHome(){
            $comentario = ComentariosEntity::getComentariosByUser(1, 1)->fetchObject(ComentariosEntity::class);
            
            $content = View::render('pages/home', [
                'result' => 'Ola mundo',
                'produtos' => Button::getButton('PRODUTOS', 'comum', '#categorias'),
                'comentario' => $comentario->texto
                // 'btn_login' => Button::getButton('LOGIN', 'secundario', "login")
            ]);
            $css = View::getStyleView('home');
            $js = View::getScriptView('home');

            return parent::getindex('Home', $content ,$css, $js);
        }
    
    }

?>