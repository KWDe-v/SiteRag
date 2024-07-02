<?php
require_once('config.php');
setlocale(LC_TIME, 'pt_BR.UTF-8', 'portuguese');
$dataAtual = strftime('%B %Y');

$title ='Registre sua conta';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];
    $sexo = $_POST['sex'];
        
    if (empty($usuario) || empty($email) || empty($senha) || empty($confirmarSenha)) {
        echo "<p class='messageError'>Todos os campos são obrigatórios.</p>";
    } elseif (!isset($_POST['termos']) || $_POST['termos'] != 'on') {
        echo "<p class='messageError'>Você precisa concordar com os termos.</p>";
    } elseif ($senha !== $confirmarSenha) {
        echo "<p class='messageError'>As senhas não coincidem.</p>";
    } elseif (strlen($usuario) < 6 || strlen($senha) < 6) {
        echo "<p class='messageError'>O usuário e a senha devem ter no mínimo 6 caracteres!</p>";
    } elseif (!ctype_alnum($usuario) || !ctype_alnum($senha)) {
        echo "<p class='messageError'>O usuário e a senha devem conter apenas letras e números!</p>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='messageError'>Insira um E-mail válido!</p>";
    } else {
       
        $query_verificar_email = "SELECT * FROM login WHERE email = ?";
        $stmt_verificar_email = $conn->prepare($query_verificar_email);
        $stmt_verificar_email->bind_param("s", $email);
        $stmt_verificar_email->execute();
        $result_verificar_email = $stmt_verificar_email->get_result();
        
        if ($result_verificar_email->num_rows > 0) {
            echo "<p class='messageError'>Este E-mail já está cadastrado. Tente outro!</p>";
        } else {
            $query_verificar_usuario = "SELECT * FROM login WHERE userid = ?";
            $stmt_verificar_usuario = $conn->prepare($query_verificar_usuario);
            $stmt_verificar_usuario->bind_param("s", $usuario);
            $stmt_verificar_usuario->execute();
            $result_verificar_usuario = $stmt_verificar_usuario->get_result();
            
            if ($result_verificar_usuario->num_rows > 0) {
                echo "<p class='messageError'>Este usuário já está cadastrado. Tente outro!</p>";
            } else {

                $senhaEncrypt = md5($senha);

                                
                $sql = "INSERT INTO login (userid, email, user_pass, sex) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $usuario, $email, $senhaEncrypt, $sexo);

                if ($stmt->execute()) {
                    echo "<p class='messageSuccess'>Registrado com sucesso! Redirecionando...</p>";

                    echo "<script>
                            setTimeout(function(){
                                window.location.href = '?to=entrar';
                            }, 2000);
                          </script>";
                } else {
                    echo "<p class='messageError'>Erro ao cadastrar. Por favor, tente novamente.</p>";
                }

                $stmt->close();
            }
        }
    }
}
    
?>