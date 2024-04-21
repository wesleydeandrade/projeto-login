<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.html');
    exit();
}

$logado = $_SESSION['nome'];
$usuario_id = $_SESSION['id']; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="estilo/sistema.css">
</head>
<body>
    <nav>
        <?php
         echo "<h1> Olá, $logado</h1>";
     ?>
        <a href="sair.php" class="sair">Sair</a>
    </nav>
    <div class="box">
        <h1>Envio de Certificação</h1>
        
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
        <input type="file" id="certificado_pdf" name="certificado_pdf" accept="pdf" required>
    </p>
    <button type="submit" class="button">Enviar Certificado</button>
    <p>
    <button type="submit" onclick="window.location.href='resumo.php'" class="voltar">Voltar</button>
    </p>
    
    
    
</form>
</fieldset>




    
   
    <script>
        // para mostrar ou ocultar em caso de vitalicia ou temporaria.
    document.addEventListener("DOMContentLoaded", function() {
        
        var validadeSelect = document.getElementById('validade');
        var dataVencimentoInput = document.getElementById('data_vencimento');

        function toggleDataVencimentoInput() {
            
            if (validadeSelect.value === 'temporaria') {
                dataVencimentoInput.style.display = 'block';
            } else {
                
                dataVencimentoInput.style.display = 'none';
            }
        }

        validadeSelect.addEventListener('change', toggleDataVencimentoInput);

        toggleDataVencimentoInput();
    });
</script>
</div>

</body>

</html>

