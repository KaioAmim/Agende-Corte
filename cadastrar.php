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