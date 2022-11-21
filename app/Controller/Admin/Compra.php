<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionLogin;
use \App\Controller\Pages\Index;
use \App\Controller\Pages\Components\IngredienteCard;
use \App\Model\Entity\Ingredientes as IngredientesEntity;
use \App\Model\Entity\Bolos as BolosEntity;
use \App\Model\Entity\Pedidos as PedidosEntity;
use \App\Controller\Pages\Components\Alert;
use \App\Controller\Pages\Components\ModalEndereco;

class Compra extends Index {

    public static function getIngCards(){
        $itens = '';
        $results = IngredientesEntity::getIngredientes(null, 'tipo ASC');

        while($obIng = $results->fetchObject(IngredientesEntity::class)){
            $itens .= IngredienteCard::getIngredienteCard($obIng);
        }

        return $itens;
    }
    
    public static function getCompra($request, $alert = []) {

        $params = $request->getQueryParams();

        if (!isset($params['id'])) {
            throw new \Exception("Id de bolo não encontrada", 404);
        }

        $id = $params['id'];

        $results = BolosEntity::getBolosById($id);
        $obBolos = $results->fetchObject(BolosEntity::class);

        $content = View::render('admin/compra', [
            'idbolo' => $obBolos->ID,
            'nome' => $obBolos->nome,
            'desc' => $obBolos->descricao,
            'preco' => $obBolos->preco,
            'tempo' => $obBolos->tempo,
            'ingCard' => self::getIngCards(),
            'modalEndereco' => ModalEndereco::getModalEndereco()
        ]);
        $css = View::getStyleView('compra');
        $js = View::getScriptView('compra');

        return parent::getindex('Compra', $content, $css, $js, $alert);
    }

    public static function setPostCompra($request){
        $params = $request->getQueryParams();

        if (!isset($params['id'])) {
            throw new \Exception("Id de bolo não encontrada", 404);
        } 
        
        if (!isset($params['dataentrega']) || !isset($params['ingredientes'])) {
            return self::callAlert('Informações do bolo não encontrada', 'erro', $request);
        }

        $data_entrega = $params['dataentrega'];
        $ingredientes = $params['ingredientes'];
        $id_bolo = $params['id'];
        $cep = $params['cep'];
        $bairro = $params['bairro'];
        $endereco = $params['endereco'];
        $andares = $params['andares'];

        $id_cliente = SessionLogin::getId();

        $obPedido = PedidosEntity::createPedido($data_entrega, $id_cliente, $id_bolo, $andares);

        if(!$obPedido instanceof PedidosEntity){
            return self::callAlert('Erro ao fazer pedido, por favor tente novamente!', 'erro', $request);
        }

        $obPedidoIng = PedidosEntity::createPedidoIng($obPedido->ID, $ingredientes);

        if(!$obPedidoIng){
            return self::callAlert('Erro ao fazer pedido, por favor tente novamente!', 'erro', $request);
        }

        $obPedidoEnd = User::setEndereco($id_cliente, $cep, $endereco, $bairro);

        if(!$obPedidoEnd){
            return self::callAlert('Erro ao atualizar endereço, por favor tente novamente!', 'erro', $request);
        }

        return self::callAlert('Pedido feito com sucesso!', 'sucesso', $request);
    }

    public static function callAlert($title, $type, $request){
        $alert = Alert::getAlert($title, $type);
        $alertJs = Alert::getAlertScript();

        return self::getCompra($request, [
            'alert' => $alert,
            'alertJs' => $alertJs
        ]);
    }
}