<?php
session_start();
require '../config/authentication.php';
require '../config/connection.php';

if (!autenticado()) {
    $_SESSION["restrito"] = true;
    redireciona();
    die();
}

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (id_usuario() != $id && !admin()) {
    $_SESSION["result"] = false;
    $_SESSION["erro"] = "Você está tentando excluir um usuário que não é o seu.";
    $_SESSION["msg_erro"] = "Operação não permitida.";
    redireciona("../user/account.php");
    die();
}

$sql = "DELETE FROM usuarios WHERE id = ?";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();
}

$count = $stmt->rowCount();

if ($result == true && $count >= 1) {
    //$_SESSION["result"] = $result;
    //$_SESSION["msg_sucesso"] = "Dados excluídos com sucesso!";
    if (!admin()) {
        redireciona("../config/sair.php");
    }
} elseif ($count == 0) {
    $_SESSION["result"] = false;
    $_SESSION["msg_erro"] = "Não foi encontrado nenhum registro com o ID = $id";
} else {
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar exclusão.";
    $_SESSION["erro"] = $error;
}

if (admin()) {
    redireciona("../admin/list-users.php");
} else {
    redireciona("../index.php");
    unset($_SESSION["email"]);
}
?>