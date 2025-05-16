<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once('config.php');

if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

$usuario_id = $_SESSION['id'];

$sql_usuario = "SELECT nome, classe_docente FROM usuarios WHERE id = ?";
$stmt_usuario = $conexao->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $usuario_id);
$stmt_usuario->execute();
$resultado_usuario = $stmt_usuario->get_result();

if ($resultado_usuario->num_rows === 0) {
    echo "Usuário não encontrado.";
    exit();
}

$usuario = $resultado_usuario->fetch_assoc();

$sql_certificados = "SELECT * FROM certificado WHERE usuario_id = ?";
$stmt_certificados = $conexao->prepare($sql_certificados);
$stmt_certificados->bind_param("i", $usuario_id);
$stmt_certificados->execute();
$resultado_certificados = $stmt_certificados->get_result();

$tipos_certificado = [
    "certificado_aprovacao_concurso_outros" => "Certificado de Aprovação em Concurso Público de Outros Municípios",
    "certificado_aprovacao_concurso_municipio" => "Certificado de Aprovação em Concurso Público no Município",
    "diploma_licenciatura" => "Diploma de Licenciatura",
    "certificado_pos_graduacao" => "Certificado de Pós-graduação Lato Sensu",
    "diploma_mestrado" => "Diploma de Mestrado",
    "diploma_doutorado" => "Diploma de Doutorado",
    "certificados_cursos_nao_secretaria" => "Certificados de Cursos Não Oferecidos pela Secretaria de Educação",
    "certificados_cursos_secretaria" => "Certificados de Cursos Oferecidos pela Secretaria de Educação",
    "certidao_tempo_servico" => "Certidão de Tempo de Serviço",
    "certidao_assiduidade" => "Certidão de Assiduidade",
    "certidao_frequencia_htpc" => "Certidão de Frequência em HTPC",
    "outros_documentos" => "Outros Documentos"
];
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
    <h1>Olá, <?php echo htmlspecialchars($usuario['nome']); ?></h1>
    <p><?php echo htmlspecialchars($usuario['classe_docente']); ?></p>
    <a href="sair.php">Sair</a>
</nav>

<h1>Meus Certificados</h1>

<a href="sistema.php" class="button-submit">Registrar Certificado</a>

<div class="box">
<?php
if ($resultado_certificados->num_rows > 0) {
    $total_pontuacao = 0;

    while ($row = $resultado_certificados->fetch_assoc()) {
        echo "<fieldset>";
        echo "<legend>Certificado</legend>";
        echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
        echo "<p><strong>Data de Certificação:</strong> " . htmlspecialchars($row['data_certificacao']) . "</p>";
        echo "<p><strong>Validade:</strong> " . htmlspecialchars($row['validade']) . "</p>";

        $tipo_certificado = $row['tipo_certificado'] ?? '';
        $tipo_certificado_nome = $tipos_certificado[$tipo_certificado] ?? "Tipo de Certificado Desconhecido";

        echo "<p><strong>Tipo de Certificado:</strong> " . $tipo_certificado_nome . "</p>";

        if (!empty($row['quantidade_horas'])) {
            echo "<p><strong>Quantidade de Horas:</strong> " . htmlspecialchars($row['quantidade_horas']) . "</p>";
        }

        $pontuacao_formatada = number_format($row['pontuacao'], 3);
        echo "<p><strong>Pontuação:</strong> " . $pontuacao_formatada . "</p>";

        echo "<p><a href='baixar_certificado.php?certificado_id=" . $row['id'] . "' target='_blank'>Acessar Certificado (PDF)</a></p>";
        echo "</fieldset>";

        $total_pontuacao += $row['pontuacao'];
    }

    echo "<h2>Total de Pontos: " . number_format($total_pontuacao, 3) . "</h2>";

} else {
    echo "<p>Nenhum certificado encontrado.</p>";
}
?>
</div>

</body>
</html>
