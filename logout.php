<?php
session_start();
session_destroy(); // Encerra a sessão
header("Location: TelaLogin.php"); // Redireciona para a página de login
exit();
?>