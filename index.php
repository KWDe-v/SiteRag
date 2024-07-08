<?php
if (isset($_GET['to'])) {
    $nomeDaPagina = $_GET['to'];

    $configPath = "/includes/config/config.php";
    $includePath = "/includes/" . $nomeDaPagina . ".php";
    $headerPath = "/header.php";
    $pagesPath = "/pages/" . $nomeDaPagina . ".php";
    $footerPath = "/footer.php";

    if (file_exists(__DIR__ . $pagesPath)) {

        include __DIR__ . $configPath;
        include __DIR__ . $includePath;
        include __DIR__ . $headerPath;
        include __DIR__ . $pagesPath;
        include __DIR__ . $footerPath;

    } else {
    
        header("Location: ?to=error"); //pagina de erro
        exit();
    }
} else {
    header("Location: ?to=inicio");//pagina inicial
    exit();
}
?>
