<?php
 include_once 'conBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar ao banco de dados
    $conexao = new mysqli("bdbarbearia.mysql.dbaas.com.br", "bdbarbearia", "Kf031106@", "bdbarbearia");

    // Verifica a conexão
    if ($conexao->connect_error) {
        die("Conexão falhou: " . $conexao->connect_error);
    }

    // Obtém e sanitiza as entradas
    $telefone = $conexao->real_escape_string($_POST['txtTel']);
    $nome = $conexao->real_escape_string($_POST['txtNome']);
    $senha = password_hash($_POST['txtSenha'], PASSWORD_DEFAULT);

    // Verifica se o telefone já está cadastrado
    $query = "SELECT * FROM cadastro WHERE telefone = '$telefone'";
    $resultado = $conexao->query($query);

    if ($resultado->num_rows > 0) {
        // Se o telefone já estiver cadastrado, define a mensagem de erro
        $mensagemErro = "<div id='mensagemErro' class='w3-container w3-red w3-round' style='margin-bottom: 0px; text-align: center;'>
                          <p style='font-size:12px;'>Usuário já cadastrado com esse número de telefone!</p>
                          </div>";
    } else {
        // Se não estiver cadastrado, insere o novo usuário
        $sql = "INSERT INTO cadastro (nome, telefone, senha) VALUES ('$nome', '$telefone', '$senha')";
        if ($conexao->query($sql) === TRUE) {
            echo "<script>window.location.href='cadastro.php';</script>";
            exit;
        } else {
            echo "Erro: " . $sql . "<br>" . $conexao->error;
        }
    }

    // Fecha a conexão
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/cadastro.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <title>Cadastro</title>
    <script>
        // Remove a mensagem de erro ao recarregar a página
        window.onload = function() {
            if (performance.navigation.type === 1) { // Verifica se a página foi recarregada
                var mensagemErro = document.getElementById('mensagemErro');
                if (mensagemErro) {
                    mensagemErro.style.display = 'none'; // Remove a mensagem de erro
                }
            }
        }
    </script>
</head>
<body>
    <form action="cadastrar.php" method="POST" class="formulario w3-card-4 w3-topbar w3-rightbar w3-leftbar w3-bottombar card-login cartao">
        <h1 class="w3-text-white w3-center" style="font-family: fonteCadastro;margin-bottom:30px;">C A D A S T R O</h1>
        
        <!-- NOME -->
        <div class="box-user field-group">
            <input type="text" name="txtNome" class="input-field" maxlength="60" required>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <label style="font-family: fonteInput;">N o m e</label>
        </div>
        <!-- FIM NOME -->

        <!-- TELEFONE -->
        <div class="box-user field-group">
            <input type="text" id="celular" name="txtTel" class="input-field form-control" required>
            <div class="icon">
                <i class="fa fa-phone"></i>
            </div>
            <label style="font-family: fonteInput;">T e l e f o n e</label>
        </div>
        <!-- FIM TELEFONE -->

        <!-- SENHA -->
        <div class="box-user field-group">
            <input type="password" name="txtSenha" id="password" maxlength="10" class="input-field" required>
            <label style="font-family: fonteInput;">S e n h a</label>
            <div class="icon">
                <i class="fa fa-lock"></i>
            </div>
            <section>
                <div id="icon" onclick="showHide()"></div>
            </section>
            <script src="JS/codigoSenha.js"></script>
        </div>
        <!-- FIM SENHA -->

      
        <script>
            // MASCARA DO TELEFONE
            var celular = document.getElementById("celular");

            celular.addEventListener("input", () => {
                var limparValor = celular.value.replace(/\D/g, "").substring(0, 11);
                var numerosArray = limparValor.split("");
                var numeroFormatado = "";

                if (numerosArray.length > 0) {
                    numeroFormatado += `(${numerosArray.slice(0, 2).join("")})`;
                }
                if (numerosArray.length > 2) {
                    numeroFormatado += ` ${numerosArray.slice(2, 7).join("")}`;
                }
                if (numerosArray.length > 7) {
                    numeroFormatado += `-${numerosArray.slice(7, 11).join("")}`;
                }
                celular.value = numeroFormatado;
            });
        </script>

        <div class="w3-center" style="margin-right:90px;margin-bottom:30px;">
            <button type="submit" class="w3-btn btn w3-round-large">Cadastrar</button>
            <a class="w3-text-white w3-center a">|</a>
            <a href="TelaLogin.php" class="a" style="margin-left: 5px;color:#5b6b8b;">
                <i class="fa fa-user w3-right" style="color:#5b6b8b; padding-left: 5px; padding-top: 4px;"></i>Login
            </a>
        </div>
    </form>
</body>
</html>