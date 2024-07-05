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
      <link href="css/database.css" rel="stylesheet">
      <link href="css/slick.css" rel="stylesheet">
      <link href="css/responsive.css" rel="stylesheet">
      <link href="css/nouislider.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title><?php echo $title ?></title>
   </head>
   <body>
      <!-- ==================  VIDEO BACKGROUND ================ -->
      <div class="video-background">
         <video autoplay muted loop id="background-video">
            <source src="img/bg.mp4" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
         </video>
      </div>
      
      <!-- ================== BARRA DE NAVEGAÇÃO ================ -->
<header>
   <div class="navbar">
       <div class="logo">
           <a href="?sto=inicio"><img src="img/logo.png" alt="Logo" width="200" /></a>
       </div>
        <a href="?to=inicio"><h12>Inicio</h12></a>
        <a href="#about"><h12>Doações</h12></a>
        <a href="#about"><h12>Downloads</h12></a>
        <a href="#about"><h12>Vote </h12></a>



        <div class="dropdown">
            <a href="#" class="dropbtn"><h12>Sobre <span class="icon fas fa-caret-down"></span></h12></a>
            <div class="dropdown-content">
                        <a href="#">❓ Informações</a>
                        <a href="#">⚙️ Sistemas</a>
                        <a href="#"><img src="img/woe.png"/>WOE</a>
                        <a href="#">🏆 Eventos</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropbtn"><h12>Database <span class="icon fas fa-caret-down"></span></h12></a>
            <div class="dropdown-content">
                <a href="?to=itens&page=1"><img src="img/item.png"/>Itens</a>
                <a href="?to=monstros&page=1"><img src="img/monstro.png"/>Monstros</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropbtn"><h12>Ranking <span class="icon fas fa-caret-down"></span></h12></a>
            <div class="dropdown-content">
                <a href="#email">⚔️ PvP</a>
                <a href="#phone">👾 MvP</a>
                <a href="#address"><img src="img/zeny.png"/>Zeny</a>
            </div>
        </div>
        <?php if(!isset($_SESSION['user'])): ?>
         <div class="dropdown">
            <a href="#" class="dropbtn"><h12>Conta <span class="icon fas fa-caret-down"></span></h12></a>
            <div class="dropdown-content">
                <a href="?to=entrar">↪️ Entrar</a>
                <a href="?to=registro">📝 Registrar</a>
            </div>
        </div>
         <?php else: ?>
         <div class="dropdown">
            <a href="#" class="dropbtn"><h12><?php echo $_SESSION['user']; ?> <span class="icon fas fa-caret-down"></span></h12></a>
            <div class="dropdown-content">
                <?php if (strtolower($_SESSION['sex']) == 'm'): ?>
                <a href="?to=entrar"><img src="img/m.png"/>Minha Conta</a>
                <?php else: ?>
                <a href="?to=entrar"><img src="img/f.png"/> Minha Conta</a>
                <?php endif; ?>
                <a href="?to=suporte"><img src="img/ticket.png"/> Abrir Ticket</a>
                <a href="?to=logout">↩️ Sair</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
 <?php if($config['ServerStatus'] == true && $config['ServerStatusManual'] == false){ ?>
      <div class="statusServer">
         <span>Status do Servidor:</span>
         <img src="img/server<?php echo $serverStatus ?>.gif" alt="Status do Servidor" width="25px">
      </div>
<?php } else if($config['ServerStatusManual'] == true && $config['ServerStatus'] == false){ ?>
        <div class="statusServer">
         <span>Status do Servidor:</span>
         <img src="img/server<?php echo $serverStatus ?>.gif" alt="Status do Servidor" width="25px">
      </div>
        <?php } ?>
</header>