<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['usernameResetSenha']) || empty($_POST['emailResetSenha'])) {
        echo "<p class='messageError'>Por favor, preencha todos os campos.</p>";
    } else {
        $usuario = $conn->real_escape_string($_POST['usernameResetSenha']);
        $email = $conn->real_escape_string($_POST['emailResetSenha']);

        $sql = "SELECT * FROM login WHERE userid = '$usuario'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $sql = "SELECT * FROM login WHERE userid = '$usuario' AND email = '$email'";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                $linha = $resultado->fetch_assoc();
                $codigo = md5(rand() + 500); 
                $account_id = $linha["account_id"];
                $senhaAntiga = $linha["user_pass"];
                $senhaNova = NULL; 

                $sql = "INSERT INTO resetpass (code, account_id, old_password, new_password, request_date) ";
                $sql .= "VALUES ('$codigo', $account_id, '$senhaAntiga', NULL, NOW())";
                
                if ($conn->query($sql) === TRUE) {
                    $para = $linha["email"];
                    $assunto = "Redefinição de Senha";
                    $reset_link = "https://{$config['BaseURL']}/?to=novasenha&code=$codigo&account_id=$account_id";
                    
                    
                    
                    $mensagem = '
<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Recuperação de Senha</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">

  @media screen {
    @font-face {
      font-family: "Source Sans Pro";
      font-style: normal;
      font-weight: 400;
      src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
    }
    @font-face {
      font-family: "Source Sans Pro";
      font-style: normal;
      font-weight: 700;
      src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
    }
  }

  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }

  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }

  img {
    -ms-interpolation-mode: bicubic;
  }

  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: inherit !important;
    text-decoration: none !important;
  }

  div[style*="margin: 16px 0;"] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
    transition: all 0.3s ease;
  }
  a:hover {
    text-shadow: 0px 2px 2px #000;
    transition: all 0.3s ease;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  .viewticket {
  	display: inline-block; 
  	padding: 16px 36px; 
  	font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; 
  	font-size: 16px; color: #ffffff; 
  	color: white;
  	background: #1a82e2;
  	text-decoration: none; 
  	border-radius: 6px;
  	opacity: 0.75;
  	transition: all 0.3s ease;
  }
   .viewticket:hover {
   	 transition: all 0.3s ease;
   	 opacity: 1;
   	 
  }
  </style>

</head>
<body style="background-color: #e9ecef;">

  <!-- start preheader -->
  <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
  
		<p>Redefinição de Senha.</p>
	
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
          <tr>
            <td align="center" valign="top" style="padding: 36px 24px;">
              <a href="#" target="_blank" style="display: inline-block;">
                
              </a>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->

        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
           <tr>
          <td align="center" bgcolor="#ffffff" style="font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf; text-align: center;">
             <h1>Recuperação de Senha</h1>
          </td> 
          </tr>
          <tr>

            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; ">
              <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;"><?php echo htmlspecialchars($emailTitle) ?></h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align="center" bgcolor="#e9ecef">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">Olá ' . htmlspecialchars($usuario) . ', Você recebeu este e-mail porque você ou outra pessoa preencheu nosso formulário de "redefinição de senha",
  solicitando a redefinição da senha da sua conta em nosso servidor.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align="left" bgcolor="#ffffff">
              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center" >
                          <a href="' . $reset_link . '" target="_blank" ><div class="viewticket">Redefinir Senha</div></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
              <p style="margin: 0;">Se isso não funcionar, copie e cole o seguinte link no seu navegador:</p>
              <p style="margin: 0;"><a href="' . $reset_link . '" target="_blank">' . $reset_link . '</a></p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
              <p style="margin: 0;">'.htmlspecialchars($data).'</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
        <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

          <!-- start permission -->
          <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: "Source Sans Pro", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;"><p><em><strong>Nota:</strong> Este é um e-mail automático, por favor não responda para este endereço.</em></p>
              <p style="margin: 0;"></p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->

          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>';

                    $cabecalhos  = "MIME-Version: 1.0\r\n";
                    $cabecalhos .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $cabecalhos .= "From:". $config['EmailAdmin']."\r\n";
                    $cabecalhos .= "Reply-To:". $config['EmailAdmin']."\r\n";
                    $cabecalhos .= "X-Mailer: PHP/" . phpversion();

                    if(mail($para, $assunto, $mensagem, $cabecalhos)) {
                        echo "<p class='messageSuccess'>Um email de recuperação foi enviado para sua caixa de entrada</p>";
                    } else {
                        echo "<p class='messageError'>Falha ao enviar o e-mail.</p>";
                    }
                } else {
                    echo "<p class='messageError'>Erro na inserção: " . $conn->error . "</p>";
                }
            } else {
                echo "<p class='messageError'>O email fornecido não corresponde ao usuário.</p>";
            }
        } else {
            echo "<p class='messageError'>O usuário fornecido não foi encontrado.</p>";
        }
    }
}
?>
