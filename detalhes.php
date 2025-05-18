<?php
session_start();
include_once('config.php');

// Funções de cálculo de pontos
function calcularDias($inicio, $fim) {
    if (!$inicio || !$fim) return 0;
    $data1 = new DateTime($inicio);
    $data2 = new DateTime($fim);
    return $data1->diff($data2)->days;
}

function calcular_pontos($tipo, $horas = 0, $data_ini = null, $data_fim = null) {
    $tipo = strtolower($tipo);

    if (str_contains($tipo, 'concurso público de outros municípios')) return 10;
    if (str_contains($tipo, 'concurso público no município')) return 1;
    if (str_contains($tipo, 'licenciatura')) return 1;
    if (str_contains($tipo, 'pós-graduação')) return 1;
    if (str_contains($tipo, 'mestrado')) return 3;
    if (str_contains($tipo, 'doutorado')) return 5;
    if (str_contains($tipo, 'não oferecidos pela secretaria')) return 0.005 * $horas;
    if (str_contains($tipo, 'oferecidos pela secretaria')) return 0.010 * $horas;
    if (str_contains($tipo, 'tempo serviço')) {
        $dias = calcularDias($data_ini, $data_fim);
        return 0.005 * $dias;
    }
    if (str_contains($tipo, 'assiduidade')) return 3;
    if (str_contains($tipo, 'frequência em htpc')) return 2;

    return 0;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Certificados</title>
	<link rel="stylesheet" href="estilo/detalhes.css"> 
</head>
<body>
	<div>
		<?php
		if (isset($_POST['id_usuario'])){
			$id = $_POST['id_usuario'];
		} else {
			echo "<p>ID do usuário não informado.</p>";
			exit;
		}

		// Exibe nome do docente
		$sql = "SELECT nome FROM usuarios WHERE id = ?";
		$stmt = $conexao->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($row = $result->fetch_assoc()) {
			echo "<div class=\"cabecalho\"><h1> Docente: " . htmlspecialchars($row['nome']) . "</h1></div>";
		} else {
			echo "<p> Erro ao exibir o nome do docente </p>";
		}

		// Exibe os certificados
		$sql = "SELECT id, certificado_pdf, titulo, tipo_certificado, validade, data_certificacao, data_vencimento, quantidade_horas FROM certificado
				WHERE usuario_id = ?
				ORDER BY tipo_certificado, validade";
		$stmt = $conexao->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
		    echo "<table>"; 
		    echo "<thead>";
		    echo "<tr>";
		    echo "<th>Tipo</th>";
		    echo "<th>Título</th>";
		    echo "<th>Validade</th>";
		    echo "<th>Pontuação</th>";
		    echo "<th>Ações</th>";
		    echo "</tr>";
		    echo "</thead>";
		    echo "<tbody>";

		    while ($row = $result->fetch_assoc()) {
		        $pontos = calcular_pontos(
		            $row['tipo_certificado'],
		            $row['quantidade_horas'],
		            $row['data_certificacao'],
		            $row['data_vencimento']
		        );

		        echo "<tr>";
		        echo "<td>" . htmlspecialchars($row['tipo_certificado']) . "</td>";
		        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
		        echo "<td>" . htmlspecialchars($row['validade']) . "</td>";
		        echo "<td>" . number_format($pontos, 2, ',', '.') . "</td>";
		        echo "<td>";

		        if (!empty($row['certificado_pdf'])) {
		            echo "<a href='baixar_certificado.php?certificado_id=" . urlencode($row['id']) . "' target='_blank'>Visualizar</a> | ";
		        }

		        echo "<a href='deletar_certificado.php?certificado_id=" . urlencode($row['id']) . "' onclick='return confirm(\"Tem certeza que deseja excluir este certificado?\");'>Excluir</a>";

		        echo "</td>";
		        echo "</tr>";
		    }

		    echo "</tbody>";
		    echo "</table>";
		} else {
		    echo "<p>Nenhum certificado encontrado.</p>";
		}
		?>
	</div>
</body>
</html>