<?php
if (isset($_FILES['imagem_cabelo'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["imagem_cabelo"]["name"]);
    move_uploaded_file($_FILES["imagem_cabelo"]["tmp_name"], $target_file);

    $sql = "INSERT INTO cabelo (nome_cabelo, preco_cabelo, imagem_cabelo) VALUES ('$nome', '$preco', '$target_file')";
    // Execute a query...
}
?>