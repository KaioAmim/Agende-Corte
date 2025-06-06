<?php
include_once 'conBD.php';
session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: TelaLogin.php?error=Você precisa estar logado para acessar esta página.");
    exit();
}
// Consulta para buscar produtos do carrinho
// Ajuste a tabela e os campos conforme seu banco de dados
$sql = "SELECT name, price FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']); // Supondo que o ID do usuário esteja armazenado na sessão
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.2/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/pagamento.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="images/logo.png">


    <style>
        .payment-method {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <p style="color: #444;">Métodos de Pagamento</p>
            <hr style="border:1px solid #ccc; margin: 0 15px;">
            <div class="methods" style="color: #444;">
                <div id="cartao" onclick="showPaymentMethod('cartao')" style="color: #1E90FF;"><i class="fa-solid fa-credit-card" id="cartao-icon" style="color: #1E90FF;"></i> Cartão de Débito/Crédito</div>
                <div id="pix" onclick="showPaymentMethod('pix')"><i class="fa-solid fa-building-columns"id="pix-icon"></i> Pix</div>
                <div id="dinheiro" onclick="showPaymentMethod('dinheiro')"><i class="fa-solid fa-wallet" id="dinheiro-icon"></i> Dinheiro Vivo</div>
            </div>
            <hr style="border:1px solid #ccc; margin: 0 15px;">
        </div>
        <div class="center" id="payment-details">
            <div class="card-details payment-method" id="cartao-details" style="display: block;">
                <div class="containers">
                    <div class="card-container">
                        <div class="front">
                            <div class="image">
                                <img src="images/chip.png" alt="" style="width:20%">
                                <div id="imageContainer" style="width:0%"></div>
                            </div>
                            <strong><div class="card-number-box">#### #### #### ####</div></strong>
                            <div class="flexbox">
                                <div class="box">
                                    <strong><div class="card-holder-name" style="font-size:14px;text-transform:uppercase"></div></strong>
                                </div>
                                <div class="box">
                                    <div class="expiration">
                                        <strong>
                                        <span class="exp-month">mm</span>
                                        <span>/</span>
                                        <span class="exp-year">yy</span>
                                    </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="stripe"></div>
                            <div class="box">
                                <strong>
                                    <span>CVV</span>
                                    <div class="cvv-box"></div>
                            </strong>
                            </div>
                        </div>
                    </div>
                    <form action="" style="z-index: 1;">
                        <div class="inputBox">
                            <span>Número do Cartão</span>
                            <input required id="NumeroCartao"  type="text" placeholder="#### #### #### ####" maxlength="19" class="card-number-input">
                        </div>
                        <div class="inputBox">
                            <span>Titular do Cartão</span>
                            <input required id="TitularCartao" type="text" placeholder="nome completo" class="card-holder-input">
                        </div>
                        <div class="inputBox">
                            <span>Empresa</span>
                        <button id="cartaoMasterCard" class="w3-btn" style="height:40px;width:70px; padding: 0; background: none; border: none; position: relative; overflow: hidden;">
                            <img src="images/mastercard-icon.png" alt="" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: auto;">
                        </button>
                        <button id="cartaoVisa" class="w3-btn" style="height:40px;width:70px; padding: 0; background: none; border: none; position: relative; overflow: hidden;">
                            <img src="images/visa-icon.png" alt="" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: auto;">
                        </button></div>
                        <div class="flexbox">
                            <div class="inputBox">
                                <span>Validade Mês</span>
                                <select name="" id="" class="month-input">
                                    <option value="month" selected disabled>mês</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="inputBox">
                                <span>Validade Ano</span>
                                <select name="" id="" class="year-input">
                                    <option value="year" selected disabled>ano</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                </select>
                            </div>
                            <div class="inputBox">
                                <span>CVV</span>
                                <input required type="text" id="cvv" maxlength="3" class="cvv-input">
                            </div>
                        </div>
                        <input type="submit" value="Finalizar Compra" class="submit-btn">
                    </form>
                </div>  
            </div>
 <script>
            const MINUTES = 5;
            const pixEmv = "00020101021126330014br.gov.bcb.pix0111073754464315204000053039865802BR5920PIMENTAS TCC LTDA6006RECIFE62070503***63040D36";

            let timeLeft = MINUTES * 60;
            let interval = null;

            $(function(){
            qr.init();
            qr.paymentTimeout();
            });

            let qr = {
            init: function() {
                this.create(pixEmv);
                $('#chavePix').on('click', function() {
                qr.copy();
                });
            },

            create: function(data) {
                const options = {
                width: 160,
                height: 160
                };
                
                let qrcode = new QRCode("qrcodePix", options);
                qrcode.makeCode(data);

                $('#chavePix').val(data);
            },

            copy: function() {
                let pix = document.getElementById('chavePix');
                pix.select();
                // Usando Clipboard API moderna
                navigator.clipboard.writeText(pix.value).then(function() {
                alert('Código copiado, abra o app do seu banco para realizar o pagamento');
                }).catch(function(err) {
                alert('Erro ao copiar código: ' + err);
                });
            },

            paymentTimeout: function() {
                let TOTALTIME = timeLeft;
                interval = setInterval(function() {
                let progressView = $('.progress');
                if (timeLeft > 0) {
                    timeLeft -= 1;
                    let result = qr.timeConvert(timeLeft);

                    $('#timer').html(
                    qr.leftpad(result.minutos, 2, '0') + ":" + qr.leftpad(result.segundos, 2, '0')
                    );

                    let progress = (timeLeft / TOTALTIME) * 100;
                    progressView.css('width', progress + '%').css('transition', 'width 0.5s ease');
                } else {
                    progressView.css('width', '0%');
                    clearInterval(interval);
                }
                }, 1000);
            },

            timeConvert: function(segundos) {
                let minutos = Math.floor(segundos / 60);
                minutos %= 60;
                segundos %= 60;
                return { minutos, segundos };
            },

            leftpad: function(str, length, char) {
                str = String(str);
                char = char || ' ';
                while (str.length < length) {
                str = char + str;
                }
                return str;
            }
            };
</script>
<div id="pix-details" class="payment-method w3-center w3-padding">
    <form action="">
        <div class="areapix">
            <div id="qrcodePix"></div>

            <div class="progress-bar">
                <div class="progress"></div>
            </div>
            <p style="margin-bottom:10px">
                Tempo para pagar: <br>
                <strong id="timer">00:00</strong>
            </p>

            <p>Se preferir, copie o código:</p>
            <textarea readonly id="chavePix" rows="3" style="font-family: consolas; color: #333; border: thin solid #ccc;padding: 8px; margin: 10px 0;"></textarea>

            <p class="info">
                <strong>ATENÇÃO! <br> </strong>
                Essa é uma chave PIX ilustrativa, portanto não é possível concluir o pagamento.
            </p>
        </div>
        <input type="submit" value="Finalizar Compra" class="submit-btn">
    </form>
</div>


            <div id="dinheiro-details" class="payment-method w3-center">
                <form action="" method="POST">
                    <div class="inputBox">
                        <span>Valor em Dinheiro</span>
                        <input type="text" name="valor" placeholder="Digite o valor" required value="<?= isset($valor) ? $valor : ''; ?>">
                    </div>

                    <div class="inputBox">
                        <span>Precisa de troco?</span>
                        <div class="radio-buttons-container">
                            <div class="radio-button">
                                <input name="troco" id="radio1" class="radio-button__input" type="radio" value="sim" <?= (isset($troco) && $troco == 'sim') ? 'checked' : ''; ?>>
                                <label for="radio1" class="radio-button__label">
                                    <span class="radio-button__custom"></span> Sim
                                </label>
                            </div>
                            <div class="radio-button">
                                <input name="troco" id="radio2" class="radio-button__input" type="radio" value="nao" <?= (isset($troco) && $troco == 'nao') ? 'checked' : ''; ?>>
                                <label for="radio2" class="radio-button__label">
                                    <span class="radio-button__custom"></span> Não
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Finalizar Compra" class="submit-btn">
                </form>
            </div>

        </div>
        <div class="right">
            <p style="color: #444;">Estamos quase lá...</p>
            <hr style="color: #444; border:1px solid #ccc; margin: 0 15px;">
            <table class="w3-table" style="margin: 20px 15px;">
            <div style="font-weight: bold;margin: 15px"class="w3-center">Resumo da compra:</div>
                <tr>
                    <th>Produto</th>
                    <th>Valor Produto</th>
                </tr>
                <?php while ($produto = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['name']); ?></td>
                        <td>R$ <?php echo number_format($produto['price'], 2, ',', '.'); ?></td>
                    </tr>
                    <?php $total += $produto['price']; ?>
                <?php endwhile; ?>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>R$ <?php echo number_format($total, 2, ',', '.'); ?></strong></td>
                </tr>
            </table>
            <?php
            // Fecha a conexão
            $stmt->close();
            $conn->close();
            ?>
            <hr style="border:1px solid #ccc; margin: 0 15px;">
                <div class="w3-center" style="font-size: 13px"><a href="carrinho.php" style="text-decoration: none;">Voltar <i class="fa-solid fa-arrow-left"style="margin-left:5px; font-size: 13px;"></i></a></div>
            </div>
        </div>
    </div>

  
    <script>
        function showPaymentMethod(method) {
            // Hide all payment methods
            document.querySelectorAll('.payment-method').forEach(function(element) {
                element.style.display = 'none';
            });
            // Show the selected payment method
            document.getElementById(method + '-details').style.display = 'block';
            
            // Reset all colors
            document.getElementById('cartao').style.color = '#444';
            document.getElementById('pix').style.color = '#444';
            document.getElementById('dinheiro').style.color = '#444';
            document.getElementById('cartao-icon').style.color = '#aaa';
            document.getElementById('pix-icon').style.color = '#aaa';
            document.getElementById('dinheiro-icon').style.color = '#aaa';
            
            // Set selected color
            if (method === 'cartao') {
                document.getElementById('cartao').style.color = '#1E90FF';
                document.getElementById('cartao-icon').style.color = '#1E90FF';
            } else if (method === 'pix') {
                document.getElementById('pix').style.color = '#1E90FF';
                document.getElementById('pix-icon').style.color = '#1E90FF';
            } else if (method === 'dinheiro') {
                document.getElementById('dinheiro').style.color = '#1E90FF';
                document.getElementById('dinheiro-icon').style.color = '#1E90FF';
            }
        }

        // Exibe os detalhes do cartão de crédito por padrão
        document.getElementById('cartao-details').style.display = 'block';
    </script>
    <script src="JS/pagamento.js"></script>
</body>
</html>