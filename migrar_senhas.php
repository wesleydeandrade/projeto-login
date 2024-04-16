<?php
// Incluir arquivo de configuração do banco de dados
include_once('config.php');

// Selecionar as senhas existentes da tabela de usuários
$stmt = $conexao->prepare("SELECT id, senha FROM usuarios");
$stmt->execute();
$result = $stmt->get_result();

// Iterar sobre os resultados e atualizar as senhas com hashes
while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $senha = $row['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Atualizar o registro com o hash da senha
    $stmt_update = $conexao->prepare("UPDATE usuarios SET senha_hash = ? WHERE id = ?");
    $stmt_update->bind_param("si", $senha_hash, $id);
    $stmt_update->execute();
}

// Fechar as declarações preparadas
$stmt->close();
$stmt_update->close();

echo "Migração de senhas concluída.";
?>
