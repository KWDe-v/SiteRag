<?php

$title = "Lista de Itens";

if (empty($_GET["page"]) || !isset($_GET["page"])) {
    header("Location: ?&to=itens&page=1");
    exit();
}

if (isset($_GET["busca"]) || !empty($_GET["busca"])) {
    $busca = $_GET["busca"];

    try {
        if ($config["Renewal"] == false) {
            $sql = "SELECT * FROM item_db WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM item_db2 WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
        } else {
            $sql = "SELECT * FROM item_db_re WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM item_db2_re WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
        }
        $sql .= "ORDER BY id";

        $resultado = mysqli_query($conn, $sql); //

        if ($resultado->num_rows > 0) {
            $itens = [];
            while ($row = $resultado->fetch_assoc()) {
                $item = [
                    "id" => !empty($row["id"]) ? $row["id"] : "unknown",
                    "name_english" => !empty($row["name_english"])
                        ? $row["name_english"]
                        : "unknown",
                    "type" => !empty($row["type"])
                        ? strtolower($row["type"])
                        : "unknown",
                    "subtype" => !empty($row["subtype"])
                        ? strtolower($row["subtype"])
                        : "unknown",
                    "price_buy" => !empty($row["price_buy"])
                        ? $row["price_buy"]
                        : "N/A",
                    "weight" => !empty($row["weight"]) ? $row["weight"] : "N/A",
                ];
                $itens[] = $item;
            }
        } else {
            $itens = [];

            header("Location: ?to=itens&page=1&error=naoencontrado");
            exit();
        }
    } catch (Exception $e) {
        define("__ERROR__", true);
        include "fatalerror.php";
        exit();
    }
} elseif (isset($_GET["filter"]) || !empty($_GET["filter"])) {
    $filtro = $_GET["filter"];

    try {
        if ($config["Renewal"] == false) {
            $sql = "SELECT * FROM item_db WHERE type LIKE '%$filtro%'";
            $sql .= " UNION ALL ";
            $sql .= "SELECT * FROM item_db2 WHERE type LIKE '%$filtro%'";
        } else {
            $sql = "SELECT * FROM item_db_re WHERE type LIKE '%$filtro%'";
            $sql .= " UNION ALL ";
            $sql .= "SELECT * FROM item_db2_re WHERE type LIKE '%$filtro%'";
        }
        $sql .= " ORDER BY id";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado->num_rows > 0) {
            $itens = [];
            while ($row = $resultado->fetch_assoc()) {
                $item = [
                    "id" => !empty($row["id"]) ? $row["id"] : "unknown",
                    "name_english" => !empty($row["name_english"])
                        ? $row["name_english"]
                        : "unknown",
                    "type" => !empty($row["type"])
                        ? strtolower($row["type"])
                        : "unknown",
                    "subtype" => !empty($row["subtype"])
                        ? strtolower($row["subtype"])
                        : "unknown",
                    "price_buy" => !empty($row["price_buy"])
                        ? $row["price_buy"]
                        : "N/A",
                    "weight" => !empty($row["weight"]) ? $row["weight"] : "N/A",
                ];
                $itens[] = $item;
            }
        } else {
            header("Location: ?to=itens&page=1&error=naoencontrado");
            exit();
        }
    } catch (Exception $e) {
        define("__ERROR__", true);
        include "fatalerror.php";
        exit();
    }
} else {
    try {
        if ($config["Renewal"] == false) {
            $sql =
                "SELECT id, name_aegis, name_english, type, subtype, price_buy, price_sell, weight, attack, defense, `range`, slots, refineable FROM item_db ";
            $sql .= "UNION ALL ";
            $sql .=
                "SELECT id, name_aegis, name_english, type, subtype, price_buy, price_sell, weight, attack, defense, `range`, slots, refineable FROM item_db2 ";
        } else {
            $sql =
                "SELECT id, name_aegis, name_english, type, subtype, price_buy, price_sell, weight, attack, defense, `range`, slots, refineable FROM item_db_re ";
            $sql .= "UNION ALL ";
            $sql .=
                "SELECT id, name_aegis, name_english, type, subtype, price_buy, price_sell, weight, attack, defense, `range`, slots, refineable FROM item_db2_re ";
        }
        $sql .= "ORDER BY id";

        $resultado = mysqli_query($conn, $sql); //

        if ($resultado->num_rows > 0) {
            $itens = [];
            while ($row = $resultado->fetch_assoc()) {
                $item = [
                    "id" => !empty($row["id"]) ? $row["id"] : "unknown",
                    "name_english" => !empty($row["name_english"])
                        ? $row["name_english"]
                        : "unknown",
                    "type" => !empty($row["type"])
                        ? strtolower($row["type"])
                        : "unknown",
                    "subtype" => !empty($row["subtype"])
                        ? strtolower($row["subtype"])
                        : "unknown",
                    "price_buy" => !empty($row["price_buy"])
                        ? $row["price_buy"]
                        : "N/A",
                    "weight" => !empty($row["weight"]) ? $row["weight"] : "N/A",
                ];
                $itens[] = $item;
            }
        } else {
            $itens = [];
        }
    } catch (Exception $e) {
        define("__ERROR__", true);
        include "fatalerror.php";
        exit();
    }
}

$conn->close();


$items_per_page = 10;
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$total_items = count($itens);
$total_pages = ceil($total_items / $items_per_page);
$start_index = ($page - 1) * $items_per_page;
$end_index = min($start_index + $items_per_page - 1, $total_items - 1);
$paginated_items = array_slice($itens, $start_index, $items_per_page);
$current_url = $_SERVER["REQUEST_URI"];
$query_params = $_GET;
$query_params["page"] = $page + 1;
$updated_query_string_next = http_build_query($query_params);
$next_page_url = strtok($current_url, "?") . "?" . $updated_query_string_next;
$query_params["page"] = $page - 1;
$updated_query_string_prev = http_build_query($query_params);
$prev_page_url = strtok($current_url, "?") . "?" . $updated_query_string_prev;

if ($_GET["page"] > $total_pages || $_GET["page"] < 1) {
    header("Location: ?&to=error&id=404");
    exit();
}

?>
