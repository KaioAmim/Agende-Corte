<?php
include_once 'conBD.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <title>Login</title>
</head>
<body>
  
<form action="login.php" method="POST" class="formulario w3-card-4 w3-topbar w3-rightbar w3-leftbar w3-bottombar card-login cartao">
    <h1 class="w3-text-white w3-center" style="font-family: fonteCadastro;margin-bottom:30px;">L O G I N</h1>
    <br>
    <br>
    <!--TELEFONE-->
    <div class="box-user field-group">
        <input type="text" name="txtTel" id="celular" class="input-field" required>
        <div class="icon">
            <i class="fa fa-phone"></i>
        </div>
        <label style="font-family: fonteInput;">T e l e f o n e</label>
    </div>
    <!--FIM TELEFONE-->

    <!--SENHA-->
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
    <!--FIM SENHA-->
    <?php
   session_start();
        if (isset($_SESSION['error'])) {
            echo "<div class='w3-container w3-red w3-round' style='margin-bottom: 0px; text-align: center;'>
                    <p style='margin: 0; font-size: 14px;'>" . $_SESSION['error'] . "</p>
                    </div>";
        } else {
            // Espaço reservado para quando não há mensagem
        }
        unset($_SESSION['error']);  // Limpa a mensagem de erro após exibi-la
   ?>

    <br>
    <div class="w3-center" style="margin-right:90px; padding-bottom:50px">
        <button type="submit" class="w3-btn  w3-round-large">Logar</button>
        <a class="w3-text-white w3-center a">|</a>
        <a href="index.php" class="a" style="margin-left: 5px;color:#5b6b8b;"><i class="fa fa-sign-in w3-right" style="color:#5b6b8b; padding-left: 5px; padding-top: 4px;"></i>Cadastro</a>
    </div>
</form>


  <script>
// MASCARA DO TELEFONE
var celular = document.getElementById("celular");

celular.addEventListener("input", () => {

    var limparValor = celular.value.replace(/\D/g, "").substring(0,11);

    var numerosArray = limparValor.split("");

    var numeroFormatado = "";
    
    if(numerosArray.length > 0){
        numeroFormatado += `(${numerosArray.slice(0,2).join("")})`;
    }
    if(numerosArray.length > 2){
        numeroFormatado += ` ${numerosArray.slice(2,7).join("")}`;
    }

    if(numerosArray.length > 7){
        numeroFormatado += `-${numerosArray.slice(7,11).join("")}`;
    }
    celular.value = numeroFormatado;
    // FIM MASCARA DO TELEFONE
});
</script>
</body>
</html>