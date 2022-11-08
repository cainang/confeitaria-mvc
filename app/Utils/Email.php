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

                $url = getenv('URL') . '/recovery?email=' . $email . '&token=' . $token;

                $mail->isHTML(true);
                if ($tipo == "recovery") {
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
                }
                

                $mail->send();

                return true;
            } catch (Exception $e) {
                return false;
            }
        }

    }