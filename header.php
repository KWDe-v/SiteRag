<!-- ==================  CABEÇALHO ================ -->
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Site Básico para seu servidor de Ragnarök Online">
      <meta name="keywords" content="Ragnarök Online, <?php echo $config['NameServer']?>">
      <meta name="author" content="KWDe-v">
      <link rel="shortcut icon" href="img/icon.png">
      <link rel="stylesheet" href="css/style.css">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title><?php echo $title ?></title>
      <style type="text/css"></style>
   </head>
   <body>
      <!-- ==================  CAMPO DE STATUS DO SERVIDOR ================ -->
      <div class="statusServer">
         <span>Status do Servidor:</span>
         <img src="img/server<?php echo $serverStatus ?>.gif" alt="Status do Servidor" width="25px">
      </div>
      <!-- ==================  VIDEO BACKGROUND ================ -->
      <div class="video-background">
         <video autoplay muted loop id="background-video">
            <source src="img/bg.mp4" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
         </video>
      </div>