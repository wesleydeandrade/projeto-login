<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
    header('Location: index.php');
    exit();
}

$logado = $_SESSION['nome'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="estilo/sistema.css">
   
</head>
<body>
    <div class = "box">
    <h1>Acessou o sistema</h1>
    <?php
    echo "<h1> Olá, $logado</></h1>";
    ?>
    <h2>Envio de Certificação</h2>
    <fieldset>
    <legend>Registro de Certificação</legend>
    <form id="formulario" action="processar_certificado.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="titulo">Título da Certificação:</label>
            <input type="text" id="titulo" name="titulo" required>
        </p>
        <p>
            <label for="data_certificacao">Data da Certificação:</label>
            <input type="date" id="data_certificacao" name="data_certificacao" required>
        </p>
        <p>
            <label for="validade">Validade:</label>
            <select id="validade" name="validade" required>
                <option value="vitalicia">Vitalícia</option>
                <option value="temporaria">Temporária</option>
            </select>
            <input type="date" id="data_vencimento" name="data_vencimento" placeholder="Data de vencimento">
        </p>
        <p>
            <label for="certificado_pdf">Certificado (PDF):</label>
            <input type="file" id="certificado_pdf" name="certificado_pdf" accept="application/pdf" required>
        </p>
        <button type="submit">Enviar Certificado</button>
    </form>
    </fieldset>
    
    <!-- Caixa de resumo -->
    <div id="resumo"></div>

    <script>
        document.getElementById('formulario').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            // Obtém os valores dos campos do formulário
            var titulo = document.getElementById('titulo').value;
            var dataCertificacao = document.getElementById('data_certificacao').value;
            var validade = document.getElementById('validade').value;
            var dataVencimento = document.getElementById('data_vencimento').value;
            var certificadoPdf = document.getElementById('certificado_pdf').files[0].name;

            // Monta o resumo das informações
            var resumo = "Título da Certificação: " + titulo + "<br>";
            resumo += "Data da Certificação: " + dataCertificacao + "<br>";
            resumo += "Validade: " + validade;
            if (validade === 'temporaria') {
                resumo += " (até " + dataVencimento + ")";
            }
            resumo += "<br>";
            resumo += "Certificado (PDF): " + certificadoPdf;

            // Exibe o resumo na caixa
            var resumoDiv = document.getElementById('resumo');
            resumoDiv.innerHTML = resumo;
            resumoDiv.style.display = 'block';

            // Limpa os campos do formulário
            document.getElementById('formulario').reset();
        });
    </script>
    </div>
</body>

</html>

