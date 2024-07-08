<?php
require_once "config/config.php";
// Verifique se o external_reference foi recebido via GET
if (!isset($_GET['external_reference'])) {
    http_response_code(400); // Bad Request
    echo "external_reference não foi fornecido";
    exit;
}

$external_reference = $_GET['external_reference'];

$mysqli = CONNECT::getInstance();

// Consulta SQL para obter o status do pagamento usando $external_reference
$query = $mysqli->prepare("SELECT status FROM `payment` WHERE id = ?");
$query->bind_param('i', $external_reference); // 'i' indica que $external_reference é um inteiro
$query->execute();
$result = $query->get_result();

// Verifique se o status foi encontrado no banco de dados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $payment_status = $row['status'];
    echo $payment_status;
} else {
    http_response_code(404); // Not Found
    echo "Status do pagamento não encontrado para external_reference: $external_reference";
}

?>
