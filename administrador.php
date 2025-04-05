<?php
session_start();

// Verifica se o administrador está logado
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once('config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Administradora</title>
    <link rel="stylesheet" href="estilo/administrador.css"> <!-- Arquivo CSS -->
</head>
<body>
    <nav class="navbar">
        <h1>Painel Administrativo</h1>
        <a href="sair.php" class="logout">Sair</a>
    </nav>

    <div class="container">
        <h2>Usuários e Certificados</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Profissão</th>
                    <th>Título do Certificado</th>
                    <th>Data de Certificação</th>
                    <th>Validade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para buscar os usuários e seus certificados
                $sql = "
                    SELECT 
                        usuarios.id AS usuario_id, 
                        usuarios.nome, 
                        usuarios.classe_docente AS profissao, 
                        certificado.id AS certificado_id, 
                        certificado.titulo, 
                        certificado.data_certificacao, 
                        certificado.validade, 
                        certificado.certificado_pdf
                    FROM 
                        usuarios
                    LEFT JOIN 
                        certificado ON usuarios.id = certificado.usuario_id
                ";

                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['profissao'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($row['titulo'] ?? 'Sem certificado') . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_certificacao'] ?? '-') . "</td>";
                        echo "<td>" . htmlspecialchars($row['validade'] ?? '-') . "</td>";
                        echo "<td>";
                        
                        // Botão para deletar certificado
                        if (!empty($row['certificado_pdf'])) {
                            echo "<a href='baixar_certificado.php?certificado_id=" . urlencode($row['certificado_id']) . "' class='button-view'>Visualizar</a> | ";
                            echo "<a href='deletar_certificado.php?certificado_id=" . urlencode($row['certificado_id']) . "' class='button-delete' onclick='return confirm(\"Tem certeza que deseja excluir este certificado?\");'>Excluir Certificado</a>";
                        } else {
                            echo "<span class='no-action'>Sem certificado</span>";
                        }

                        // Botão para deletar usuário
                        echo " | <a href='deletar_usuario.php?usuario_id=" . urlencode($row['usuario_id']) . "' class='button-delete' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir Usuário</a>";
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum dado encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
