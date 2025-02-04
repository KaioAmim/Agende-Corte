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
    <link rel="stylesheet" href="CSS/corteADM.css">
    <title>Cortes ADM</title>
</head>
<body style="background:linear-gradient(0deg,#24282f,#000);">
    <div class="w3-text-white w3-center" style="margin-bottom:150px">
        <div class="border text">
            <h1 style="font-size:35px"><strong style="color:#1E90FF; font-size:45px">Age</strong>nde<strong style="color:#1E90FF; font-size:45px">Co</strong>rte
                <i class="fa-solid fa-calendar-days w3-round-large"
                style="color:#24282f; background:linear-gradient(240deg,#1E90FF,white);padding-left:15px;padding-right:10px;
                padding-top:10px;padding-bottom:10px;"></i>
            <div class="w3-display">
                <p class="w3-margin w3-display-bottommidle" style="font-size:11px; text-transform: lowercase;letter-spacing: 2px;">
                    Barbearia com agendamento online: otimize tempo e<br> mantenha o estilo.
                </p>
            </div>
            </h1>
        </div>
    </div>

    <div class="w3-center">
        <h2 class="w3-text-white">
            <strong>Adicionar Na categoria Cabelo // Adicionar na Categoria Outros</strong>
        </h2>
    </div>
        <hr class="sublinhado">

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="main w3-text-white">
            <!-- CARD 1 - Corte de cabelo -->
            <div class="card card2 w3-card-4">
                <!-- Área de Imagem -->
                <label>
                    <input type="file" name="file_cabelo" style="opacity: 0; position: absolute; top: 0; left: 0; cursor: pointer;">
                    <img class="w3-padding" src="images/img.png" style="display: block; width:100%;cursor: pointer">
                </label>
                <!-- Nome e Valor -->
                <div class="w3-center">
                    <input name="nome_cabelo" type="text" maxlength="25" class="w3-round-xlarge w3-gray w3-padding" style="width:200px;" placeholder="Digite o Nome do Corte">
                    <input name="preco_cabelo" type="text" maxlength="10"class="w3-round-xlarge w3-gray w3-padding" style="width:100px;" placeholder="Valor">
                </div>
                <!-- Botão para Salvar -->
                <div class="w3-center w3-margin-top">
                    <button type="submit" name="add_cabelo" style="background-color: #24282f;" class="w3-btn w3-center w3-round-large">SALVAR</button>
                </div>
            </div>
        </form>
            <div class="pontilhado"></div>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- CARD 2 - Corte de barba -->
            <div class="card card2 w3-card-4">
                <!-- Área de Imagem -->
                <label>
                    <input type="file" name="file_barba" style="opacity: 0; position: absolute; top: 0; left: 0; cursor: pointer;">
                    <img class="w3-padding" src="images/img.png" style="display: block; width:100%;cursor: pointer">
                </label>
                <!-- Nome e Valor -->
                <div class="w3-center">
                    <input name="nome_barba" type="text" maxlength="25" class="w3-round-xlarge w3-gray w3-padding" style="width:200px;" placeholder="Digite o Nome da Barba">
                    <input name="preco_barba" type="text" maxlength="10"class="w3-round-xlarge w3-gray w3-padding" style="width:100px;" placeholder="Valor">
                </div>
                <!-- Botão para Salvar -->
                <div class="w3-center w3-margin-top">
                    <button type="submit" name="add_barba" style="background-color: #24282f;" class="w3-btn w3-center w3-round-large">SALVAR</button>
                </div>
            </div>
        </div>
    </form>
    
    <div class="menu w3-bottombar">
        <strong><a href="Principal.php"><i class="fa fa-home" style="font-size:25px"></i></a></strong>
        <p><a href="cortes.php"><strong>Cortes</strong></a></p>
        <p><a href="pacotes.php"><strong>Pacotes</strong></a></p>
        <p><a href="agenda.php"><strong>Agenda</strong></a></p>
    </div>

    <script src="JS/MascaraDinheiro.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os dados de cabelo foram enviados
    if (isset($_POST['add_cabelo'])) {
        $nome_cabelo = $_POST['nome_cabelo'];
        $preco_cabelo = $_POST['preco_cabelo'];
        $arquivo = $_FILES['file_cabelo'];

        $arquivoNovo = explode('.',$arquivo['name']);
        if($arquivoNovo[sizeof($arquivoNovo)-1] != 'jpg' && $arquivoNovo[sizeof($arquivoNovo)-1] != 'png'){
            die('<h3 style="color:red;text-align:center;">Você não pode fazer upload deste tipo de arquivo!</h3>');
        }else{
            move_uploaded_file($arquivo['tmp_name'],'images/'.$arquivo['name']);
        }
        $sql = "INSERT INTO cabelo (nome_cabelo, preco_cabelo, imagem_cabelo) VALUES ('$nome_cabelo', '$preco_cabelo', '$arquivo[name]')";
        if ($conn->query($sql) === TRUE) {
            echo "<h3 class='w3-text-green w3-center'>Corte de cabelo adicionado com sucesso!</h3>";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }

    // Verifica se os dados de barba foram enviados
    if (isset($_POST['add_barba'])) {
        $nome_barba = $_POST['nome_barba'];
        $preco_barba = $_POST['preco_barba'];
        $arquivo_barba = $_FILES['file_barba'];

        $arquivoNovo = explode('.',$arquivo_barba['name']);

        if($arquivoNovo[sizeof($arquivoNovo)-1] != 'jpg' && $arquivoNovo[sizeof($arquivoNovo)-1] != 'png'){
            die('<h3 style="color:red;text-align:center;">Você não pode fazer upload deste tipo de arquivo!</h3>');
        }else{
            move_uploaded_file($arquivo_barba['tmp_name'],'images/'.$arquivo_barba['name']);
        }
        $sql = "INSERT INTO barba (nome_barba, preco_barba, imagem_barba) VALUES ('$nome_barba', '$preco_barba', '$arquivo_barba[name]')";
        if ($conn->query($sql) === TRUE) {
            echo '<h3 class="w3-text-green w3-center">Produto adicionado com sucesso!</h3>';

        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>