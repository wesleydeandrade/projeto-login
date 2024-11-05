<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
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
    <script>
        function toggleHorasField() {
            var tipoCertificado = document.getElementById('tipo_certificado').value;
            var quantidadeHorasContainer = document.getElementById('quantidade_horas_container');
            // Mostrar ou ocultar o campo com base na seleção
            quantidadeHorasContainer.style.display = (tipoCertificado === 'certificados_cursos_nao_secretaria' || tipoCertificado === 'certificados_cursos_secretaria') ? 'block' : 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            var validadeSelect = document.getElementById('validade');
            var dataVencimentoInput = document.getElementById('data_vencimento');

            function toggleDataVencimentoInput() {
                dataVencimentoInput.style.display = (validadeSelect.value === 'temporaria') ? 'block' : 'none';
            }

            validadeSelect.addEventListener('change', toggleDataVencimentoInput);
            toggleDataVencimentoInput();
        });
    </script>
</head>
<body>
    <nav>
        <?php
        echo "<h1>Olá, $logado</h1>";
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
                    <strong>Nome do Usuário:</strong> <?php echo htmlspecialchars($logado); ?>
                </p>

                <p>
                    <label for="titulo">Título da Certificação:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </p>

                <p>
                    <label for="tipo_certificado">Tipo de Certificado:</label>
                    <select id="tipo_certificado" name="tipo_certificado" required onchange="toggleHorasField()">
                            <option value="certificado_aprovacao_concurso_outros">Certificado de Aprovação em Concurso Público de outros Municípios</option>
                            <option value="certificado_aprovacao_concurso_municipio">Certificado de Aprovação em Concurso Público no Município</option>
                            <option value="diploma_licenciatura">Diplomas/habilitação em curso de Licenciatura</option>
                            <option value="certificado_pos_graduacao">Certificado de Pós-graduação lato sensu</option>
                            <option value="diploma_mestrado">Diploma de Mestrado</option>
                            <option value="diploma_doutorado">Diploma de Doutorado</option>
                            <option value="certificados_cursos_nao_secretaria">Certificados de Cursos de treinamento/formação/especialização NÃO oferecidos pela secretaria de Educação do Município de Monte Azul Paulista</option>
                            <option value="certificados_cursos_secretaria">Certificados de Cursos de treinamento/formação/especialização oferecidos pela secretaria de Educação do Município de Monte Azul Paulista</option>
                            <option value="certidao_tempo_servico">Certidão tempo serviço</option>
                            <option value="certidao_assiduidade">Certidão Assiduidade</option>
                            <option value="certidao_frequencia_htpc">Certidão frequência em HTPC</option>
                            <option value="outros_documentos">Outros documentos</option>
                    </select>
                </p>

                <!-- Campo para quantidade de horas -->
                <p id="quantidade_horas_container" style="display: none;">
                    <label for="quantidade_horas">Quantidade de Horas:</label>
                    <input type="number" id="quantidade_horas" name="quantidade_horas" min="1" step="1">
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

                <button type="submit" class="button">Enviar Certificado</button>
                <p>
                    <button type="button" onclick="window.location.href='resumo.php'" class="voltar">Voltar</button>
                </p>
            </form>
        </fieldset>
    </div>
</body>
</html>
