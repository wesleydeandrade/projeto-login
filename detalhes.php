<?php
session_start();

include_once('config.php');

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
		}

	//exibe nome do docente dos recpectivos certificados
		$sql = "SELECT nome FROM usuarios
					WHERE id = '$id'	
				";
		$result = $conexao->query($sql);

		while ($row = $result->fetch_assoc()) {
			if ($result->num_rows > 0) {
			echo "<div class=\"cabecalho\"><h1> Docente: " . htmlspecialchars($row['nome']) . "</h1></div>";
			}else{
			echo "<p> Erro ao exibir o nome do docente </p>";
			}
		}
	
	//exibe a lista de certificados
		$sql = "SELECT id, certificado_pdf, titulo, tipo_certificado, validade FROM certificado
					WHERE usuario_id = '$id'
					ORDER BY tipo_certificado, validade
				";
		$result = $conexao->query($sql);

		if ($result->num_rows > 0) {
		    echo "<table>"; 
		    echo "<thead>";
		    echo "<tr>";
		    echo "<th>Tipo</th>";
		    echo "<th>Título</th>";
		    echo "<th>Validade</th>";
		    echo "<th>Ações</th>";
		    echo "</tr>";
		    echo "</thead>";
		    echo "<tbody>";

		    while ($row = $result->fetch_assoc()) {
		        echo "<tr>";
		        echo "<td>" . htmlspecialchars($row['tipo_certificado']) . "</td>";
		        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
		        echo "<td>" . htmlspecialchars($row['validade']) . "</td>";
		        echo "<td>";

		        if (!empty($row['certificado_pdf'])) {
		            echo "<a href='baixar_certificado.php?certificado_id=" . $row['id'] . "' target='_blank'>Visualizar</a>";
		        } else {
		            echo "(Arquivo PDF não disponível)";
		        }
		        echo "</td>";
		        echo "</tr>";
		    }

		    echo "</tbody>";
		    echo "</table>";
		} else {
		    echo "<p>Nenhum resultado encontrado!</p>";
		}
		?>
	</div>
</body>
</html>