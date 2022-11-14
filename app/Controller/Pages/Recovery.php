<?php

    namespace App\Controller\Pages;

    use \App\Utils\View;
    use \App\Model\Entity\User;
    use \App\Controller\Pages\Components\Alert;

    class Recovery extends Index {
            
        public static function getRecovery($request, $alert = []){
            $postVars = $request->getQueryParams();
            $email = $postVars['email'] ?? '';
            $token = $postVars['token'] ?? '';

            $obUser = User::getUserByEmail($email);

            if(!$obUser instanceof User){
                throw new \Exception("Email não cadastrado!", 501);
            }
            
            $userToken = User::getUserToken($obUser->email, $obUser->nome);

            if($userToken != $token){
                throw new \Exception("Token Inválido!", 501);
            }

            $content = View::render('pages/recovery', [
                'nome_user' => $obUser->nome,
                'email_user' => $obUser->email,
                'token_user' => $userToken
            ]);
            $css = View::getStyleView('login');
            $js = View::getScriptView('recovery');

            return parent::getindex('Recuperar Senha', $content, $css, $js, $alert);
        }

        public static function setRecovery($request){
            $queryVars = $request->getQueryParams();
            
            if (isset($queryVars['redirect'])) {
                $redirect = $queryVars['redirect'];
                $request->getRouter()->redirect('/'. $redirect);
            } else {
                self::changePassword($request);
            }
            
        }

        public static function changePassword($request){
            $postVars = $request->getPostVars();
            $queryVars = $request->getQueryParams();
            $novasenha = $postVars['novasenha'] ?? '';
            $email = $queryVars['email'] ?? '';
            $token = $queryVars['token'] ?? '';

            $obUser = User::getUserByEmail($email);

            if(!$obUser instanceof User){
                throw new \Exception("Email não cadastrado!", 501);
            }
            
            $userToken = User::getUserToken($obUser->email, $obUser->nome);

            if($userToken != $token){
                throw new \Exception("Token Inválido!", 501);
            }

            $senha_user = password_hash($novasenha, PASSWORD_DEFAULT);

            User::setNewPassword($obUser->ID, $senha_user);

            $alert = Alert::getAlert('Senha alterada com sucesso!', 'sucesso');
            $alertJs = Alert::getAlertScript();

            return self::getRecovery($request, [
                'alert' => $alert,
                'alertJs' => $alertJs
            ]);
        }
    
    }

?>