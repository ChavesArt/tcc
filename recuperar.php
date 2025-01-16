<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "conecta.php";
$conexao = conectar();

$email = $_POST['email'];
$sql = "SELECT * FROM usuario WHERE email='$email'";
$resultado = executarSQL($conexao, $sql);

$usuario = mysqli_fetch_assoc($resultado);
if ($usuario == null) { ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include "links.php"; ?>
    </head>

    <body>

    </body>

    </html>
    <div class="container mt-5">

        <!-- Condição para verificar se o erro ocorreu -->
        <?php
        $erro = true;  // Simulando erro, substitua conforme sua lógica

        if ($erro) {
            echo '
                <!-- Modal -->
                <div class="modal fade show" id="erroModal" tabindex="-1" aria-labelledby="erroModalLabel" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="erroModalLabel">Erro</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Email não cadastrado! Faça o cadastro e em seguida realize o login.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="formcad.php" class="btn btn-primary">Cadastrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        ?>

    </div>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('erroModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
</body>
</html>

    <?php }
// die();
//gerar um token unico
$token = bin2hex(random_bytes(50));

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

include 'config.php';


$mail = new PHPMailer(true);
try {
    // configurações
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setLanguage('br');
    $mail->SMTPDebug = SMTP::DEBUG_OFF;  //tira as mensagens
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //imprime as mensagens
    $mail->isSMTP();                       //envia o email usando SMTP
    $mail->Host = 'smtp.gmail.com';        //Set the SMTP server to send through
    $mail->SMTPAuth = true;                //Enable SMTP authentication
    $mail->Username = $config['email'];    //SMTP username
    $mail->Password = $config['senha_email']; //SMTP password
    //Enable implicit TLS encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    /* TCP port to connect to; use 587 if you have set 
    `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS` */
    $mail->Port = 587;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom($config['email'], 'IEQ Flores');
    $mail->addAddress($usuario['email'], $usuario['nome']);     //Add a recipient
    $mail->addReplyTo($config['email'], 'IEQ Flores');

    //Content
    $mail->isHTML(true);        //Set email format to HTML
    $mail->Subject = 'Recuperação de Senha do Sistema';
    $mail->Body = 'Olá!<br>
        Você solicitou a recuperação da sua conta no nosso sistema.
        Para isso, clique no link abaixo para realizar a troca de senha:<br>
        <a href="' . $_SERVER['SERVER_NAME'] . '/tcc/nova_senha.php?email='
        . $usuario['email'] . '&token=' . $token .
        '">Clique aqui para recuperar o acesso à sua conta!</a><br>
        <br>
        Atenciosamente<br>
        Equipe do sistema...';

    $mail->send();


    $_SESSION['recuperar_senha'] = true;

    // gravar as informações na tabela recuperar-senha
    date_default_timezone_set('America/Sao_Paulo');
    $data = new DateTime('now');
    $agora = $data->format('Y-m-d H:i:s');

    $sql2 = "INSERT INTO `recuperar_senha` 
             (email, token, data_criacao, usado)
             VALUES ('" . $usuario['email'] . "', '$token', 
             '$agora', 0)";

    executarSQL($conexao, $sql2);
} catch (Exception $e) {
    echo "Não foi possível enviar o email. 
          Mailer Error: {$mail->ErrorInfo}";
}
header('Location: form_recuperar_senha.php');