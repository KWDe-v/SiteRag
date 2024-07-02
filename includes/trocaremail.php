<?php
require_once('config.php');
$user = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $emailatual = $_POST["emailatual"];
  $emailnovo = $_POST["emailnovo"];
  $confirmaremailnovo = $_POST["confemailnovo"];

  if (empty($emailatual) || empty($emailnovo) || empty($confirmaremailnovo)) {
    echo "<p class='messageError'>Por favor, preencha todos os campos.</p>";
  } elseif ($emailnovo != $confirmaremailnovo) {
    echo "<p class='messageError'>Novo email e confirmação não correspondem!</p>";
  } elseif (!filter_var($emailnovo, FILTER_VALIDATE_EMAIL)) {
    echo "<p class='messageError'>Por favor, insira um email válido.</p>";
  } else {
    $sql_check_email = "SELECT email FROM login WHERE email = '$emailnovo'";
    $result_check_email = $conn->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
      echo "<p class='messageError'>Este email já está cadastrado. Escolha outro email.</p>";
    } else {
      $sql = "SELECT email FROM login WHERE userid = '$user'";
      $resultado = $conn->query($sql);
      $linha = $resultado->fetch_assoc();

      if ($emailatual === $linha['email']) {
        $sqlUpdate = "UPDATE login SET email = '$emailnovo' WHERE userid = '$user'";
        if ($conn->query($sqlUpdate) === TRUE) {
          echo "<p class='messageSuccess'>Troca bem sucedida! Relogue...</p>";

          echo "<script>
            setTimeout(function(){
              window.location.href = '?to=logout';
            }, 2000);
          </script>";
        } else {
          echo "<p class='messageError'>Erro ao atualizar o email: $conn->error</p>";
        }
      } else {
        echo "<p class='messageError'>Email Atual Incorreto!</p>";
      }
    }
  }
  $conn->close(); 
}



?>