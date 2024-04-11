<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="estilo/index.css">
    
</head>
<body>
    <div>
        <h1>Sistema de Certificação</h1>
        <form action="testLogin.php" method="post">
            <input type="text" name="email" placeholder="email">
            <br><br>
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            
            <input class="inputSubmit" type="submit" name="submit" value="Entrar">
            <br>
            <a href="formulario.php" class="registro">Registrar</a>
            

            
        </form>
    </div>
</body>
</html>