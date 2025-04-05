<?php
include_once("config.php");

if (isset($_GET['certificado_id'])) {
    $certificado_id = $_GET['certificado_id'];

    // Preparar o comando SQL para excluir o certificado
    $stmt = $conexao->prepare("DELETE FROM certificado WHERE id = ?");
    $stmt->bind_param("i", $certificado_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: administrador.php?message=" . urlencode("Certificado excluído com sucesso!"));
    } else {
        header("Location: administrador.php?message=" . urlencode("Erro ao excluir certificado."));
    }

    $stmt->close();
} else {
    header("Location: administrador.php?message=" . urlencode("ID do certificado não fornecido."));
}

$conexao->close();
?>
