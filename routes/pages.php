<?php

    use \App\Http\Response;
    use \App\Controller\Pages;

    $obRouter->get('/', [
        function(){
            return new Response(200, Pages\Home::getHome());
        }
    ]);

    $obRouter->get('/teste', [
        function(){
            return new Response(200, Pages\Teste::getTeste());
        }
    ]);

    $obRouter->get('/recuperacao', [
        function(){
            return new Response(200, Pages\Recuperacao::getRecuperacao());
        }
    ]);
    
    $obRouter->get('/bolos', [
        'middlewares' => [
            'maintenance'
        ],
        function(){
            return new Response(200, Pages\Bolos::getBolos());
        }
    ]);

?>