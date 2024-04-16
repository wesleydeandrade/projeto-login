<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    // Redirecionar o usuário para a página de login se não estiver logado
    header("Location: index.php");
    exit();
}

include_once('config.php');

// Recuperar o ID do usuário da sessão
$usuario_id = $_SESSION['id'];

// Consulta SQL para recuperar os formulários enviados pelo usuário atual
$sql = "SELECT * FROM certificado WHERE usuario_id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar se há erro na execução da consulta
if (!$resultado) {
    die("Erro ao executar consulta: " . $conexao->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Certificados</title>
    <link rel="stylesheet" href="estilo/resumo.css"> 
</head>
<body>

    <nav>
        <h1>Olá, <?php echo $_SESSION['nome']; ?></h1>
        <a href="sair.php" class="sair">Sair</a>
       
    </nav>

    <h1>Meus Certificados</h1>
    
    
    <button class="button-submit" type="button" onclick="window.location.href='sistema.php'">Registrar Certificado</button>
    
       

    <div class="box">
    
        <?php
        // Se houver certificados para exibir
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                echo "<fieldset>";
                echo "<legend>Certificado</legend>";
                echo "<h2>" . $row['titulo'] . "</h2>";
                echo "<p><strong>Data de Certificação:</strong> " . $row['data_certificacao'] . "</p>";
                echo "<p><strong>Validade:</strong> " . $row['validade'] . "</p>";
                echo "<p><strong>Arquivo:</strong> <a href='baixar_certificado.php?certificado_id=" . $row['id'] . "' target='_blank'>Acessar Certificado</a></p>";


               
                echo "</fieldset>";
            }
        } else {
            echo "<p>Nenhum certificado encontrado.</p>";
        }
        ?>
        
    </div>
    


    
    
</body>
</html>
