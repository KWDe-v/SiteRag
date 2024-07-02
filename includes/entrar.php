<?php
require_once('config.php');

$title = 'Entrar na Sua Conta';

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    header('Location: ?to=inicio');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (empty($usuario) || empty($senha)) {
        echo "<p class='messageError'>Por favor, preencha todos os campos!</p>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM login WHERE userid = ?");
        if ($stmt === false) {
            echo "Erro ao preparar a consulta: " . $conn->error;
            exit();
        }

        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows == 1) {
            $user = $resultado->fetch_assoc();


            $senhaEncrypt = md5($senha);

            if ($senhaEncrypt == $user['user_pass']) {
                $_SESSION['user'] = $user['userid'];
                $_SESSION['conta'] = $user['account_id'];
                $_SESSION['grupo'] = $user['group_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['sex'] = $user['sex'];
                
                echo "<p class='messageSuccess'>Login bem sucedido! Redirecionando...</p>";

                echo "<script>
                setTimeout(function(){
                    window.location.href = '?to=inicio';
                    }, 2000);
                    </script>";
                } else {
                    echo "<p class='messageError'>Senha incorreta.</p>";
                }
            } else {
                echo "<p class='messageError'>Usuário não encontrado.</p>";
            }

            $stmt->close();
        }
    }


    ?>
