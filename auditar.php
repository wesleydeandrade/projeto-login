<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once('config.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verificação de Certificados</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<link rel="stylesheet" href="estilo/auditar.css">

</head>
<body>
	<div class="cabaçalho">
		<h1>Análise de Certificados</h1>
		<a href="sair.php" class="btn-sair">
			<span class="icone-sair"><i class="bi bi-door-open"></i></span>
			<span class="txt-sair">Sair</span>
		</a>
	</div>

	<nav class="painel-lateral">
		<ul>
			<li class="item-painel">
				<p>Classes de Docentes</p>
			</li>
			<li class="item-painel"> <!--professor de creche-->
				<a href="#creche">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Creche</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de ativ complementares-->
				<a href="#complementares">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Atv. Complementares</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de educ infantil-->
				<a href="#infantil">
					<span class="icone"><i class="bi bi-folder"></i></i></span>
					<span class="txt-link">Prof. Educ. Infantil</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de ens fundamental-->
				<a href="#fundamental">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Ens. Fundamental</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de educ básica-->
				<a href="#basica1">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica I</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de música-->
				<a href="#musica">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Música</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de ciências-->
				<a href="#ciencias">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Ciências</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de educ artística-->
				<a href="#educ-artistica">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Educ. Artística</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de educ física-->
				<a href="#educ-fisica">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Educ. Física</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de espanhol-->
				<a href="#espanhol">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Espanhol</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de geografia-->
				<a href="#geografia">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Geografia</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de história-->
				<a href="#historia">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - História</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de inglês-->
				<a href="#ingles">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Inglês</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de matemática-->
				<a href="#matematica">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Matemática</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de português-->
				<a href="#portugues">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Português</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de educ especial-->
				<a href="#educ-especial">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Educ. Especial</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor de judo-->
				<a href="#judo">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Educ. Básica II - Judô</span>
				</a>
			</li>
			<li class="item-painel"> <!--professor adjunto-->
				<a href="#adjunto">
					<span class="icone"><i class="bi bi-folder"></i></span>
					<span class="txt-link">Prof. Adjunto</span>
				</a>
			</li>
		</ul>
	</nav>

	<!--conteúdo referente as classes dos docentes-->
	<div class="corpo">
		<h2>Lista de Docentes</h2>
		
		<?php
		//Professor de Creche
			echo "<h3><span id=\"creche\">Professor de Creche<span></h3>";
			  //consulta ao banco de dados para a classe
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Creche'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}
		
		//Professor de Atividades Complementares
			echo "<h3><span id=\"complementares\">Professor de Atividades Complementares<span></h3>";
			  //consulta ao banco de dados para a classe
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Atividades Complementares'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			  	echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			  	echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			  	echo "<p><button class=\"btn-certicado\"type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			  	echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}

		//Professor de Educação Infantil
			echo "<h3><span id=\"infantil\">Professor de Educação Infantil<span></h3>";
			  //consulta ao banco de dados para a classe
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Infantil'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}

		//Professor de Ensino Fundamental
			echo "<h3><span id=\"fundamental\">Professor de Ensino Fundamental<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Ensino Fundamental I'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}

		//Professor de Educação Básica I
			echo "<h3><span id=\"basica1\">Professor de Educação Básica I<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica I'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Música
			echo "<h3><span id=\"musica\">Professor de Educação Básica II - Música<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Música'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Ciências
			echo "<h3><span id=\"ciencias\">Professor de Educação Básica II - Ciências<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Ciências'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Educação Artística
			echo "<h3><span id=\"educ-artistica\">Professor de Educação Básica II - Educação Artística<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Educação Artística'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Educação Física
			echo "<h3><span id=\"educ-fisica\">Professor de Educação Básica II - Educação Física<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Educação Física'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Espanhol
			echo "<h3><span id=\"espanhol\">Professor de Educação Básica II - Espanhol<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Espanhol'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Geografia
			echo "<h3><span id=\"geografia\">Professor de Educação Básica II - Geografia<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Geografia'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - História
			echo "<h3><span id=\"historia\">Professor de Educação Básica II - História<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - História'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Inglês
			echo "<h3><span id=\"ingles\">Professor de Educação Básica II - Inglês<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Inglês'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Matemática
			echo "<h3><span id=\"matematica\">Professor de Educação Básica II - Matemática<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome,id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Matemática'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Português
			echo "<h3><span id=\"portugues\">Professor de Educação Básica II - Português<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Português'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Educação Especial
			echo "<h3><span id=\"educ-especial\">Professor de Educação Básica II - Educação Especial<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Educação Especial'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor de Educação Básica II - Judô
			echo "<h3><span id=\"judo\">Professor de Educação Básica II - Judô<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor de Educação Básica II - Judô'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	

		//Professor Adjunto
			echo "<h3><span id=\"adjunto\">Professor Adjunto<span></h3>";
			  //consulta ao banco de dados para a classe 
			$sql = "SELECT nome, id FROM usuarios
				WHERE classe_docente = 'Professor Adjunto'
				ORDER BY nome";
			$result = $conexao->query($sql);

			// Verifica se a consulta teve sucesso
			if ($result->num_rows > 0) {

			  // Mostra os resultados
			  while($row = $result->fetch_assoc()) {
			    echo "<form action=\"detalhes.php\" method=\"post\" target=\"_blank\">";
			    echo "<input type=\"hidden\" name=\"id_usuario\" value=\"" . htmlspecialchars($row['id']) . "\">";
			    echo "<p><button class=\"btn-certicado\" type=\"submit\">Certificações</button> " . htmlspecialchars($row['nome']) . "</p>";
			    echo "</form>";
			  }
			} else {
			  echo "<p>Nenhum resultado encontrado!</p>";
			}	
			//fecha a conexão
			$conexao->close();
		?>
	</div>
</body>
</html>