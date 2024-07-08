<?php
require_once "config/config.php";
$title = "Doação";
/*if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    header("Location: ?to=entrar");
    exit;
} else {
    $user = $_SESSION["user"];
}*/

$accesstoken = $config['accesstoken'];
if(isset($_POST['vl'])) $amount = (float) trim($_POST['vl']);
if(isset($_POST['user_id'])) $user_id = $_POST['user_id'] ?? null;
if(isset($_POST['cpf'])) $cpf = $_POST['cpf'] ?? null;
$idempotency_key = uniqid('mp_', true);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
    (isset($_POST['pagamento']) && ($_POST['pagamento'] == 'pix' || $_POST['pagamento'] == 'cartao' || $_POST['pagamento'] == 'link'))) {
    if ($_POST['pagamento'] != "pix" && $_POST['pagamento'] != "cartao" && $_POST['pagamento'] != "link") {
                echo "<p class='messageErrorInit'>Forma de Pagamento Inválida</p>";
                exit;
    }

    if(isset($_POST['pagamento']) && $_POST['pagamento'] == 'pix'){


        if (!isset($amount) || empty($amount) || !is_numeric($amount) || $amount < $config['Min_Donation'] || $amount > $config['Max_Donation']) {
            echo "<p class='messageErrorInit'>O valor deve ser entre ".$config['Min_Donation']." e ".$config['Max_Donation'].", e não pode ser vazio.</p>";
            exit;
        }

        if (!$user_id || !is_numeric($user_id)) {
            echo "<p class='messageErrorInit'>user_id inválido</p>";
            exit;
        }

        if (!validarCPF($cpf)) {
            echo "<p class='messageErrorInit'>CPF inválido</p>";
            exit;
        }

        $payment = new Payment($user_id);
        $payCreate = $payment->addPayment($amount);

        if ($payCreate) {
            $accesstoken = $config['accesstoken'];
            $pixUrl = 'https://api.mercadopago.com/v1/payments';

            $payload = json_encode([
                'description' => 'Pagamento PIX',
                'external_reference' => $payCreate,
                'notification_url' => $config['url_notification_api'],
                'payer' => [
                    'email' => $_SESSION["email"],
                    'identification' => [
                        'type' => 'CPF',
                        'number' => $cpf
                    ]
                ],
                'payment_method_id' => 'pix',
                'transaction_amount' => $amount
            ]);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $pixUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accesstoken,
                    'X-Idempotency-Key: ' . $idempotency_key
                ]
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            $obj = json_decode($response);

            function submitFormDonate($obj) {
    echo '<form id="autoSubmitForm" action="?to=doar" method="post">';
    echo '<input type="hidden" name="qrcode" value="' . $obj->point_of_interaction->transaction_data->qr_code_base64 . '">';
    echo '<input type="hidden" name="copiaecola" value="' . $obj->point_of_interaction->transaction_data->qr_code . '">';
    echo '<input type="hidden" name="externalreference" value="' . $obj->external_reference . '">';
    echo '<input type="hidden" name="valor" value="' . $obj->transaction_amount . '">';
    echo '</form>';
    echo '<script type="text/javascript">document.getElementById("autoSubmitForm").submit();</script>';
}
        submitFormDonate($obj);
        }
    }else if(isset($_POST['pagamento']) && $_POST['pagamento'] == 'link'){



        if (!isset($amount) || empty($amount) || !is_numeric($amount) || $amount < $config['Min_Donation'] || $amount > $config['Max_Donation']) {
            echo "<p class='messageErrorInit'>O valor deve ser entre ".$config['Min_Donation']." e ".$config['Max_Donation'].", e não pode ser vazio.</p>";
            exit;
        }

        if (!$user_id || !is_numeric($user_id)) {
            echo "<p class='messageErrorInit'>user_id inválido</p>";
            exit;
        }



        $payment = new Payment($user_id);
        $payCreate = $payment->addPayment($amount);
            

        if ($payCreate) {

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.mercadopago.com/checkout/preferences',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    'back_urls' => [
                        'success' => $config['url_success'],
                        'pending' => $config['url_pending'],
                        'failure' => $config['url_failure']
                    ],
                    'external_reference' => $payCreate,
                    'notification_url' => $config['url_notification_api'],
                    'auto_return' => 'approved',
                    'items' => [[
                        'title' => $config['Name_Server'],
                        'description' => 'Dummy description',
                        'picture_url' => 'http://www.myapp.com/myimage.jpg',
                        'category_id' => 'car_electronics',
                        'quantity' => 1,
                        'currency_id' => 'BRL',
                        'unit_price' => $amount
                    ]],
                    'payment_methods' => [
                        'excluded_payment_types' => [['id' => 'ticket']]
                    ]
                ]),
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $accesstoken,
                    'X-Idempotency-Key: ' . $idempotency_key
                ],
            ]);


            if ($response = curl_exec($curl)) {
                $obj = json_decode($response);
                if (isset($obj->init_point)) {
                    echo "<script>window.location.href = '{$obj->init_point}';</script>";
                }
            } else {
                echo 'Erro na solicitação cURL: ' . curl_error($curl);
            }
            curl_close($curl);
        }
    }else if(isset($_POST['pagamento']) && $_POST['pagamento'] == 'cartao'){

        echo "<p class='messageErrorInit'>Forma de Pagamento não disponível no momento</p>";
        exit;

    }
}




?> 