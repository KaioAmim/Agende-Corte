-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 186.202.152.149
-- Generation Time: 04-Fev-2025 às 00:36
-- Versão do servidor: 5.7.32-35-log
-- PHP Version: 5.6.40-0+deb8u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdbarbearia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_corte` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `horario` time NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `user_id`, `data_corte`, `horario`, `created_at`) VALUES
(1, 1, '03/02/2025', '22:00:00', '2024-11-26 19:22:12'),
(2, 5, '02/12/2024', '10:00:00', '2024-11-26 22:48:38'),
(3, 8, '25/11/2024', '21:00:00', '2024-11-28 01:00:40'),
(4, 10, '10/12/2024', '14:00:00', '2024-12-02 02:05:29'),
(5, 16, '23/12/2024', '19:00:00', '2024-12-04 22:24:10'),
(6, 17, '04/12/2024', '13:00:00', '2024-12-04 22:41:50'),
(7, 18, '11/12/2024', '13:00:00', '2024-12-04 22:46:42'),
(8, 19, '22/01/2025', '20:00:00', '2024-12-04 22:54:29'),
(9, 21, '11/12/2024', '20:00:00', '2024-12-04 23:01:49'),
(10, 22, '11/12/2024', '16:00:00', '2024-12-04 23:02:00'),
(11, 24, '05/12/2024', '15:00:00', '2024-12-04 23:08:35'),
(12, 25, '19/12/2024', '21:00:00', '2024-12-04 23:14:49'),
(13, 27, '14/12/2024', '14:00:00', '2024-12-04 23:45:08'),
(14, 28, '20/12/2024', '15:00:00', '2024-12-04 23:53:20'),
(15, 29, '11/12/2024', '13:00:00', '2024-12-05 00:04:39'),
(16, 32, '25/12/2024', '13:00:00', '2024-12-05 00:36:25'),
(17, 34, '26/12/2024', '18:00:00', '2024-12-05 00:59:51'),
(18, 35, '30/04/2025', '18:00:00', '2024-12-05 02:57:23'),
(19, 36, '10/12/2024', '20:00:00', '2024-12-10 22:51:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `barba`
--

CREATE TABLE `barba` (
  `id` int(11) NOT NULL,
  `nome_barba` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `preco_barba` decimal(10,2) NOT NULL,
  `imagem_barba` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `barba`
--

INSERT INTO `barba` (`id`, `nome_barba`, `preco_barba`, `imagem_barba`) VALUES
(1000, 'platinado', 120.00, 'platinado.png'),
(1001, 'platinado', 120.00, 'platinado.png'),
(1002, 'barba', 30.00, 'barbacard.png'),
(1003, 'Alisamento', 50.00, 'alisamento.png'),
(1004, 'Pigmentação + barba', 45.00, 'pigmentaçãoBarba.png'),
(1005, 'Sombrancelha', 5.00, 'sombrancelha.png'),
(1006, 'Corte Cabelo', 35.00, 'corte.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cabelo`
--

CREATE TABLE `cabelo` (
  `id` int(11) NOT NULL,
  `nome_cabelo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `preco_cabelo` decimal(10,2) NOT NULL,
  `imagem_cabelo` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `cabelo`
--

INSERT INTO `cabelo` (`id`, `nome_cabelo`, `preco_cabelo`, `imagem_cabelo`) VALUES
(4, 'Corte', 30.00, 'corte.png'),
(5, 'Corte + Pigmentação', 40.00, 'pigmentaçãoCorte.png'),
(6, 'Corte + Barba + Pigmen.', 60.00, 'corteBarbaPigmentacao.png'),
(7, 'pintar cabelo', 40.00, 'PintarCabelo.png'),
(8, 'Pigmentação', 25.00, 'pigmentaçãoCorte.png'),
(9, 'alisamento', 30.00, 'alisamento.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cadastro` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id_cadastro`, `nome`, `telefone`, `senha`) VALUES
(1, 'kaio', '(17) 99279-2100', '$2y$10$pdP8WfuLORCtlHHnL4RoQeOCee8Fr5qDuzjjLFPeXLgBKyieJAC0W'),
(3, 'Ana clara de Carvalho Machado', '(17) 98820-3724', '$2y$10$4GUlJtyTdJobacx4MmkXhuHHD/wtibHAQRCLO148KkNsaDdzePh0m'),
(4, 'Vini', '(17) 99127-7376', '$2y$10$gNtlEmpxdCs2Phs8nClrGuPiOZNDDyhqUms96R199RpWCqNFvDN/m'),
(5, 'Bruno', '(17) 99149-5587', '$2y$10$CSXDYjaa.W8/8PQ0IGwF2.QM/29X4xYMfT0A/8AvZDjrO28O4w52i'),
(6, 'Lucas Ribeiro ', '(17) 98156-6361', '$2y$10$4goux6Moh6Lsi.L/HVeSeOVfmdKVAtUYorSzC/KOstluSqsro1/Xm'),
(8, 'Katia', '(17) 98190-1414', '$2y$10$e8G5SmZRw2s9IynSQueVxerg0DwxSyqq6CoLHONtNCMapiBNmMruq'),
(9, 'Lais', '(17) 99112-9323', '$2y$10$gfk2bIYlxMVvyoxteaH7Du.xKcPRgjzOxjgLhDhLwZ4iTz9Yaktq.'),
(10, 'JoÃ£o pedro', '(17) 98843-1889', '$2y$10$MdRtKEBc00MrtOOe3Xs48umH5uzxvazxdXnzorUucAqkZAetgKLHG'),
(16, 'davi calatroia', '(17) 98819-0165', '$2y$10$FZiFF0STqE3uUODuzteYGecwFW.bdOKMORbBQinjFdU.L9KH4q1n2'),
(17, 'marcilio trucullo', '(17) 99151-6052', '$2y$10$uPhCJmEFUNwlPIJQ9f/mTenbPn0DSABLLTn97xWGVyh2i/koPLrDC'),
(18, 'Gabrielli Martins ', '(17) 99186-1946', '$2y$10$PXAUgCVsv4bP2ZAT8TUzWubv/RubC3XXgl8DghraZqDQNY2Qza/Gq'),
(19, 'moacir', '(17) 98178-5082', '$2y$10$.f2Bsd4roqJE.Oas5xYWk.UEz.OUCBzXnZoA4Po3njIhjWM6WEih2'),
(20, 'moacir', '(17) 98178-5082', '$2y$10$0Az1Og2i.omWw9CEqjkjgeLSaaigEKkGmdGEGjNJRQ/uTPHLJQBVe'),
(21, 'gabrielly', '(17) 98844-8879', '$2y$10$Aq.hlEcKBtnNkDxIZ41oZeCD0TeaM3bfJMNWKMGt1FoZofpB4FdPO'),
(22, 'Vinicius ', '(17) 99124-4206', '$2y$10$StsONBmEFe3mGYHYMo/7neq8kbDxU1LLnJpuIgTIscCGWrc3YBFym'),
(24, 'Heitor Araujo Moreira', '(17) 98817-4848', '$2y$10$SJGBrtDNqAflzFn9JMc8teNIgGcVhmUV.aFYHe8fKaTN600lmU85S'),
(25, 'gabriel', '(17) 99116-0709', '$2y$10$pBvyWJgyJ55Ffj6nEmdbsONp8MkUw8SuN50HvRhajNhXMGrvEoXdW'),
(26, 'Dalpim', '(17) 99196-5185', '$2y$10$Ms9bbpMvgSsy/lFLuIGHeertBUJauo9HU64qlxTs7U3/FB/W3.nI.'),
(27, 'cleiton', '(17) 98844-7599', '$2y$10$sTKFeCSAhYJMcl3Q6o.15ejY4XA1HkYRS5u/.iDztL7O9YugrXdV.'),
(28, 'adryan', '(34) 99812-6299', '$2y$10$GAfprwm0AZHLsw/cgJS.7eosfGoKSLnH1grWXYFuQ3yay5SyM1zB2'),
(29, 'manu', '(17) 98124-1920', '$2y$10$CCovVpVh4AY0jTj.HWPRHOVqrSIDX.6i3y2XoyMjZIx.XaW6qfpp2'),
(30, 'manu', '(17) 98124-1920', '$2y$10$fVwuy2A4ksndfmGu8gmCPeny09Elr6.K4wRxL9U1r8G39GLWHVclG'),
(31, 'Saulo Mafra Peixoto', '(17) 33333-3333', '$2y$10$HRsrWUUsfSpcAONCq8oS9OHXVecVvy09uX1NMJg4b6pEnMyvjTuu.'),
(32, 'ana laura', '(17) 99194-3243', '$2y$10$meesRxO9pmTmWLGEVwJHZOAa9WDnlSbMgJfYEUQ3yX5S.xNiQwf06'),
(33, 'teu pai', '(40) 02892-2222', '$2y$10$1VsWR6IbDIFMpf5qlq2QuuLVpxL1icnbnQDVNInBFL6abbJDjzI3G'),
(34, 'Paulo', '(17) 98148-2743', '$2y$10$Y50Mr/e5Ai5q/pZtUQcAp.L.NQeKolPhlGQq5z6.b.oe15FF2bbZO'),
(35, 'matheus', '(17) 99147-8739', '$2y$10$TbplzRyUPnpp/t8UOGWcy.yt2L61xi.hyWgr7dlwfnH82weo6Bx/m'),
(36, 'Ana Julia', '(17) 98838-4355', '$2y$10$xgSzWXH3wrQ2BnWeY0AfReH6H39FKDR3g6hUXMvrl3YfiIttVP.re'),
(37, 'lucas', '(17) 99279-2100', '$2y$10$6rz9afn3Qb3m97nEEO6K6uE20T2USwaqWZ9LJ4zYkPoHUi8ocVubW'),
(38, 'kaio', '(17) 99279-2100', '$2y$10$/dRy/4KOTkBRGyr23ZIqg.oxwvLPYRz4Nz6f/788b1Xit5DptRv7.'),
(39, 'Hecktor', '(83) 98989-9989', '$2y$10$JjsY56JdW2uUNvGSZPJVkeRuRaPWkiQJ4Ht5MgiZWPRlnzrmFINJS'),
(40, 'kaio', '(17) 99279-2100', '$2y$10$GvBcsA.DkScNtKw324mykensjCuxYW15wdYIaoSEn03W.1At/mQ66'),
(41, 'kaio', '(17) 99279-2100', '$2y$10$p.CIv8yM9yp7eDzE.bXyku1U7tKdKwi49I1/REBEmEhOivTPpbdhq'),
(42, 'kaio', '(17) 99279-2100', '$2y$10$nIpnMI9oJLoSuJ9ImMlsVe6jPC6co/3e2pgtQJCx7Ec2H1ArxDRqi'),
(43, 'kaio', '(17) 99279-2100', '$2y$10$W4y2k09IlWVn.12Zj5L1Aes/MpqS.fZqb9lJIjRSC4Sv93jTk.4ky'),
(44, 'junin', '(11) 11111-1112', '$2y$10$eiJ6PzNdqMbvcTV5.wH3guMycKWjBZe5ShosBEZCRHEsf4PrPWjwa'),
(45, 'junin', '(22) 22222-2222', '$2y$10$eHXlczq6vTaf.v.ahR7BgeV8OkXthJi9GE9kVys/nc83CGwYHY0Ny'),
(46, 'junin', '(12) 22222-2222', '$2y$10$OAtXf1gNFaqEANtJv1Vw6uwC6XaGFQhWjNaa5aDwR5TZ2w3gciLyG'),
(47, '', '', '$2y$10$/2wd6TaE5P24vbppdHbl3u9m5LTvNcMjtLILUkJlkDa0CeQi/SDYW');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `NAME` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `NAME`, `price`, `quantity`, `image`, `created_at`) VALUES
(6, 8, 3, 'Membro PLATINUM VIP', 300.00, 1, 'pacote3.png', '2024-11-28 01:00:29'),
(7, 9, 4, 'Corte', 30.00, 1, 'corte.png', '2024-11-28 01:42:35'),
(22, 16, 2, 'Membro GOLD PREMIUM', 100.00, 1, 'pacote2.png', '2024-12-04 22:24:25'),
(23, 17, 4, 'Corte', 30.00, 1, 'corte.png', '2024-12-04 22:41:15'),
(24, 17, 1, 'Membro SILVER CLASS', 60.00, 1, 'pacote1.png', '2024-12-04 22:41:37'),
(25, 18, 4, 'Corte', 30.00, 1, 'corte.png', '2024-12-04 22:45:58'),
(26, 19, 4, 'Corte', 30.00, 1, 'corte.png', '2024-12-04 22:53:46'),
(27, 21, 4, 'Corte', 30.00, 1, 'corte.png', '2024-12-04 23:01:13'),
(28, 21, 2, 'Membro GOLD PREMIUM', 100.00, 1, 'pacote2.png', '2024-12-04 23:01:36'),
(30, 25, 1002, 'barba', 30.00, 1, 'barbacard.png', '2024-12-04 23:14:09'),
(32, 26, 4, 'Corte', 30.00, 1, 'corte.png', '2024-12-04 23:31:13'),
(33, 27, 1, 'Membro SILVER CLASS', 60.00, 1, 'pacote1.png', '2024-12-04 23:44:46'),
(34, 28, 5, 'Corte + Pigmentação', 40.00, 1, 'pigmentaçãoCorte.png', '2024-12-04 23:50:19'),
(35, 28, 8, 'Pigmentação', 25.00, 1, 'pigmentaçãoCorte.png', '2024-12-04 23:52:42'),
(37, 29, 1004, 'Pigmentação + barba', 45.00, 1, 'pigmentaçãoBarba.png', '2024-12-05 00:04:08'),
(40, 32, 9, 'alisamento', 30.00, 1, 'alisamento.png', '2024-12-05 00:35:47'),
(42, 34, 3, 'Membro PLATINUM VIP', 300.00, 1, 'pacote3.png', '2024-12-05 00:59:36'),
(44, 35, 5, 'Corte + Pigmentação', 40.00, 1, 'pigmentaçãoCorte.png', '2024-12-05 02:56:34'),
(45, 35, 2, 'Membro GOLD PREMIUM', 100.00, 1, 'pacote2.png', '2024-12-05 02:56:49'),
(48, 39, 1000, 'platinado', 120.00, 1, 'platinado.png', '2024-12-26 14:56:25'),
(50, 1, 2, 'Membro GOLD PREMIUM', 100.00, 4, 'pacote2.png', '2025-02-01 21:50:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `mensagem` varchar(5000) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `email`, `mensagem`) VALUES
(1, 'Paulo César', 'kaioamim2006@gmail.com', 'Site dinâmico, de fácil entendimento e agendamento simples e rápido!'),
(4, 'Saulo Mafra Peixoto', 'saulo.peixe@gmail.com', 'Ola eu queria um corte de cabelo simples');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacotes`
--

CREATE TABLE `pacotes` (
  `id_pacotes` int(11) NOT NULL,
  `id_pct1` int(11) DEFAULT NULL,
  `id_pct2` int(11) DEFAULT NULL,
  `id_pct3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pct1`
--

CREATE TABLE `pct1` (
  `id_pct1` int(11) NOT NULL,
  `qtd_cortes` int(11) NOT NULL,
  `preco_pct` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pct2`
--

CREATE TABLE `pct2` (
  `id_pct2` int(11) NOT NULL,
  `qtd_cortes` int(11) NOT NULL,
  `preco_pct` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pct3`
--

CREATE TABLE `pct3` (
  `id_pct3` int(11) NOT NULL,
  `qtd_cortes` int(11) NOT NULL,
  `preco_pct` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `barba`
--
ALTER TABLE `barba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabelo`
--
ALTER TABLE `cabelo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cadastro`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacotes`
--
ALTER TABLE `pacotes`
  ADD PRIMARY KEY (`id_pacotes`),
  ADD KEY `id_pct1` (`id_pct1`),
  ADD KEY `id_pct2` (`id_pct2`),
  ADD KEY `id_pct3` (`id_pct3`);

--
-- Indexes for table `pct1`
--
ALTER TABLE `pct1`
  ADD PRIMARY KEY (`id_pct1`);

--
-- Indexes for table `pct2`
--
ALTER TABLE `pct2`
  ADD PRIMARY KEY (`id_pct2`);

--
-- Indexes for table `pct3`
--
ALTER TABLE `pct3`
  ADD PRIMARY KEY (`id_pct3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `barba`
--
ALTER TABLE `barba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `cabelo`
--
ALTER TABLE `cabelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_cadastro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pacotes`
--
ALTER TABLE `pacotes`
  MODIFY `id_pacotes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pct1`
--
ALTER TABLE `pct1`
  MODIFY `id_pct1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pct2`
--
ALTER TABLE `pct2`
  MODIFY `id_pct2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pct3`
--
ALTER TABLE `pct3`
  MODIFY `id_pct3` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cadastro` (`id_cadastro`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `pacotes`
--
ALTER TABLE `pacotes`
  ADD CONSTRAINT `pacotes_ibfk_1` FOREIGN KEY (`id_pct1`) REFERENCES `pct1` (`id_pct1`),
  ADD CONSTRAINT `pacotes_ibfk_2` FOREIGN KEY (`id_pct2`) REFERENCES `pct2` (`id_pct2`),
  ADD CONSTRAINT `pacotes_ibfk_3` FOREIGN KEY (`id_pct3`) REFERENCES `pct3` (`id_pct3`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
