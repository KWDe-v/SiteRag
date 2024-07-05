<?php

if (empty($_GET["id"]) || !isset($_GET["id"])) {
    header("Location: ?&to=error&id=404");
    exit();
}

$idmapa = $_GET["id"];

$ch = curl_init();

$url =
    "https://www.divine-pride.net/api/database/map/" .
    $idmapa .
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

if (isset($data["reason"]) && $data["reason"] == "Map not found") {
    $naoEncontrado = true;
    
}else{}

//print_r($data);

$nome = $data["name"];
$nomeDoMapa = $data["mapname"];
$mobs = $data["spawn"];
$npcs = $data["npcs"];
$title = "Visualizando";
?>
