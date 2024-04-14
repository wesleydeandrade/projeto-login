<?php
session_start();

if(isset($_POST['email']) && isset($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if($result->num_rows > 0) {
        // Extrai o nome e o ID do resultado da consulta
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $usuario_id = $row['id'];
        
        // Armazena as informações na sessão
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $nome;
        $_SESSION['id'] = $usuario_id;

        
        header('Location: sistema.php');
        exit(); // Termina o script após o redirecionamento
    } else {
        header('Location: index.php');
        exit(); // Termina o script após o redirecionamento
    }
}
?>
