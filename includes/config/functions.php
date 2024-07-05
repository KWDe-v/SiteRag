<?php

function formatarNumero($numero)
{
    return number_format($numero, 0, '.', '.');
}

function converterTempo($tempo) 
{

    $segundos = $tempo / 1000;
    $horas = floor($segundos / 3600);
    $segundos %= 3600;
    $minutos = floor($segundos / 60);
    $segundos %= 60;

    $formatado = "";
    if ($horas > 0) {
    $formatado .= $horas . ' ' . ($horas == 1 ? 'hora' : 'horas') . ' ';
    }
    if ($minutos > 0) {
        $formatado .= $minutos . ' ' . ($minutos == 1 ? 'minuto' : 'minutos') . ' ';
    }
    if ($segundos > 0) {
        $formatado .= $segundos . ' ' . ($segundos == 1 ? 'segundo' : 'segundos');
    }

    return trim($formatado);
}

function converterCores($texto) 
{
    $padrao = '/\^([0-9a-fA-F]{6})/';
    $texto = preg_replace_callback($padrao, function($matches) {
        $cor = $matches[1];
        if($cor == '777777') $cor = 'ffffff';
        if($cor == '000000') $cor = 'ffffff';
        $corHTML = '#' . $cor;
        return "<span style=\"color: $corHTML;\">"; 
    }, $texto);
    $texto = str_replace('^000000', '</span>', $texto);
    return $texto;
}

function iconImage($itemID)
{
    $localPngPath = sprintf("/img/item/icons/%d.png", $itemID);
    $localBmpPath = sprintf("/img/item/icons/%d.bmp", $itemID);

    if (file_exists($localPngPath)) {
        return preg_replace('&/{2,}&', '/', $localPngPath);
    } elseif (file_exists($localBmpPath)) {  
        return preg_replace('&/{2,}&', '/', $localBmpPath);
    } else {
        $remote_link = "https://static.divine-pride.net/images/items/item/$itemID.png";
        return $remote_link;
    }
}

function iconMapa($itemID, $id)
{
    if($id = 1){
        $remote_link = "https://www.divine-pride.net/img/map/medium/$itemID";
        return $remote_link;
    }else{
        $remote_link = "https://www.divine-pride.net/img/map/original/$itemID";
        return $remote_link;
    }
}



function npcImage($itemID)
{
    $first_link = "https://static.ragnaplace.com/db/npc/gif/$itemID.gif";
    $second_link = "https://static.divine-pride.net/images/mobs/png/$itemID.png";


    $headers = @get_headers($first_link);
    if ($headers && strpos($headers[0], '200')) {
        return $first_link . "?nocache=" . rand(); 
    } else {
        return $second_link . "?nocache=" . rand(); 
    }
}


function itemImage($itemID)
{
    $localPngPath = sprintf("img/item/collection/%d.png", $itemID);
    $localBmpPath = sprintf("img/item/collection/%d.bmp", $itemID);
    $alternativePngPath = sprintf("img/item/collection/%d.png", $itemID);  // Supondo que isso seja necessário

    if (file_exists($localPngPath)) {
        return preg_replace('&/{2,}&', '/', $localPngPath);
    } elseif (file_exists($localBmpPath)) {
        return preg_replace('&/{2,}&', '/', $localBmpPath);
    } elseif (file_exists($alternativePngPath)) {
        return preg_replace('&/{2,}&', '/', $alternativePngPath);
    } else {
        $remote_link = "https://static.divine-pride.net/images/items/collection/$itemID.png";
        return $remote_link;
    }
}

function monsterImage($monsterID)
{
    $localGifPath = sprintf("img/monsters/%d.gif", $monsterID);
    $localPngPath = sprintf("img/monsters/%d.png", $monsterID);

    if (file_exists($localGifPath)) {
        return preg_replace('&/{2,}&', '/', "$localGifPath");
    } elseif (file_exists($localPngPath)) {
        return preg_replace('&/{2,}&', '/', "$localPngPath");
    } else {
        $remoteGifLink = "https://static.ragnaplace.com/db/npc/gif/$monsterID.gif";
        $headers = get_headers($remoteGifLink, 1);

        if (strpos($headers[0], '404') !== false) {
            $remotePngLink = "https://static.divine-pride.net/images/mobs/png/$monsterID.png";
            return $remotePngLink;
        } else {
            return $remoteGifLink;
        }
    } 
}

function monsterImageIndex($monsterID)
{
    $localGifPath = sprintf("img/monsters/%d.gif", $monsterID);
    $localPngPath = sprintf("img/monsters/%d.png", $monsterID);

    if (file_exists($localGifPath)) {
        return preg_replace('&/{2,}&', '/', "$localGifPath");
    } elseif (file_exists($localPngPath)) {
        return preg_replace('&/{2,}&', '/', "$localPngPath");
    } else {
        $remotePngLink = "https://static.divine-pride.net/images/mobs/png/$monsterID.png";
        return $remotePngLink;
    }
}

function getClasse($id) {

$classes = [
    0    => 'Aprendiz',
    1    => 'Espadachim',
    2    => 'Mago',
    3    => 'Arqueiro',
    4    => 'Noviço',
    5    => 'Mercador',
    6    => 'Gatuno',
    7    => 'Cavaleiro',
    8    => 'Sacerdote',
    9    => 'Bruxo',
    10   => 'Ferreiro',
    11   => 'Caçador',
    12   => 'Mercenário',
    //13   => 'Cavaleiro (Peco)',
    14   => 'Templário',
    15   => 'monge',
    16   => 'Sábío',
    17   => 'Arruaceiro',
    18   => 'Alquimista',
    19   => 'Bardo',
    20   => 'Odalisca',
    //21   => 'Templário (Peco)',
    22   => 'Casamento',
    23   => 'Super Aprendiz',
    24   => 'Justiceiro',
    25   => 'Ninja',
    26   => 'Xmas',
    27   => 'Summer',
    28   => 'Hanbok',
    29   => 'Oktoberfest',

    4001 => 'Aprendiz T.',
    4002 => 'Espadachim T.',
    4003 => 'Mago T.',
    4004 => 'Arqueiro T.',
    4005 => 'Noviço T.',
    4006 => 'Mercador T.',
    4007 => 'Gatuno T.',
    4008 => 'Lorde',
    4009 => 'Sumo-Sacerdote',
    4010 => 'Arquimago',
    4011 => 'Mestre-Ferreiro',
    4012 => 'Atirador de Elite',
    4013 => 'Algoz',
    //4014 => 'Lorde (Peco)',
    4015 => 'Paladino',
    4016 => 'Mestre',
    4017 => 'Professor',
    4018 => 'Desordeiro',
    4019 => 'Criador',
    4020 => 'Menestrel',
    4021 => 'Cigana',
    //4022 => 'Paladino (Peco)',

    4023 => 'Bebê',
    4024 => 'Espadachim Bebê',
    4025 => 'Mago Bebê',
    4026 => 'Arqueiro Bebê',
    4027 => 'Noviço Bebê',
    4028 => 'Mercador Bebê',
    4029 => 'Gatuno Bebê',
    4030 => 'Cavaleiro Bebê',
    4031 => 'Sacerdote Bebê',
    4032 => 'Bruxo Bebê',
    4033 => 'Ferreiro Bebê',
    4034 => 'Caçador Bebê',
    4035 => 'Mercenário Bebê',
    //4036 => 'Cavaleiro Bebê (Peco)',
    4037 => 'Templário Bebê',
    4038 => 'Monge Bebê',
    4039 => 'Sábio Bebê',
    4040 => 'Arruaceiro Bebê',
    4041 => 'Alquimista Bebê',
    4042 => 'Bardo Bebê',
    4043 => 'Odalisca Bebê',
    //4044 => 'Templário Bebê (Peco)',
    4045 => 'Super Aprendiz Bebê',
    
    4046 => 'Taekwon',
    4047 => 'Mestre Taekwon',
    //4048 => 'Mestre Taekwon (Voo)',
    4049 => 'Espiritualista',

    4050 => 'Jiang Shi',
    4051 => 'Death Knight',
    4052 => 'Dark Collector',

    4054 => 'Cavaleiro Rúnico',
    4055 => 'Arcano',
    4056 => 'Sentinela',
    4057 => 'Arcebispo',
    4058 => 'Mecânico',
    4059 => 'Sicário',
    4060 => 'Cavaleiro Rúnico T.',
    4061 => 'Arcano T.',
    4062 => 'Sentinela T.',
    4063 => 'Arcebispo T.',
    4064 => 'Mecânico T.',
    4065 => 'Sicário T.',
    4066 => 'Guardião Real',
    4067 => 'Feiticeiro',
    4068 => 'Trovador',
    4069 => 'Musa',
    4070 => 'Shura',
    4071 => 'Bioquímico',
    4072 => 'Renegado',
    4073 => 'Guardião Real T.',
    4074 => 'Feiticeiro T.',
    4075 => 'Trovador T.',
    4076 => 'Musa T.',
    4077 => 'Shura T.',
    4078 => 'Bioquímico T.',
    4079 => 'Renegado T.',

    //4080 => 'Cavaleiro Rúnico (Dragão)',
    //4081 => 'Cavaleiro Rúnico T. (Dragão)',
    //4082 => 'Guardião Real (Grifo)',
    //4083 => 'Guardião Real T. (Grifo)',
    //4084 => 'Sentinela (Lobo)',
    //4085 => 'Sentinela T. (Lobo)',
    //4086 => 'Mecânico (Robô)',
    //4087 => 'Mecânico T. (Robô)',

    4096 => 'Cavaleiro Rúnico Bebê',
    4097 => 'Arcano Bebê',
    4098 => 'Sentinela Bebê',
    4099 => 'Arcebispo Bebê',
    4100 => 'Mecânico Bebê',
    4101 => 'Sicário Bebê',
    4102 => 'Guardião Real Bebê',
    4103 => 'Feiticeiro Bebê',
    4104 => 'Trovador Bebê',
    4105 => 'Musa Bebê',
    4106 => 'Shura Bebê',
    4107 => 'Bioquímico Bebê',
    4108 => 'Renegado Bebê',
    
    //4109 => 'Cavaleiro Rúnico Bebê (Dragão)',
    //4110 => 'Guardião Real Bebê (Grifo)',
    //4111 => 'Sentinela Bebê (Lobo)',
    //4112 => 'Mecânico Bebê (Robô)',
    
    4190 => 'Super Aprendiz T.',
    4191 => 'Super Aprendiz Bebê T.',
    
    4211 => 'Kagerou',
    4212 => 'Oboro',

    4215 => 'Rebelde',
    4218 => 'Summoner',

    4220 => 'Summoner Bebê',
    4222 => 'Ninja Bebê',
    4223 => 'Kagero Bebê',
    4224 => 'Oboro Bebê',
    4225 => 'Taekwon Bebê',
    4226 => 'Mestre Taekwon Bebê',
    4227 => 'Espiritualista Bebê',
    4228 => 'Justiceiro Bebê',
    4229 => 'Rebellion Bebê',
    //4238 => 'Mestre Taekwon Bebê (União)',
    
    //4238 => 'Mestre Taekwon Bebê (União)',
    4239 => 'Star Emperor',
    4240 => 'Soul Reaper',
    4241 => 'Bebê Star Emperor',
    4242 => 'Bebê Soul Reaper',

    4252 => 'Dragon Knight',
    4253 => 'Meister',
    4254 => 'Shadow Cross',
    4255 => 'Arch Mage',
    4256 => 'Cardinal',
    4257 => 'WindHawk',
    4258 => 'Imperial Guard',
    4259 => 'Biolo',
    4260 => 'Abyss Chaser',
    4261 => 'Elemental Master',
    4262 => 'Inquisitor',
    4263 => 'Troubadour',
    4264 => 'Trouvere',
];

            return $classes[$id] ?? 'Desconhecida';
        
} 
function getGuildName($guildID, $conn)
{
    $idGuild = $guildID;
    $guild = 'N/A'; // Inicializa a variável com um valor padrão

    if ($idGuild) {
        $sql = "SELECT name FROM guild WHERE guild_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $idGuild);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $guild = $row['name'] ?? 'N/A';
            }

            $stmt->close();
        } else {
            return "Erro na preparação da consulta: " . $conn->error;
        }
    }

    return $guild;
}
function formatarTelefone($telefone) {

    $telefone = preg_replace('/\D/', '', $telefone);


    if (strlen($telefone) == 11) {

        $telefone_formatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '-' . substr($telefone, 7, 4);
    } else {

        $telefone_formatado = substr($telefone, 0, 1) . ' ' . substr($telefone, 1, 4) . '-' . substr($telefone, 5, 4);
    }

    return $telefone_formatado;
}
                             
function convertLetra($str) {
    $resultado = preg_replace('/[^a-zA-Z]/', '', $str);
    return $resultado;
}


function itemType($type) {
    $tipos = [
        'ammo'          => 'Munição',
        'armor'         => 'Armadura',
        'card'          => 'Carta',
        'cash'          => 'Cash',
        'delayconsume'  => 'Consumível',
        'etc'           => 'Outros',
        'healing'       => 'Cura',
        'petarmor'      => 'Armadura de Pet',
        'petegg'        => 'Ovo de Pet',
        'shadowgear'    => 'Sombra de Equipamento',
        'usable'        => 'Utilizável',
        'weapon'        => 'Arma'
    ];

   
    asort($tipos);

   
    if (array_key_exists($type, $tipos)) {
        return $tipos[$type];
    } else {
        return 'Desconhecido'; 
    }
}

?>