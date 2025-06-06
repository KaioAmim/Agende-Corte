<?php
include_once 'conBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTel'];
    $senha = password_hash($_POST['txtSenha'], PASSWORD_DEFAULT); // Criptografar a senha

    $sql = "INSERT INTO cadastro (nome, telefone, senha) VALUES ('$nome', '$telefone', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
        header("Location: TelaCadastroSucesso.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="stylesheet" href="CSS/cadastroSucesso.css">
    <title>Cadastro Realizado Com Sucesso</title>
</head>
<body>
  
   <form class="formulario w3-card-4 w3-topbar w3-rightbar	w3-leftbar w3-bottombar card-login cartao">
    <h2 class="w3-text-white w3-center" style="font-family: fonteInput;margin-bottom:30px;">C A D A S T R O<br>C O M<br>S U C E S S O</h2>
      <img  class="correto w3-center" src="images/afirmativo.gif" alt="">

        
      <div class="w3-center" style="margin-right:90px;">
        <a href="TelaLogin.php" class="w3-btn w3-round-large" style="width:50%;">Logar</a>
      </div>

  </form>
 

</body>
</html>