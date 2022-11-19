<?php

    namespace App\Utils;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Email {

        public static function sendEmail($email, $tipo, $token = ''){
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();                                
                $mail->Host       = 'smtp.gmail.com';         
                $mail->SMTPAuth   = true;                       
                $mail->Username   = 'confeitariatrabalho@gmail.com';         
                $mail->Password   = 'hxvjjjgsxgvdrpul';                   
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;   

                $mail->setFrom('confeitariatrabalho@gmail.com', 'Confeitaria');
                $mail->addAddress($email, 'Eu');

                $mail->isHTML(true);
                if ($tipo == "recovery") {
                    $url = getenv('URL') . '/recovery?email=' . $email . '&token=' . $token;
                    $mail->Subject = 'Recuperacao de Senha';
                    $mail->Body    = '<p>Clique no botão abaixo para recuperar a senha:</p>
                                      <br>
                                      <a href="'.$url.'">
                                        <button>Recuperar Senha</button>
                                      </a>
                                      <br>
                                      <br>
                                      <a href="'.$url.'">Recuperar senha</a>
                                      ';
                } else if($tipo == "newUser") {
                    $url = getenv('URL') . '/login';
                    $mail->Subject = 'Seja Bem Vindo';
                    $mail->Body    = '<p>Clique no botão abaixo para entrar no site:</p>
                                      <br>
                                      <a href="'.$url.'">
                                        <button>Entrar na conta</button>
                                      </a>
                                      <br>
                                      <br>
                                      <a href="'.$url.'">Entrar na conta</a>
                                      ';
                }
                

                $mail->send();

                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }