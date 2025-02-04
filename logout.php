<?php
session_start();
session_destroy(); // Encerra a sessão
header("Location: /cadastro"); // Redireciona para a página de login
exit();
?>