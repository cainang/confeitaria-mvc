<?php

    namespace App\Controller\Pages\Components;

    use \App\Utils\View;
    use \App\Model\Entity\Bolos as BolosEntity;

    class PedidosCard {
            
        public static function getPedidosJson($obBolos){
            $boloInfo = BolosEntity::getBolosById($obBolos->id_bolo)->fetchObject(BolosEntity::class);
            // echo '<pre>';
            //  print_r($boloInfo);
            // echo '</pre>';
            // // die;
            // return;

            $json = json_encode(array(
                'id' => $obBolos->ID,
                'nomedobolo' => $boloInfo->nome,
                'categoria' => $boloInfo->categoria,
                'preco' => $boloInfo->preco,
                'descricao' => $boloInfo->descricao,
                'datadeentrega' => $obBolos->data_entrega,
                )
            );

            return $json;
        }
    
    }

?>