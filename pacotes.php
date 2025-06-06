<?php
include_once 'conBD.php';
session_start();

$userId = $_SESSION['user_id'];
$query = "SELECT SUM(quantity) AS total_items FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$cartItemCount = $row['total_items'] ?? 0;
$query = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: TelaLogin.php");
    exit(); // Certifique-se de usar 'exit()' após o redirecionamento para parar a execução do script
}

// Caso contrário, o usuário pode acessar a página
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="stylesheet" href="CSS/pacotes.css">
    <title>Pacotes</title>
</head>
<body style="background:linear-gradient(0deg,#24282f,#000);">
   
<!--BARRA DE MENU -->
<div class="menu w3-bottombar reveal" style="z-index:1;">
    <strong><a href="Principal.php"><i class="fa fa-home" style="font-size:25px"></i></a></strong>
    <p class="roboto-medium"><a class="itensMenu" href="cortes.php"><strong>Cortes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="pacotes.php"><strong>Pacotes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="agenda.php"><strong>Agenda</strong></a></p>
    <div style="margin-left: auto;" class="icones-direita">
    <a href="carrinho.php" class="carrinho"style="margin-right: 15px;"><i class="fa fa-shopping-cart " style="font-size:25px;"></i> <span class="cart-count"><?php echo $cartItemCount; ?></span></a>
        <div class="user-menu">
            <a href="#"><i class="fa fa-user-circle"style="font-size:30px"></i></a>
            <div class="dropdown-content">
                <li class="w3-ul w3-padding"><strong>Nome: </strong> <?php echo htmlspecialchars($_SESSION['user_nome']); ?></li>
                <a href="logout.php" style="font-size:12px">Sair <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>

 
<div class="w3-text-white w3-center reveal" style="margin-bottom:150px">
        <div class="border text">
                <h1><strong style="color:#1E90FF; ">Age</strong>nde<strong style="color:#1E90FF;">Co</strong>rte
                    <i class="fa-solid fa-calendar-days w3-round-large"
                    style="color:#24282f; background:linear-gradient(240deg,#1E90FF,white);padding-left:10px;padding-right:10px;
                    padding-top:10px;padding-bottom:10px;"></i>
                <div class="w3-display">
                    <p class="w3-margin reveal w3-display-bottommidle" style="text-transform: lowercase;letter-spacing: 2px;">
                    Barbearia com agendamento online: otimize tempo e<br> mantenha o estilo.</p>
                </div>
            </h1>
        </div>
        
    </div>
    <div class="reveal w3-center"><h2 class="w3-text-white playfair-display-sc-bold">
            <strong>Nossos Pacotes</strong>
            <hr class="sublinhado">
            </h2></div>
        <div style="display:flex;justify-content:center " class="e-card-container w3-center cartao reveal">

<!-- PACOTES-->

        <!--PACOTE 1-->
        <form method="POST" action="add_to_cart.php">
         <div class="e-card playing plan package w3-margin" data-id="1" data-name="Membro SILVER CLASS" data-price="60" data-image="images/pacote1.png">
            
            <div class="image"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="inner">
                <div class="infotop"></div>
                <div class="pricing">
                    $60<small>/ mês</small>
                </div>
                <div class="title">Membro<br>SILVER CLASS</div>
                <ul class="features roboto-light">
                    <li><span class="w3-text-teal fas fa-scissors"></span> <strong>1 corte</strong> p/ <strong>semana</strong></li>
                    <li><span class="w3-text-teal fa fa-check-circle"></span> <strong>10%</strong> de desconto</li>    
                    <li><span class="w3-text-teal fas fa-calendar-alt"></span> Plano válido por <strong>1 mês</strong></li>
                </ul>
                <div class="action">
            
                <button class="add-to-cart w3-center button w3-btn" type="submit">
                    <strong class="w3-text-white">Escolher Plano</strong>
                </button>
                    <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="product_name" value="Membro SILVER CLASS">
                <input type="hidden" name="product_price" value="60">
                <input type="hidden" name="product_img" value="pacote1.png">
                </form>
                </div>
            </div>
            </div>



         <!--PACOTE 2-->
         <form method="POST" action="add_to_cart.php">
         <div class="e-card playing plan package w3-margin" data-id="2" data-name="Membro GOLD PREMIUM" data-price="100" data-image="images/pacote2.png">
            
            <div class="image"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="inner">
                <div class="infotop"></div>
                <div class="pricing">
                    $100<small>/ mês</small>
                </div>
                <div class="title">Membro<br>GOLD PREMIUM</div>
                <ul class="features roboto-light">
                    <li><span class="w3-text-teal fas fa-scissors"></span> <strong>2 corte</strong> p/ <strong>semana</strong></li>
                    <li><span class="w3-text-teal fa fa-check-circle"></span> <strong>30%</strong> de desconto</li>    
                    <li><span class="w3-text-teal fas fa-calendar-alt"></span> Plano válido por <strong>1 mês</strong></li>
                </ul>
                <div class="action">
            
                <button class="add-to-cart w3-center button w3-btn" type="submit">
                    <strong class="w3-text-white">Escolher Plano</strong>
                </button>
                    <input type="hidden" name="product_id" value="2">
                <input type="hidden" name="product_name" value="Membro GOLD PREMIUM">
                <input type="hidden" name="product_price" value="100">
                <input type="hidden" name="product_img" value="pacote2.png">
                </form>
                </div>
            </div>
            </div>


         <!--PACOTE 3-->
       <form method="POST" action="add_to_cart.php">

         <div class="e-card playing plan package w3-margin" data-id="3" data-name="Membro PLATINUM VIP" data-price="300" data-image="images/pacote3.png">
            
            <div class="image"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="wave"></div>
            <div class="inner">
                <div class="infotop"></div>
                <div class="pricing">
                    $300<small>/ ano</small>
                </div>
                <div class="title">Membro<br>PLATINUM VIP</div>
                <ul class="features roboto-light">
                    <li><span class="w3-text-teal fas fa-scissors"></span> <strong>1 corte</strong> p/ <strong>semana</strong></li>
                    <li><span class="w3-text-teal fa fa-check-circle"></span> <strong>50%</strong> de desconto</li>    
                    <li><span class="w3-text-teal fas fa-calendar-alt"></span> Plano válido por <strong>1 ano</strong></li>
                </ul>
                <div class="action">
            
                <button class="add-to-cart w3-center button w3-btn" type="submit">
                    <strong class="w3-text-white">Escolher Plano</strong>
                </button>
                    <input type="hidden" name="product_id" value="3">
                <input type="hidden" name="product_name" value="Membro PLATINUM VIP">
                <input type="hidden" name="product_price" value="300">
                <input type="hidden" name="product_img" value="pacote3.png">
                </form>
                </div>
            </div>
            </div>
         <script src="JS/Carrinho.js"></script>
        
        </div>
    <footer>
        <div class="divisao">
                   <!-- REDES SOCIAIS !-->
                    <ul>
                        <h3>Redes Sociais</h3>
                        <hr class="sublinhado">
                        <div class="redes-sociais w3-center">
                        <svg class="facebook" xmlns="http://www.w3.org/2000/svg" viewBox="-25 -150 550 800"><path fill="#ffffff" d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg>
                        <svg class="instagram" xmlns="http://www.w3.org/2000/svg" viewBox="-25 -150 500 800"><path fill="#ffffff" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                        <svg class="tiktok" xmlns="http://www.w3.org/2000/svg" viewBox="-25 -200 500 900"><path fill="#ffffff" d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.6 162.6 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/></svg>
                        <svg class="youtube"xmlns="http://www.w3.org/2000/svg" viewBox="-25 -200 630 900"><path fill="#ffffff" d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
                        <svg class="whatsapp" xmlns="http://www.w3.org/2000/svg" viewBox="-25 -130 500 800"><path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        </div>
                    </ul>

                    <!-- SOBRE !-->
                    <ul>
                        <h3>Sobre Nós</h3>
                        <hr class="sublinhado">
                        <div class="sobre">
                            <p>Nossa barbearia oferece serviços de alta qualidade para que você sempre saia satisfeito. Venha nos visitar e experimente o melhor corte de cabelo e barba da cidade!</p>
                            </p>
                        
                        </div>
                    </ul>
                    
                     <!-- CONTATO !-->
                    <ul>
                    <h3>Contato</h3>
                    <hr class="sublinhado">
                    <div class="contato">
                        <p>Email: contato@barbearia.com</p>
                        <p>Telefone: (11) 1234-5678</p>
                        <p>Endereço: Rua Exemplo, 123, Centro, São Paulo, SP</p>
                    </div>
      
                    </ul>
        </div>
        <hr class="sublinhado-footer" >
        <p style="color:#737373;margin-left:100px;margin-bottom:50px;" class="w3-left direitos">&copy; 2024 TCC Barbearia. Todos os direitos reservados.</p>
      </footer>


    <!-- FIM CARDS-->
 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');
            function reveal() {
                for (let i = 0; i < reveals.length; i++) {
                    const windowHeight = window.innerHeight;
                    const elementTop = reveals[i].getBoundingClientRect().top;
                    const elementVisible = 250;
                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add('visible');
                    } else {
                        reveals[i].classList.remove('visible');
                    }
                }
            }
            window.addEventListener('scroll', reveal);
            reveal();
        });
    </script>
</body>
</html>
