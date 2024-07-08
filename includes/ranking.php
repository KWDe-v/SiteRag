<?php

if((!isset($_GET['type']) || empty($_GET['type'])) || ($_GET['type'] != 'zeny' && $_GET['type'] != 'pvp' && $_GET['type'] != 'pvp' && $_GET['type'] != 'mvp')){
          header("Location: ?&to=error&id=404");
        exit;
}

if ((empty($_GET["page"]) || !isset($_GET["page"])) && $_GET['type'] == 'zeny') {
    header("Location: ?to=ranking&type=zeny&page=1");
    exit;
}else if ((empty($_GET["page"]) || !isset($_GET["page"])) && $_GET['type'] == 'pvp') {
    header("Location: ?to=ranking&type=pvp&page=1");
    exit;
}else if ((empty($_GET["page"]) || !isset($_GET["page"])) && $_GET['type'] == 'mvp') {
    header("Location: ?to=ranking&type=mvp&page=1");
    exit;
}
/////////////// ZENY//////////////////

if($_GET['type'] == 'zeny'){
    $title = 'Rankink Zeny';
    $sql = "SELECT name, zeny, class, base_level, job_level, guild_id, sex  
            FROM `char` 
            ORDER BY zeny DESC, base_level DESC, job_level";
    try {
        $result = $conn->query($sql);
        $chars = array();
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $sex = $row['sex'];
            $zeny = $row['zeny'];
            $class = $row['class'];
            $base_level = $row['base_level'];
            $job_level = $row['job_level'];
            $guild_id = $row['guild_id'];
            $guild_sql = "SELECT name FROM guild WHERE guild_id = ?";
            $guild_stmt = $conn->prepare($guild_sql);
            $guild_stmt->bind_param("i", $guild_id);
            $guild_stmt->execute();
            $guild_result = $guild_stmt->get_result();
            $guild_row = $guild_result->fetch_assoc();
            $guild_name = ($guild_row) ? $guild_row['name'] : "N/A";

            $chars[] = array(

                'name' => $name,
                'zeny' => $zeny,
                'class' => $class,
                'base_level' => $base_level,
                'job_level' => $job_level,
                'guild_name' => $guild_name,
                'sex' => $sex
            );
        }
    } catch (Exception $e) {
        define('__ERROR__', true);
        include('fatalerror.php');
        exit;
    }

}elseif($_GET['type'] == 'pvp'){
    $title = 'Rankink PvP';

    try {
        $sql = "SELECT `char`.`name`, `char`.`guild_id`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`account_id`, `char`.`online`, `login`.`sex`, SUM(`pvp_arenas`.`matou`) AS total_matou, SUM(`pvp_arenas`.`morreu`) AS total_morreu, SUM(`pvp_arenas`.`pontos`) AS total_pontos FROM `pvp_arenas` LEFT JOIN `char` ON `char`.`name` = `pvp_arenas`.`nome` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id` WHERE `login`.`state` = '0' GROUP BY `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`account_id`, `char`.`online`, `login`.`sex` ORDER BY total_matou DESC, total_pontos DESC, total_morreu DESC, `char`.`base_exp`";
        $sth = $conn->query($sql);
        $chars = $sth->fetch_all(MYSQLI_ASSOC);
    } catch (Exception $e) {
        define('__ERROR__', true);
        include('fatalerror.php');
        exit;
    }
}elseif($_GET['type'] == 'mvp'){
    $title = 'Rankink MvP';
    $sql = "SELECT mvp.*, mvp.nome AS mvp_name, l.sex, c.class, c.base_level, c.job_level 
           FROM mvp 
           LEFT JOIN `char` c ON mvp.char_id = c.char_id 
           LEFT JOIN login l ON c.account_id = l.account_id 
           ORDER BY mvp.kills DESC, c.base_level DESC, c.job_level";

    try {
        $result = $conn->query($sql);
        $chars = array();
        while ($row = $result->fetch_assoc()) {
            $name = $row['mvp_name']; 
            $kill = $row['kills'];
            $class = $row['class'];
            $base_level = $row['base_level'];
            $job_level = $row['job_level'];
            $sex = $row['sex'];
            $guild_id = isset($row['guild_id']) ? $row['guild_id'] : null;  

            if ($guild_id) {
                $guild_sql = "SELECT name FROM guild WHERE guild_id = ?";
                $guild_stmt = $conn->prepare($guild_sql);

                if (!$guild_stmt) {
                    throw new Exception("Erro na preparação da consulta: " . $conn->error);
                }

                $guild_stmt->bind_param("i", $guild_id);
                $guild_stmt->execute();
                $guild_result = $guild_stmt->get_result();
                $guild_row = $guild_result->fetch_assoc();
                $guild_name = ($guild_row) ? $guild_row['name'] : "N/A";
            } else {
                $guild_name = "N/A";
            }

            $chars[] = array(
                'name' => $name,
                'kills' => $kill,
                'class' => $class,
                'base_level' => $base_level,
                'job_level' => $job_level,
                'guild_name' => $guild_name,
                'sex' => $sex
            );

                
        }
    } catch (Exception $e) {
        define('__ERROR__', true);
        include('fatalerror.php');
        exit;
    }
}
if ($chars) {
   

    $items_per_page = 10;
    $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
    $total_items = count($chars);
    $total_pages = ceil($total_items / $items_per_page);
    $start_index = ($page - 1) * $items_per_page;
    $end_index = min($start_index + $items_per_page - 1, $total_items - 1);
    $paginated_items = array_slice($chars, $start_index, $items_per_page);
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
        exit;
    }
}
if(!$chars){
    $naoEncontrado = true;
    
}

?>



