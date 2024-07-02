<?php
require_once('config.php');
$user = $_SESSION['user'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $senhaAtual = $_POST["senhaatual"];
  $novaSenha = $_POST["senhanova"];
  $confirmarSenha = $_POST["confsenhanova"];

  if (empty($senhaAtual) || empty($novaSenha) || empty($confirmarSenha)) {
    echo "<p class='messageError'>Por favor, preencha todos os campos.</p>";
  }
  elseif ($novaSenha != $confirmarSenha) {
    echo "<p class='messageError'>Nova senha e confirmação não correspondem!</p>";

  }
  elseif (!preg_match("/^[a-zA-Z0-9]+$/", $novaSenha)) {
    echo "<p class='messageError'>A nova senha deve conter apenas números e letras.</p>";

  }
  elseif (strlen($novaSenha) < 6) {
    echo "<p class='messageError'>A nova senha deve ter no mínimo 6 caracteres!</p>";

  } else {
    $sql = "SELECT user_pass FROM login WHERE userid = '$user'";
    $resultado = $conn->query($sql);
    $linha = $resultado->fetch_assoc();

    $encryptAtual = md5($senhaAtual);
    $encryptNovaSenha = md5($novaSenha);

    if ($encryptAtual === $linha['user_pass']) {

      $sql = "UPDATE login SET user_pass = '$encryptNovaSenha' WHERE userid = '$user'";

      if ($conn->query($sql) === TRUE) {
       echo "<p class='messageSuccess'>Troca bem sucedida! Relogue...</p>";

       echo "<script>
       setTimeout(function(){
        window.location.href = '?to=logout';
        }, 2000);
        </script>";

      } else {
        echo "<p class='messageError'>Erro ao atualizar a senha: $conn->error</p>" ;

      }
    } else {
      echo "<p class='messageError'>Senha atual incorreta!</p>";

    }
  }

  $conn->close();
}



?>