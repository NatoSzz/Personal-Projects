<?php
session_start();
require '../config/authentication.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

require '../config/connection.php';

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "UPDATE usuarios SET nome = ? WHERE id = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $id]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

if ($result == true) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_sucesso"] = "Dados alterados com sucesso!";
    $_SESSION["nome"] = $nome;
    redireciona("account.php");
} elseif ($result == true && $count == 0) {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Nenhum dado foi alterado.";
    redireciona("account.php");
} else {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar alteração.";
    $_SESSION["erro"] = $error;
    redireciona("account.php");
}
?>