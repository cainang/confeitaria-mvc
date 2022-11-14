<?php

    use \App\Http\Response;
    use \App\Controller\Pages;

    $obRouter->get('/', [
        function(){
            return new Response(200, Pages\Home::getHome());
        }
    ]);

    $obRouter->get('/recovery', [
        function($request){
            return new Response(200, Pages\Recovery::getRecovery($request));
        }
    ]);

    $obRouter->post('/recovery', [
        function($request){
            return new Response(200, Pages\Recovery::setRecovery($request));
        }
    ]);
    
    $obRouter->get('/bolos', [
        function($request){
            return new Response(200, Pages\Bolos::getBolos($request));
        }
    ]);

    $obRouter->get('/pedidos', [
        'middlewares' => [
            'require-admin-login'
        ],
        function(){
            return new Response(200, Pages\ModalUser::getBolosItens());
        }
    ]);

?>