<?php
if (!isset($_GET["id"]) && empty($_GET["id"])) {
    header("Location: ?&to=error");
    exit();
}

$iditem = $_GET["id"];
if ($config["Renewal"] == false) {
    $sql = "
        SELECT trade_nodrop, trade_notrade, trade_nostorage, trade_noguildstorage, refineable, attack, defense, slots, type, price_buy, weight, name_aegis, name_english 
        FROM item_db 
        WHERE id = '$iditem'
        UNION
        SELECT trade_nodrop, trade_notrade, trade_nostorage, trade_noguildstorage, refineable, attack, defense, slots, type, price_buy, weight, name_aegis, name_english 
        FROM item_db2 
        WHERE id = '$iditem'
    ";
} else {
    $sql = "
        SELECT trade_nodrop, trade_notrade, trade_nostorage, trade_noguildstorage, refineable, attack, defense, slots, type, price_buy, weight, name_aegis, name_english 
        FROM item_db_re 
        WHERE id = '$iditem'
        UNION
        SELECT trade_nodrop, trade_notrade, trade_nostorage, trade_noguildstorage, refineable, attack, defense, slots, type, price_buy, weight, name_aegis, name_english 
        FROM item_db2_re 
        WHERE id = '$iditem'
    ";
}

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $nomeitem = $linha["name_english"];
        $peso = $linha["weight"];
        $aegis = $linha["name_aegis"];
        $preco = $linha["price_buy"];
        $tipo = $linha["type"];
        $ataque = $linha["attack"];
        $defesa = $linha["defense"];
        $slots = $linha["slots"];
        $dropar = $linha["trade_nodrop"];
        $negociar = $linha["trade_notrade"];
        $storage = $linha["trade_nostorage"];
        $storageguild = $linha["trade_noguildstorage"];
        $refinavel = $linha["refineable"];
    }

    $preco = $preco ?? "N/A";
    $peso = $peso ?? "N/A";
    $tipo = itemType(strtolower($tipo)) ?? "N/A";
    $ataque = $ataque ?? "N/A";
    $defesa = $defesa ?? "N/A";
    $slots = $slots ?? "N/A";

    $dropar =
        $dropar === null
            ? "img/icones/POSITIVE.png"
            : "img/icones/NEGATIVE.png";
    $negociar =
        $negociar === null
            ? "img/icones/POSITIVE.png"
            : "img/icones/NEGATIVE.png";
    $storage =
        $storage === null
            ? "img/icones/POSITIVE.png"
            : "img/icones/NEGATIVE.png";
    $storageguild =
        $storageguild === null
            ? "img/icones/POSITIVE.png"
            : "img/icones/NEGATIVE.png";
    $refinavel =
        $refinavel === null
            ? "img/icones/NEGATIVE.png"
            : "img/icones/POSITIVE.png";

    if ($config["Renewal"] == false) {
        $sql = "(SELECT * FROM mob_db)
                UNION
            (SELECT * FROM mob_db2)";
    } else {
        $sql = "(SELECT * FROM mob_db_re)
                    UNION
                (SELECT * FROM mob_db2_re)";
    }

    $resultado = $conn->query($sql);

    $itemget = [];

    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            for ($i = 1; $i <= 10; $i++) {
                $drop_item_column = "drop" . $i . "_item";
                $drop_rate_column = "drop" . $i . "_rate";
                $nome = "name_english";
                $id = "id";
                if ($linha[$drop_item_column] == $aegis) {
                    $itemget[] = [
                        "Item" => $linha[$drop_item_column],
                        "Taxa de drop" => $linha[$drop_rate_column],
                        "nome" => $linha[$nome],
                        "id" => $linha[$id],
                    ];
                }
            }
        }
    }

    $ch = curl_init();
    $url =
        "https://www.divine-pride.net/api/database/Item/" .
        $iditem .
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

    $data = json_decode($jsonData, true);

    $sql = "SELECT itemdesc FROM cp_itemdesc WHERE itemid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $iditem);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $descrip = $linha["itemdesc"];
    } elseif (isset($data["description"]) && !empty($data["description"])) {
        $descrip = $data["description"];
    } else {
        $descrip = "Sem Descrição";
    }

    $textoFormatado = converterCores($descrip);
    $itensDrop = "";
    $itensDrop = isset($data["itemSummonInfoContainedIn"])
        ? $data["itemSummonInfoContainedIn"]
        : "";

    curl_close($ch);
} else {
    $naoEncontrado = true;
    $nomeitem = "Não Encontrado";
}
$title = "Visualizando $nomeitem";

?>
