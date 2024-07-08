<?php

$title = "Lista de Monstros";
if (empty($_GET["page"]) || !isset($_GET["page"])) {
    header("Location: ?&to=monstros&page=1");
    exit();
}

if (isset($_GET["busca"]) || !empty($_GET["busca"])) {
    $busca = $_GET["busca"];
    try {
        if ($config["Renewal"] == false) {
            $sql = "SELECT * FROM mob_db WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM mob_db2 WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
        } else {
            $sql = "SELECT * FROM mob_db_re WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM mob_db2_re WHERE name_english LIKE '%$busca%' OR id LIKE '%$busca%'";
        }
        $sql .= "ORDER BY id";

        $resultado = mysqli_query($conn, $sql); //

        if ($resultado->num_rows > 0) {
            $monstros = [];
            while ($row = $resultado->fetch_assoc()) {
                $monstro = [
                    "id" => $row["id"],
                    "name_aegis" => $row["name_aegis"],
                    "name_english" => $row["name_english"],
                    "level" => $row["level"],
                    "hp" => $row["hp"],
                    "sp" => $row["sp"],
                    "size" => $row["size"],
                    "race" => $row["race"],
                    "element" => $row["element"],
                    "base_exp" => $row["base_exp"],
                    "job_exp" => $row["job_exp"],
                    "mvp_exp" => $row["mvp_exp"],
                ];

                $monstros[] = $monstro;
            }
        } else {
            $monstros = [];
            header("Location: ?to=monstros&page=1&error=naoencontrado");
            exit();
        }
    } catch (Exception $e) {
        define("__ERROR__", true);
        include "fatalerror.php";
        exit();
    }
} elseif (isset($_GET["filter"]) || !empty($_GET["filter"])) {
    if ($_GET["filter"] == "mvp_exp") {
        try {
            if ($config["Renewal"] == false) {
                $sql = "SELECT * FROM mob_db WHERE mvp_exp > 1 ";
                $sql .= "UNION ALL ";
                $sql .= "SELECT * FROM mob_db2 WHERE mvp_exp > 1 ";
            } else {
                $sql = "SELECT * FROM mob_db_re WHERE mvp_exp > 1 ";
                $sql .= "UNION ALL ";
                $sql .= "SELECT * FROM mob_db2_re WHERE mvp_exp > 1 ";
            }
            $sql .= "ORDER BY id";

            $resultado = mysqli_query($conn, $sql);

            $monstros = [];
            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $monstro = [
                        "id" => $row["id"],
                        "name_aegis" => $row["name_aegis"],
                        "name_english" => $row["name_english"],
                        "level" => $row["level"],
                        "hp" => $row["hp"],
                        "sp" => $row["sp"],
                        "size" => $row["size"],
                        "race" => $row["race"],
                        "element" => $row["element"],
                        "base_exp" => $row["base_exp"],
                        "job_exp" => $row["job_exp"],
                        "mvp_exp" => $row["mvp_exp"],
                    ];
                    $monstros[] = $monstro;
                }
            }
        } catch (Exception $e) {
            define("__ERROR__", true);
            include "fatalerror.php";
            exit();
        }
    } else {
        $filter = $_GET["filter"];
        try {
            if ($config["Renewal"] == false) {
                $sql = "SELECT * FROM mob_db WHERE size LIKE '%$filter%' OR race LIKE '%$filter%' OR element LIKE '%$filter%'";
                $sql .= "UNION ALL ";
                $sql .= "SELECT * FROM mob_db2 WHERE size LIKE '%$filter%' OR race LIKE '%$filter%' OR element LIKE '%$filter%'";
            } else {
                $sql = "SELECT * FROM mob_db_re WHERE size LIKE '%$filter%' OR race LIKE '%$filter%' OR element LIKE '%$filter%'";
                $sql .= "UNION ALL ";
                $sql .= "SELECT * FROM mob_db2_re WHERE size LIKE '%$filter%' OR race LIKE '%$filter%' OR element LIKE '%$filter%'";
            }
            $sql .= "ORDER BY id";

            $resultado = mysqli_query($conn, $sql); //

            if ($resultado->num_rows > 0) {
                $monstros = [];
                while ($row = $resultado->fetch_assoc()) {
                    $monstro = [
                        "id" => $row["id"],
                        "name_aegis" => $row["name_aegis"],
                        "name_english" => $row["name_english"],
                        "level" => $row["level"],
                        "hp" => $row["hp"],
                        "sp" => $row["sp"],
                        "size" => $row["size"],
                        "race" => $row["race"],
                        "element" => $row["element"],
                        "base_exp" => $row["base_exp"],
                        "job_exp" => $row["job_exp"],
                        "mvp_exp" => $row["mvp_exp"],
                    ];

                    $monstros[] = $monstro;
                }
            } else {
                $monstros = [];
                header("Location: ?to=monstros&page=1&error=naoencontrado");
                exit();
            }
        } catch (Exception $e) {
            define("__ERROR__", true);
            include "fatalerror.php";
            exit();
        }
    }
} else {
    try {
        if ($config["Renewal"] == false) {
            $sql = "SELECT * FROM mob_db ";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM mob_db2 ";
        } else {
            $sql = "SELECT * FROM mob_db_re ";
            $sql .= "UNION ALL ";
            $sql .= "SELECT * FROM mob_db2_re ";
        }
        $sql .= "ORDER BY id";

        $resultado = mysqli_query($conn, $sql); //

        if ($resultado->num_rows > 0) {
            $monstros = [];
            while ($row = $resultado->fetch_assoc()) {
                $monstro = [
                    "id" => $row["id"],
                    "name_aegis" => $row["name_aegis"],
                    "name_english" => $row["name_english"],
                    "level" => $row["level"],
                    "hp" => $row["hp"],
                    "sp" => $row["sp"],
                    "size" => $row["size"],
                    "race" => $row["race"],
                    "element" => $row["element"],
                    "base_exp" => $row["base_exp"],
                    "job_exp" => $row["job_exp"],
                    "mvp_exp" => $row["mvp_exp"],
                ];

                $monstros[] = $monstro;
            }
        } else {
            $monstros = [];
        }
    } catch (Exception $e) {
        define("__ERROR__", true);
        include "fatalerror.php";
        exit();
    }
}

$monstros_por_pagina = 10;
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$total_monstros = count($monstros);
$total_pages = ceil($total_monstros / $monstros_por_pagina);
$start_index = ($page - 1) * $monstros_por_pagina;
$end_index = min($start_index + $monstros_por_pagina - 1, $total_monstros - 1);
$paginated_monsters = array_slice(
    $monstros,
    $start_index,
    $monstros_por_pagina
);
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
