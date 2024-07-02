<?php


$codigo = $conn->real_escape_string($_GET['code']);


$sql = "SELECT account_id, resetado FROM resetpass WHERE code = '$codigo'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        if ($linha['resetado'] == 0) {
            $account_id = $linha['account_id'];

            $novaSenha = '';
            $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $caracteres = str_split($caracteres);
            $tamanho = 8;

            for ($i = 0; $i < $tamanho; $i++) {
                $novaSenha .= $caracteres[array_rand($caracteres)];
            }


            $sql_email = "SELECT email, userid FROM login WHERE account_id = $account_id";
            $resultado_email = $conn->query($sql_email);

            if ($resultado_email->num_rows > 0) {
                $linha_email = $resultado_email->fetch_assoc();
                $email = $linha_email['email'];
                $userid = $linha_email['userid'];




                $senhaEncrypt = md5($novaSenha);
                $sql1 = "UPDATE login SET user_pass = '$senhaEncrypt' WHERE account_id = $account_id";
                $sql2 = "UPDATE resetpass SET resetado = 1, new_password = '$senhaEncrypt' WHERE account_id = $account_id";

                if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
                    $para = $email;
                    $assunto = "Redefinição de Senha";
                    $mensagem = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha Gerada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nova Senha Gerada</h2>
        <p>Olá '.$userid.',</p>
        <p>Ficamos felizes em informar que sua senha foi redefinida com sucesso. Abaixo estão os detalhes da sua conta:</p>
        <ul>
            <li><strong>Nome de Usuário:</strong> '.$userid.'</li>
            <li><strong>Nova Senha:</strong> '.$novaSenha.'</li>
        </ul>
        <p>Por favor, lembre-se de guardar esta informação em um local seguro. Caso tenha alguma dúvida ou precise de mais assistência, não hesite em entrar em contato conosco.</p>
        <p class="footer">Atenciosamente,<br>'.$config["NameServer"].'</p>
    </div>
</body>
</html>';

                    $cabecalhos  = "MIME-Version: 1.0\r\n";
                    $cabecalhos .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $cabecalhos .= "From: " . $config['EmailAdmin'] . "\r\n";
                    $cabecalhos .= "Reply-To: " . $config['EmailAdmin'] . "\r\n";
                    $cabecalhos .= "X-Mailer: PHP/" . phpversion();

                    if (mail($para, $assunto, $mensagem, $cabecalhos)) {
                        echo "<p class='messageSuccess'>Senha atualizada. Faça login novamente!</p>
                        <script>
                            setTimeout(function(){
                                window.location.href = '?to=logout';
                            }, 2000);
                        </script>";
                    } else {
                        echo "<p class='messageError'>Falha ao enviar o e-mail!</p>";
                    }
                } else {
                    echo "<p class='messageError'>Erro ao atualizar as tabelas: " . $conn->error . "</p>";
                }
            } else {
                echo "<p class='messageError'>O email fornecido não corresponde ao usuário!</p>";
            }
        } else {
            echo "<p class='messageError'>O link já foi utilizado.</p>";
        }
    }
} else {
    echo "<p class='messageError'>Link inválido.</p>";
}

$conn->close();
?>
