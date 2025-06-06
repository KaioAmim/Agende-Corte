
use if0_39114645_lp2;

create table cadastro(
id_cadastro int auto_increment primary key,
nome varchar(200)not null,
telefone varchar(20)not null,
senha varchar(10)not null

)default charset=utf8 ;

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table pct1(
id_pct1 int auto_increment primary key,
qtd_cortes int not null,
preco_pct double not null
);

create table pct2(
id_pct2 int auto_increment primary key,
qtd_cortes int not null,
preco_pct double not null
);
create table pct3(
id_pct3 int auto_increment primary key,
qtd_cortes int not null,
preco_pct double not null
);

create table pacotes(
id_pacotes int auto_increment primary key,
id_pct1 int,
id_pct2 int,
id_pct3 int,

foreign key (id_pct1) references pct1 (id_pct1),
foreign key (id_pct2) references pct2 (id_pct2),
foreign key (id_pct3) references pct3 (id_pct3)
);


CREATE TABLE cabelo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cabelo VARCHAR(255) NOT NULL,
    preco_cabelo DECIMAL(10, 2) NOT NULL,
    imagem_cabelo VARCHAR(255) NOT NULL
);

CREATE TABLE barba (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_barba VARCHAR(255) NOT NULL,
    preco_barba DECIMAL(10, 2) NOT NULL,
    imagem_barba VARCHAR(255) NOT NULL
);

CREATE TABLE agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    data_corte VARCHAR(10) NOT NULL,
    horario TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES cadastro(id_cadastro) ON DELETE CASCADE
);

create table contato(
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL,
 mensagem VARCHAR(5000) NOT NULL
);

-- Mostrar todas as tabelas criadas
SHOW TABLES;


select * from cart;
select * from agendamentos;

ALTER TABLE cadastro MODIFY senha VARCHAR(255) NOT NULL;
ALTER TABLE cabelo AUTO_INCREMENT = 4;
ALTER TABLE barba AUTO_INCREMENT = 1000;

INSERT INTO `barba` (`id`, `nome_barba`, `preco_barba`, `imagem_barba`) VALUES

(1002, 'barba', 30.00, 'barbacard.png'),
(1003, 'Alisamento', 50.00, 'alisamento.png'),
(1004, 'Pigmentação + barba', 45.00, 'pigmentaçãoBarba.png'),
(1005, 'Sombrancelha', 5.00, 'sombrancelha.png');

-- --------------------------------------------------------

INSERT INTO `cabelo` (`id`, `nome_cabelo`, `preco_cabelo`, `imagem_cabelo`) VALUES
(4, 'Corte', 30.00, 'platinado.png'),
(5, 'Corte + Pigmentação', 40.00, 'pigmentaçãoCorte.png'),
(6, 'Corte + Barba + Pigmen.', 60.00, 'corteBarbaPigmentacao.png'),
(7, 'pintar cabelo', 40.00, 'PintarCabelo.png'),
(8, 'Pigmentação', 25.00, 'pigmentaçãoCorte.png'),
(9, 'alisamento', 30.00, 'alisamento.png');