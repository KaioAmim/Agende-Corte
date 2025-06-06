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
	<!-- Dispositivos Moveis-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=PT+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="stylesheet" href="CSS/principal.css">
    <title>Home</title>
    
</head>
<body style="background:linear-gradient(0deg,#24282f,#000);">
<!--CARROSSEL-->
<div class="wrapper w3-margin-top">
        <div class="slide-wrapper" data-slide="wrapper">
            <button class="slide-nav-button slide-nav-previous fas fa-chevron-left" data-slide="nav-previous-button"></button>
            <button class="slide-nav-button slide-nav-next fas fa-chevron-right" data-slide="nav-next-button"></button>
            <div class="slide-list" data-slide="list">
                <div class="slide-item" data-slide="item" data-index="0">
                    <div class="slide-content w3-bottombar w3-leftbar w3-topbar w3-rightbar w3-border-white">
                        <img class="slide-image" src="images/s1.png" alt="IMAGEM 0">
                    </div>
                </div>
                <div class="slide-item" data-slide="item" data-index="1">
                    <div class="slide-content w3-bottombar w3-leftbar w3-topbar w3-rightbar w3-border-white">
                        <img class="slide-image" src="images/s2.png" alt="IMAGEM 1" />
                    </div>
                </div>
                <div class="slide-item" data-slide="item" data-index="2">
                    <div class="slide-content w3-bottombar w3-leftbar w3-topbar w3-rightbar w3-border-white">
                        <img class="slide-image" src="images/s3.png" alt="IMAGEM 2"/>
                    </div>
                </div>
                <div class="slide-item" data-slide="item" data-index="3">
                    <div class="slide-content w3-bottombar w3-leftbar w3-topbar w3-rightbar w3-border-white">
                        <img class="slide-image" src="images/s4.png" alt="IMAGEM 3" />
                    </div>
                </div>
                
            </div>
            <div class="slide-controls" data-slide="controls-wrapper">
            </div>
        </div>
    </div>
    <!-- SCRIPT CARROSSEL-->
            <script src="./JS/carrossel.js"></script>
            <script>
                    initSlider({
                        autoPlay: true,
                        startAtIndex: 0,
                        timeInterval: 2000
                    })
                </script>
<br>
<br>    

<!--BARRA DE MENU -->
<div class="menu w3-bottombar reveal" style="z-index:1;">
    <strong><a href="Principal.php"><i class="fa fa-home" style="font-size:25px"></i></a></strong>
    <p class="roboto-medium"><a class="itensMenu" href="cortes.php"><strong>Cortes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="pacotes.php"><strong>Pacotes</strong></a></p>
    <p class="roboto-medium"><a class="itensMenu" href="agenda.php"><strong>Agenda</strong></a></p>
    <div style="margin-left: auto;" class="icones-direita">
        <a href="carrinho.php" class="carrinho"style="margin-right: 15px;"><i class="fa fa-shopping-cart " style="font-size:25px;"></i>  <span class="cart-count"><?php echo $cartItemCount; ?></span></a>
        <div class="user-menu">
            <a href="#"><i class="fa fa-user-circle" style="font-size:35px;"></i></a>
            <div class="dropdown-content">
                <li class="w3-ul w3-padding"><strong>Nome: </strong> <?php echo htmlspecialchars($_SESSION['user_nome']); ?></li>
                <a href="logout.php" style="font-size:12px">Sair <i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<div class="intro">
    <div class="reveal">
    <hr class="sublinhado">
    <h1 class="playfair-display-sc-black" style="margin-bottom:30px;"><strong>Bem-vindo à  [Nome da Barbearia] </strong></h1>
    <hr class="sublinhado">
    </div>
    <br>
    <p class="reveal roboto-regular">Na [Nome da Barbearia], oferecemos cortes de cabelo e serviços de barba de alta qualidade em um ambiente acolhedor e profissional. Nossa equipe é composta por barbeiros experientes e apaixonados, prontos para proporcionar a melhor experiência para nossos clientes.</p>
    <br>
    <br>
    <br>
    <br>
    <br>
   <div class="w3-center botoes">
    <a href="#produto" class="roboto-regular reveal"> <button class="btn btn-1 hover-filled-opacity">
            <span>Confira nossos Produtos <i class="fa fa-shopping-basket" style="font-size:1.2em;" aria-hidden="true"></i></span>
        </button></a>
        <a href="#testimonials" class="roboto-regular reveal"> <button class="btn btn-1 hover-filled-opacity">
            <span>Avaliações de Nossos Clientes <i class="fa-solid fa-comments" style="font-size:1.2em;"></i></span>
        </button></a>
        <a href="#sugestao" class="roboto-regular reveal sugestao"> <button class="btn btn-1 hover-filled-opacity">
            <span>Deixe sua Sugestão! <i class="fa-solid fa-pen-to-square"style="font-size:1.2em;"></i></span>
        </button></a>
   </div>
</div>
<br>
<br>
<br id="produto">

             <div class="reveal cartao">
             <h2 class=" playfair-display-sc-bold" style="text-align:center;color:white;margin-top:10%"><strong>CONFIRA NOSSOS PRODUTOS:</strong></h2>
             <hr class="sublinhado ">
             </div>
             <!-- CARDS -->
                    <div class="reveal main w3-text-white" style="margin-bottom:100px;">
                        
                         <!-- CARD 1 -->
                        <div class="reveal card">
                            <br>
                        <p><img src="images/cabelo.png"style="width:60%" alt="cabelo"></p>
                            <div class="w3-center"><h4 class="playfair-display-sc-bold" ><strong>CABELO</strong></h4></div>
                            <p style="text-align:center;"class="roboto-thin">Nossos cortes de cabelo são personalizados para cada cliente, garantindo que você saia com um visual que realmente combina com seu estilo e personalidade. Utilizamos técnicas modernas e clássicas para atender todas as suas necessidades.</p>
                                <div>

                                        <div class="w3-center w3-margin-top" style="padding-bottom:10px"><a href="cortes.php">

                                            <button class="button" >
                                            <strong>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                                                </svg>
                                           </strong>
                                                <div class="textbutton">
                                                    <strong>
                                                VER MAIS
                                                 </strong>
                                                </div>
                                                </button></a>
                                </div>
                            </div>
                        </div>
                        <!-- CARD 1 -->


                        <!-- CARD 2 -->
                        <div class="reveal card">
                            <br>
                            <br>
                        <p style="text-align:center"><img src="images/barba.png" style="margin-right:10px;" alt="barba"></p>
                            <div class="w3-center"><h4 class="playfair-display-sc-bold"><strong>BARBA</strong></h4></div>
                            <p style="text-align:center;" class="roboto-thin">Desde uma barba tradicional até modelagens modernas, nossos serviços de barba são projetados para deixar você com a melhor aparência. Utilizamos produtos de alta qualidade para garantir que sua pele e barba estejam sempre saudáveis.</p>
                                <div>
                                        <div class="w3-center w3-margin-top" style="padding-bottom:10px"><a href="cortes.php">
                                            <button class="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                                                </svg>
                                                <div class="textbutton">
                                                <strong>
                                                VER MAIS
                                                </strong>
                                             </div>
                                            </button></a>
                                </div>
                            </div>
                        </div>
                      <!-- CARD 2 -->

                        <!-- CARD 3 -->
                        <div class="reveal card">
                            <p><img src="images/sacola.png" alt="pacotes"></p>
                            <div class="w3-center"><h4 class="playfair-display-sc-bold"><strong>PACOTES</strong></h4></div>
                            <p class="roboto-thin">Oferecemos uma variedade de pacotes especiais para atender todas as suas necessidades de cuidado e estilo. Desde cortes mensais até cuidados completos, temos o pacote perfeito para você.</p>
                            <div class="w3-center w3-margin-top" style="padding-bottom:10px"><a href="pacotes.php">
                                    <button class="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                                    </svg>
                                    <div class="textbutton">
                                        <strong>
                                        VER MAIS
                                        </strong>
                                    </div>
                                    </button></a>
                            </div>
                        </div>

                        <!-- CARD 3 --> 

                </div>
            <!--FIM CARDS-->

            <br>
            <br id="testimonials">
            <br>
          <div>
             

            <!-- Formulário de contato -->

            <div id="sugestao" class="contact-form" style="margin-top:10%">
                    <div class="reveal">
                    <h1 class="w3-center playfair-display-sc-bold"><strong>Deixe Sua Sugestão: </strong></h1>
                    <hr class="sublinhado">
                    </div>
                <br>
                    <div class="reveal">
                    <p><i class="fas fa-map-marker-alt"style="margin-right:1%;color:#1E90FF;"></i>Endereço: Rua Exemplo, 123, Cidade, Estado</p>
                    <p><i class="fas fa-phone-alt"style="margin-right:1%;color:#1E90FF;"></i>Telefone: (11) 1234-5678</p>
                    <p><i class="fa fa-envelope"style="margin-right:1%;color:#1E90FF;" aria-hidden="true"></i>Email: contato@barbearia.com</p>
                    </div>
                <br>
                    <div class="reveal">
                        <form  action="" method="POST" >
                        <label for="name"><strong>Nome:</strong></label>
                        <input type="text" id="name" name="name" required>
                        
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="message"><strong>Mensagem:</strong></label>
                        <textarea id="message" name="message" required></textarea>
                     
                        <button name="enviar_mensagem" type="submit">Enviar</button>
                        </form>
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Verifica se os dados de cabelo foram enviados
                                if (isset($_POST['enviar_mensagem'])) {
                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $message = $_POST['message'];
                                    $sql = "INSERT INTO contato (nome, email, mensagem) VALUES ('$name', '$email', '$message')";
                                    
                                    if ($conn->query($sql) === TRUE) {
                                        echo "<h3 class='w3-text-green w3-center'>Mensagem Enviada!</h3>";
                                    } else {
                                        echo "Erro: " . $sql . "<br>" . $conn->error;
                                    }
                                    
                                }
                            }
                            
                            ?>
                    </div>
            </div>
          </div>
 <!-- Seção de depoimentos -->
    <section class="testimonials-section">
                <div class="container">
                    <div class="reveal">
                    <h1 class="w3-text-white playfair-display-sc-bold"><strong>O que dizem nossos clientes</strong><hr class="sublinhado"></h1>
                    
                    </div>
                    <div class="main-depoimentos">
                    <img class="w3-right poleesquerda reveal" style="color:blue;width:15%"src="images/pole.png" alt="">
                    <img class="w3-left poledireita reveal"  style="color:blue;width:15%"src="images/pole.png" alt="">
                     <div class="reveal testimonial-slider w3-padding">


                <?php
                include('conBD.php'); // Inclua a conexão com o banco de dados

                $query = "SELECT * FROM contato"; 
                $result = $conn->query($query);

                // Verifica se encontrou produtos
                if ($result && $result->num_rows > 0) {
                    // Loop para exibir os produtos
                    while ($contato = $result->fetch_assoc()) {
                        echo '
                        <div class="testimonial-item">
                        <p>'.  $contato['mensagem'] .'</p>
                        <h4>'. $contato['nome'].'</h4>
                      </div>';
                    }
                } else {
                    echo "<p class='w3-text-white w3-center'>Nenhuma avaliação disponível no momento.</p>";
                }
                ?>
                    </div>
                </div>
                    </div>  
        </section>

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
        <p style="color:#737373;margin-left:100px;margin-bottom:50px;" class="direitos w3-left">&copy; 2024 TCC Barbearia. Todos os direitos reservados.</p>
      </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reveals = document.querySelectorAll('.reveal');
            function reveal() {
                for (let i = 0; i < reveals.length; i++) {
                    const windowHeight = window.innerHeight;
                    const elementTop = reveals[i].getBoundingClientRect().top;
                    const elementVisible = 175;
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
      
<!--SCRIPT MENU STICKY -->
        <scipt src="JS/CarrosselIMG.js"></script>
		
	<script>
	window.onscroll = function() {myFunction()};

	var navbar = document.getElementById("navbar");
	var sticky = navbar.offsetTop;

	function myFunction() {
	if (window.pageYOffset >= sticky) {
		navbar.classList.add("sticky")
	} else {
		navbar.classList.remove("sticky");
	}
	}
	</script>
</body>
</html>