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
    <link rel="stylesheet" href="estilo/terra.css">
    
   
</head>
    
<body>
    <nav>
        <?php
         echo "<h1> Olá, $logado</h1>";
     ?>
        <a href="sair.php" class="sair">Sair</a>
    </nav>



    <div class = "box">
    <h1>Acessou o sistema</h1>
    
    <h2>Envio de Certificação</h2>
<fieldset>
<legend>Registro de Certificação</legend>
<form id="formulario" action="processar_certificado.php" method="POST" enctype="multipart/form-data">
<input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario_id; ?>">

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
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Seleciona o elemento de seleção de validade
        var validadeSelect = document.getElementById('validade');
        // Seleciona o campo de entrada de data de vencimento
        var dataVencimentoInput = document.getElementById('data_vencimento');

        // Define uma função para ser chamada quando a seleção de validade é alterada
        function toggleDataVencimentoInput() {
            // Se a opção selecionada for 'Temporária', mostra o campo de entrada de data de vencimento
            if (validadeSelect.value === 'temporaria') {
                dataVencimentoInput.style.display = 'block';
            } else {
                // Caso contrário, oculta o campo de entrada de data de vencimento
                dataVencimentoInput.style.display = 'none';
            }
        }

        // Chama a função toggleDataVencimentoInput() quando a seleção de validade é alterada
        validadeSelect.addEventListener('change', toggleDataVencimentoInput);

        // Chama a função toggleDataVencimentoInput() para garantir que o estado inicial seja correto
        toggleDataVencimentoInput();
    });
</script>
</div>
</body>

</html>

