<?php
session_start();
require '../config/authentication.php';
require '../config/connection.php';

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$urlperfil = filter_input(INPUT_POST, "urlperfil", FILTER_SANITIZE_URL);
$senha = filter_input(INPUT_POST, "senha");
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

$sql = "INSERT INTO usuarios(nome, email, urlperfil, senha) VALUES (?,?,?,?)";

try {
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$nome, $email, $urlperfil, $senha_hash]);
    
    // Se o cadastro foi bem-sucedido, buscar os dados do usuário para fazer login
    if ($result == true) {
        // Buscar o ID do usuário recém-criado
        $sql_select = "SELECT id, nome, urlperfil, admin FROM usuarios WHERE email = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->execute([$email]);
        $usuario = $stmt_select->fetch();
        
        // Criar a sessão do usuário (login automático)
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $usuario['nome'];
        $_SESSION["urlperfil"] = $usuario['urlperfil'];
        $_SESSION["id_usuario"] = $usuario['id'];
        $_SESSION["admin"] = $usuario['admin'];
        
        $_SESSION["result"] = $result;
        $_SESSION["msg_sucesso"] = "Cadastro realizado com sucesso! Você está logado.";
    }
} catch (Exception $e) {
    $result = false;
    $error = $e->getMessage();

    /* SQLSTATE[23000]: Integrity constraint violation: 1062 
    Duplicate entry 'zilomezm@gmail.com' for key 'email' */

    if (stripos($error, "Duplicate entry") !== false) {
        $error = "Atenção: o email <b>\"$email\"</b> já está registrado." . "<br>";
    }
     
    $_SESSION["result"] = $result;
    $_SESSION["msg_erro"] = "Falha ao efetuar gravação.";
    $_SESSION["erro"] = $error;
}

redireciona("../interface/home.php");
?>