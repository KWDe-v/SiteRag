<?php

if (!isset($_GET["id"]) && empty($_GET["id"])) {
  header("Location: ?&to=error&id=404");
    exit(); 
} 
    

 $idmonstro = $_GET["id"];
if ($config["Renewal"] == false) {
    $sql = "
            SELECT 'mvp' AS drop_type, id, mvpdrop1_item AS item, mvpdrop1_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop2_item AS item, mvpdrop2_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop3_item AS item, mvpdrop3_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop1_item AS item, drop1_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop2_item AS item, drop2_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop3_item AS item, drop3_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop4_item AS item, drop4_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop5_item AS item, drop5_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop6_item AS item, drop6_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop7_item AS item, drop7_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop8_item AS item, drop8_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop9_item AS item, drop9_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop10_item AS item, drop10_rate AS rate FROM mob_db WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop1_item AS item, mvpdrop1_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop2_item AS item, mvpdrop2_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop3_item AS item, mvpdrop3_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop1_item AS item, drop1_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop2_item AS item, drop2_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop3_item AS item, drop3_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop4_item AS item, drop4_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop5_item AS item, drop5_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop6_item AS item, drop6_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop7_item AS item, drop7_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop8_item AS item, drop8_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop9_item AS item, drop9_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop10_item AS item, drop10_rate AS rate FROM mob_db2 WHERE id = $idmonstro
            ORDER BY id
            ";
} else {
    $sql = "
            SELECT 'mvp' AS drop_type, id, mvpdrop1_item AS item, mvpdrop1_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop2_item AS item, mvpdrop2_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop3_item AS item, mvpdrop3_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop1_item AS item, drop1_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop2_item AS item, drop2_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop3_item AS item, drop3_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop4_item AS item, drop4_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop5_item AS item, drop5_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop6_item AS item, drop6_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop7_item AS item, drop7_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop8_item AS item, drop8_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop9_item AS item, drop9_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop10_item AS item, drop10_rate AS rate FROM mob_db_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop1_item AS item, mvpdrop1_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop2_item AS item, mvpdrop2_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'mvp' AS drop_type, id, mvpdrop3_item AS item, mvpdrop3_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop1_item AS item, drop1_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop2_item AS item, drop2_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop3_item AS item, drop3_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop4_item AS item, drop4_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop5_item AS item, drop5_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop6_item AS item, drop6_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop7_item AS item, drop7_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop8_item AS item, drop8_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop9_item AS item, drop9_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            UNION ALL
            SELECT 'normal' AS drop_type, id, drop10_item AS item, drop10_rate AS rate FROM mob_db2_re WHERE id = $idmonstro
            ORDER BY id
            ";
}

$resultado = $conn->query($sql);

$mvp_drops = [];
$normal_drops = [];

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        if (!empty($linha["item"]) && !empty($linha["rate"])) {
            if ($linha["drop_type"] == "mvp") {
                $mvp_drops[] = $linha;
            } else {
                $normal_drops[] = $linha;
            }
        }
    }
} else {
    $naoEncontrado = true;
    $nomeMonstro = 'Não Encontrado'; 
}

foreach ($normal_drops as $key => $drops) {
    $item = $drops["item"];

    if ($config["Renewal"] == false) {
        $sql = "(SELECT name_english, id FROM item_db WHERE name_aegis = ?)
            UNION
            (SELECT name_english, id FROM item_db2 WHERE name_aegis = ?)";
    } else {
        $sql = "(SELECT name_english, id FROM item_db_re WHERE name_aegis = ?)
            UNION
            (SELECT name_english, id FROM item_db2_re WHERE name_aegis = ?)";
    }
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $item, $item);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $nomeItem, $idItem);
    $nomesItem = [];
    while (mysqli_stmt_fetch($stmt)) {
        $nomesItem[] = [
            "name_english" => $nomeItem,
            "id" => $idItem,
        ];
    }
    mysqli_stmt_close($stmt);

    $normal_drops[$key]["items"] = $nomesItem;
}

foreach ($mvp_drops as $key => $dropsMVP) {
    $item = $dropsMVP["item"];

    if ($config["Renewal"] == false) {
        $sql = "(SELECT name_english, id FROM item_db WHERE name_aegis = ?)
            UNION
            (SELECT name_english, id FROM item_db2 WHERE name_aegis = ?)";
    } else {
        $sql = "(SELECT name_english, id FROM item_db_re WHERE name_aegis = ?)
            UNION
            (SELECT name_english, id FROM item_db2_re WHERE name_aegis = ?)";
    }
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $item, $item);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $nomeItemMVP, $idItemMVP);
    $nomesItemMVP = [];
    while (mysqli_stmt_fetch($stmt)) {
        $nomesItemMVP[] = [
            "name_english" => $nomeItemMVP,
            "id" => $idItemMVP,
        ];
    }
    mysqli_stmt_close($stmt);

    $mvp_drops[$key]["items"] = $nomesItemMVP;
}

$ch = curl_init();

$url =
    "https://www.divine-pride.net/api/database/Monster/" .
    $idmonstro .
    "?apiKey=" .
    $config["KeyDivinePride"] .
    "";

$headers = [
    "Content-Type: application/json",
    "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
    "Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7,ko;q=0.6",
    "Cache-Control: max-age=0",
    "Priority: u=0, i",
    'Sec-Ch-Ua: "Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
    "Sec-Ch-Ua-Mobile: ?1",
    'Sec-Ch-Ua-Platform: "Android"',
    "Sec-Fetch-Dest: document",
    "Sec-Fetch-Mode: navigate",
    "Sec-Fetch-Site: none",
    "Sec-Fetch-User: ?1",
    "Upgrade-Insecure-Requests: 1",
    "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Mobile Safari/537.36",
];

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$jsonData = curl_exec($ch);
curl_close($ch);
$curlDivinePride = json_decode($jsonData, true);


if(isset($curlDivinePride["spawn"])) $mapas = $curlDivinePride["spawn"];

if ($config["Renewal"] === false) {
    $sql = "(SELECT name_english, hp, sp, attack, attack2, attack_range, magic_defense, str, agi, vit, `int`, dex, luk, base_exp, job_exp, level, defense, race, size, element, element_level 
                FROM mob_db WHERE id = ?)
                UNION
                (SELECT name_english, hp, sp, attack, attack2, attack_range, magic_defense, str, agi, vit, `int`, dex, luk, base_exp, job_exp, level, defense, race, size, element, element_level 
                FROM mob_db2 WHERE id = ?)";
} else {
    $sql = "(SELECT name_english, hp, sp, attack, attack2, attack_range, magic_defense, str, agi, vit, `int`, dex, luk, base_exp, job_exp, level, defense, race, size, element, element_level 
                FROM mob_db_re WHERE id = ?)
                UNION
                (SELECT name_english, hp, sp, attack, attack2, attack_range, magic_defense, str, agi, vit, `int`, dex, luk, base_exp, job_exp, level, defense, race, size, element, element_level 
                FROM mob_db2_re WHERE id = ?)";
}

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $idmonstro, $idmonstro);

    $stmt->execute();

    $resultado = $stmt->get_result();

    while ($linha = $resultado->fetch_assoc()) {
        $hp = $linha["hp"];
        $atkMin = $linha["attack"];
        $atkMax = $linha["attack2"];
        $range = $linha["attack_range"];
        $defM = $linha["magic_defense"];
        $str = $linha["str"];
        $agi = $linha["agi"];
        $vit = $linha["vit"];
        $int = $linha["int"];
        $dex = $linha["dex"];
        $luk = $linha["luk"];
        $expBase = $linha["base_exp"];
        $expJob = $linha["job_exp"];
        $lvl = $linha["level"];
        $def = $linha["defense"];
        $race = $linha["race"];
        $size = $linha["size"];
        $element = $linha["element"];
        $element_lvl = $linha["element_level"];
        $nomeMonstro = $linha["name_english"];
    }
    $stmt->close();
} else {
    if (!(isset($curlDivinePride["reason"]) && $curlDivinePride["reason"] == "Monster not found")) {
        
        $hp = formatarNumero($curlDivinePride["stats"]["health"]);
        $sp = $curlDivinePride["stats"]["sp"];
        $atkMin = formatarNumero($curlDivinePride["stats"]["attack"]["minimum"]);
        $atkMax = formatarNumero($curlDivinePride["stats"]["attack"]["maximum"]);
        $range = $curlDivinePride["stats"]["attackRange"];
        $flee = $curlDivinePride["stats"]["flee"];
        $defMtk = $curlDivinePride["stats"]["magicDefense"];
        $hit = $curlDivinePride["stats"]["hit"];
        $str = $curlDivinePride["stats"]["str"];
        $agi = $curlDivinePride["stats"]["agi"];
        $vit = $curlDivinePride["stats"]["vit"];
        $int = $curlDivinePride["stats"]["int"];
        $dex = $curlDivinePride["stats"]["dex"];
        $luk = $curlDivinePride["stats"]["luk"];
        $expBase = formatarNumero($curlDivinePride["stats"]["baseExperience"]);
        $expJob = formatarNumero($curlDivinePride["stats"]["jobExperience"]);
        $lvl = $curlDivinePride["stats"]["level"];
        $def = $curlDivinePride["stats"]["defense"];
        $nomeMonstro = $curlDivinePride["name"];
    }else{
       $naoEncontrado = true;
       $nomeMonstro = 'Não Encontrado'; 
    }
}

$elementos = [
    "Neutral" => "Neutro",
    "Water" => "Água",
    "Earth" => "Terra",
    "Fire" => "Fogo",
    "Wind" => "Vento",
    "Poison" => "Veneno",
    "Holy" => "Sagrado",
    "Dark" => "Sombrio",
    "Ghost" => "Fantasma",
    "Undead" => "Maldito",
];

$racas = [
    "Formless" => "Amorfo",
    "Undead" => "Morto-vivo",
    "Brute" => "Bruto",
    "Plant" => "Planta",
    "Insect" => "Inseto",
    "Fish" => "Peixe",
    "Demon" => "Demônio",
    "Demihuman" => "Humanóide",
    "Angel" => "Anjo",
    "Dragon" => "Dragão",
];

$tamanhos = [
    "Small" => "Pequeno",
    "Medium" => "Médio",
    "Large" => "Grande",
];

$title = "Visualizando $nomeMonstro";
?>
