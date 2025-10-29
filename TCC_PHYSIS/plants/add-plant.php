<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona("../index.php");
    die();
}

require '../config/connection.php';

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$urlfoto = filter_input(INPUT_POST, "urlfoto", FILTER_SANITIZE_URL);
$descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_SPECIAL_CHARS);
$especie = filter_input(INPUT_POST, "especie", FILTER_SANITIZE_NUMBER_INT);
$altura = filter_input(INPUT_POST, "altura", FILTER_SANITIZE_SPECIAL_CHARS);
$uso = filter_input(INPUT_POST, "uso", FILTER_SANITIZE_SPECIAL_CHARS);
$solo = filter_input(INPUT_POST, "solo", FILTER_SANITIZE_SPECIAL_CHARS);
$locali = filter_input(INPUT_POST, "locali", FILTER_SANITIZE_SPECIAL_CHARS);
$plantio = filter_input(INPUT_POST, "plantio", FILTER_SANITIZE_SPECIAL_CHARS);
$rega = filter_input(INPUT_POST, "rega", FILTER_SANITIZE_SPECIAL_CHARS);
$adubacao = filter_input(INPUT_POST, "adubacao", FILTER_SANITIZE_SPECIAL_CHARS);
$poda = filter_input(INPUT_POST, "poda", FILTER_SANITIZE_SPECIAL_CHARS);
$dificuldade = filter_input(INPUT_POST, "dificuldade", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "INSERT INTO plantas(nome, urlfoto, descricao, altura, uso, solo, locali, plantio, rega, adubacao, poda, dificuldade, id_especie, id_usuario) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([
        $nome, $urlfoto, $descricao, $altura, $uso, $solo, $locali, 
        $plantio, $rega, $adubacao, $poda, $dificuldade, $especie, id_usuario()
    ]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

if ($result == true) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_sucesso"] = "Dados gravados com sucesso!";
} else {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar gravação.";
    $_SESSION["erro"] = $error;
}

redireciona("form-register-plants.php");
?>