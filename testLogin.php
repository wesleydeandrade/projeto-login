<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if($result->num_rows > 0) {
        // Extrai o nome do resultado da consulta
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        
        // Armazena as informações na sessão
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $nome;
        
        header('Location: sistema.php');
    } else {
        header('Location: index.php');
    }
}
?>