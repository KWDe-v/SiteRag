<?php
session_start();
$config = [
    'NameServer'        => 'Nome_do_seu_servidor',                  // Nome do Seu Servidor
    'HostDB'            => '127.0.0.1',                             // IP do seu servidor caso esteja utilizando MySQL Remoto aconselho evitar usar 'localhost'
    'UserDB'            => 'ragnarok',                              // Usuário do phpMyAdmin
    'PasswordDB'        => 'ragnarok',                              // Senha do phpMyAdmin
    'NameDB'            => 'ragnarok',                              // Database do Ragnarok
    'PortMap'           => 5121,                                    // Porta do Map-Server (Padrão = 5121)
    'PortChar'          => 6121,                                    // Porta do Char-Server (Padrão = 6121)
    'PortLogin'         => 6900,                                    // Porta do Login-Server (Padrão = 6900)
    'LinkDiscord'       => 'https://www.discord.com/',              // Link do Discord
    'LinkInstagram'     => 'https://www.instagram.com/',            // Link do Instagram
    'LinkFacebook'      => 'https://www.facebook.com/facebook',     // Link do Facebook
    'LinkYoutube'       => 'https://www.youtube.com/',              // Link do Youtube
    'LinkGitHub'        => 'https://www.github.com/',               // Link do github
    'WhatsappNumber'    => '00900000000',                           // Numero de whatsapp (Parametro = ddd9numero)
    'EmailAdmin'        => 'admin@localhost',                       // Email de ADMIN
    'BaseURL'           => 'SUA_URL',                               // Sua URL base exemplo www.exemple.com.br sem https ou

];

$conn = new mysqli($config['HostDB'], $config['UserDB'], $config['PasswordDB'], $config['NameDB']);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$servers = [
    ['ip' => $config['HostDB'], 'port' => $config['PortMap']],
    ['ip' => $config['HostDB'], 'port' => $config['PortChar']],
    ['ip' => $config['HostDB'], 'port' => $config['PortLogin']]
];
function serverStatus($ip, $port) {
    return @fsockopen($ip, $port, $errno, $errstr, 1) !== false;
}
$serverStatus = 'on';
foreach ($servers as $server) {
    if (!serverStatus($server['ip'], $server['port'])) {
        $serverStatus = 'off';
        break;
    }
}


$meses = [
    'January' => 'Janeiro',
    'February' => 'Fevereiro',
    'March' => 'Março',
    'April' => 'Abril',
    'May' => 'Maio',
    'June' => 'Junho',
    'July' => 'Julho',
    'August' => 'Agosto',
    'September' => 'Setembro',
    'October' => 'Outubro',
    'November' => 'Novembro',
    'December' => 'Dezembro'
];

$data = date("d-F-Y");
list($dia, $mesIngles, $ano) = explode('-', $data);
$mesPortugues = $meses[$mesIngles];

$data = "$mesPortugues, $ano"; 
?>
