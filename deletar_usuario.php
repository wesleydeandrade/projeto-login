<?php
include_once("config.php");

if (isset($_GET['usuario_id'])) {
    $usuario_id = $_GET['usuario_id'];

    // Preparar o comando SQL para excluir o usuário
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: administrador.php?message=" . urlencode("Usuário excluído com sucesso!"));
    } else {
        header("Location: administrador.php?message=" . urlencode("Erro ao excluir usuário."));
    }

    $stmt->close();
} else {
    header("Location: administrador.php?message=" . urlencode("ID do usuário não fornecido."));
}

$conexao->close();
?>
