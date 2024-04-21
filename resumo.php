<?php
session_start();


if (!isset($_SESSION['id'])) {
    // se nao tiver logado manda para a pagina inicial
    header("Location: index.html");
    exit();
}

include_once('config.php');

// pega o ID
$usuario_id = $_SESSION['id'];

//Pega as informações do usuario logado
$sql = "SELECT * FROM certificado WHERE usuario_id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

// caso de erro
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
        // Exibi os certificados
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
