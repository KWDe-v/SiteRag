<?php
include('functions.php');
session_start();
$config = [
    'NameServer'        => 'Nome_do_seu_servidor',                  // Nome do Seu Servidor

    'DropNormal'        => 100,                                     // Drop Normal (1 = 1%) logo se o drop padrao do item for de 100, o valor sairá 1% de 100 = 1% de drop rate
    'DropMVP'           => 100,                                     // Drop de MVP (1 = 1%) logo se o drop padrao do item for de 100, o valor sairá 1% de 100 = 1% de drop rate
    'KeyDivinePride'    => 'SUA_KEY_DIVINE_PRIDE',      // key da api do divine-pride, (necessario para funcionar a  database)
    'accesstoken'       => 'SUA_KEY', // key da api do MercadoPago, (necessario para funcionar a doação)
    //'accesstoken'     => 'SUA_KEY_TESTE',// key de teste da api do MercadoPago
    'url_notification_api'          => 'SUA_URL/notification.php',
    'url_success'                   => 'SUA_URL/success',                   //URL_PAGAMENTO_APROVADO
    'url_pending'                   => 'SUA_URL/pending',                   //URL_PAGAMENTO_PENDENTE
    'url_failure'                   => 'SUA_URL/failure',                   //URL_PAGAMENTO_REJEITADO
    'LinkDiscord'       => 'https://www.discord.com/',              // Link do Discord
    'LinkInstagram'     => 'https://www.instagram.com/',            // Link do Instagram
    'LinkFacebook'      => 'https://www.facebook.com/facebook',     // Link do Facebook
    'LinkYoutube'       => 'https://www.youtube.com/',              // Link do Youtube
    'LinkGitHub'        => 'https://www.github.com/',               // Link do github
    'WhatsappNumber'    => '12345678910',                           // Numero de whatsapp (Parametro = ddd9numero)
    'EmailAdmin'        => 'admin@localhost',                       // Email de ADMIN
    'BaseURL'           => 'SUA_URL',                               // Sua URL base exemplo www.exemple.com.br sem https ou http
    'Renewal'           => false,                                   // defina se quer renewal ou não
    'ServerStatus'      => false,                                   // Mostrar status do servidor (opção abaixo tem que estar desativada para funcionar)(Isso pode deixar o site lento);
    'ServerStatusManual'=> false,                                    // Mostrar status do servidor manualmente (opção acima tem que estar desativada para funcionar);
    'ServerStatusOn'    => false,                                    // Mostrar status do servidor manualmente (opção acima tem que estar ativada para funcionar)(true = server online);
    'VideoBackground'   => false,                                    // video no background do site? (diretório fica em img/bg.mp4)
    'Min_Donation'      => 0,                                    // doação mínima
    'Max_Donation'      => 50,                                    // doação Maxima
    'Valor_Credito'     => 1,                                    // valor de cada credito
    'Bonus_Credito'     => 1,                                    // taxa de multiplicação de credito pelo valor pago (10 = valor da doação * 10)

    'JobClasses'                    => include('jobs.php'),


    //  IDs de classe de Homúnculo e seus nomes correspondentes.
    'HomunClasses'                  => include('homunculus.php'),

    //  Tipos de item com seus nomes correspondentes.
    'ItemTypes'                     => include('itemtypes.php'),

    //  Subtipos de item com seus nomes correspondentes.
    'ItemSubTypes'                  => include('itemsubtypes.php'),

    //  Mapeamento de tamanhos de monstros.
    'MonsterSizes'                  => include('sizes.php'),

    //  Mapeamento de raças de monstros.
    'MonsterRaces'                  => include('races.php'),

    //  Mapeamento de elementos.
    'Elements'                      => include('elements.php'),

    //  Mapeamento de atributos.
    'Attributes'                    => include('attributes.php'),

    //  Categorias de loja de itens.
    'ShopCategories'                => include('shopcategories.php'),

    //  Categorias de loja de Cash.
    'CashShopCategories'            => include('cashshopcategories.php'),

    //  Tipos de alimentação
    'FeedingTypes'                  => include('feedingtypes.php'),

    //  Nomes de castelos.
    'CastleNames'                   => include('castlenames.php'),
];


$conn = CONNECT::getInstance();
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if($config['ServerStatus'] == true && $config['ServerStatusManual'] == false){
    $servers = [
        ['ip' => CONNECT::HostDB(), 'port' => CONNECT::PortMap()],
        ['ip' => CONNECT::HostDB(), 'port' => CONNECT::PortChar()],
        ['ip' => CONNECT::HostDB(), 'port' => CONNECT::PortLogin()]
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
}else if($config['ServerStatusManual'] == true && $config['ServerStatus'] == false){

        if($config['ServerStatusOn'] == true){
             $serverStatus = 'on';
        }else{
             $serverStatus = 'off';
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
