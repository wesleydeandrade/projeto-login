function togglePassword() {
    var senhaInput = document.getElementById("senha");
    var toggleIcon = document.getElementById("toggleIcon");
    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        senhaInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

function verificarRequisitosSenha() {
    // Código de verificação dos requisitos de senha
}

function validarSenha() {
    var senha = document.getElementById("senha").value;
    var confirmarSenha = document.getElementById("confirmar_senha").value;
    var senhaError = document.getElementById("senhaError");

    if (senha !== confirmarSenha) {
        senhaError.textContent = "As senhas não coincidem.";
        return false; // Impede o envio do formulário
    } else {
        senhaError.textContent = ""; // Limpa a mensagem de erro
        return true; // Permite o envio do formulário
    }
}
function verificarRequisitosSenha() {
var senha = document.getElementById("senha").value;
var senhaRequisitos = document.getElementById("senhaRequisitos");

// Texto com os requisitos da senha
var requisitos = [
"A senha deve ter pelo menos 8 caracteres",
"Deve conter letras maiúsculas",
"Deve conter letras minúsculas",
"Deve conter números",
"Deve conter caracteres especiais"
];

var requisitosAtendidos = [
senha.length >= 8,
/[A-Z]/.test(senha),
/[a-z]/.test(senha),
/\d/.test(senha),
/[^A-Za-z0-9]/.test(senha)
];

// Construir a string de requisitos
var requisitosString = "";
for (var i = 0; i < requisitos.length; i++) {
// Inicia a string do requisito
requisitosString += "- ";

// Adiciona o texto do requisito
requisitosString += "<span";

// Se o requisito for atendido, adiciona a classe para tornar o texto verde
if (requisitosAtendidos[i]) {
requisitosString += " style='color:green'";
}

// Fecha a tag do span e adiciona o texto do requisito
requisitosString += ">" + requisitos[i] + "</span>";

// Se o requisito for atendido, adiciona o símbolo de verificação
if (requisitosAtendidos[i]) {
requisitosString += " ✓";
}

// Adiciona uma quebra de linha entre os requisitos
requisitosString += "<br>";
}


// Exibir os requisitos na página
senhaRequisitos.innerHTML = requisitosString;

// Ajustar o estilo dos requisitos
senhaRequisitos.style.fontSize = "0.7em"; // Diminuir o tamanho da fonte
senhaRequisitos.style.marginTop = "0px"; // Diminuir a margem superior
senhaRequisitos.style.marginBottom = "15px"; // Diminuir a margem inferior
}

