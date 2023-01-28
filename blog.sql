-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 28-Jan-2023 às 13:26
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigos`
--

CREATE TABLE `artigos` (
  `idArtigo` int NOT NULL,
  `tituloArtigo` varchar(250) NOT NULL,
  `textoArtigo` text NOT NULL,
  `dataArtigo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `artigos`
--

INSERT INTO `artigos` (`idArtigo`, `tituloArtigo`, `textoArtigo`, `dataArtigo`) VALUES
(6, 'Session e Cookies', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris luctus turpis lacinia tortor egestas, vel blandit nisl dictum. Nunc at elementum eros. Mauris justo turpis, tincidunt eu sodales nec, consectetur malesuada augue. Nullam iaculis, quam a fermentum vulputate, leo metus rhoncus ipsum, non iaculis massa odio eget diam. Nullam eget nunc sit amet eros vestibulum egestas. Nullam efficitur arcu id quam suscipit, et suscipit lectus bibendum. Praesent quis fermentum metus. Morbi nisi ipsum, tincidunt vel quam ut, suscipit porttitor sapien. Mauris at velit rutrum, imperdiet lorem rutrum, dictum felis. Maecenas scelerisque justo vitae magna tristique, ac auctor dolor porttitor. Morbi fermentum nisi odio, iaculis ultrices orci tincidunt a. Duis interdum, nibh eu accumsan imperdiet, metus mauris commodo massa, ut venenatis ex augue posuere lectus.\r\n\r\nPellentesque sit amet pharetra arcu, nec consectetur arcu. Suspendisse et lacus finibus, luctus ex eu, feugiat purus. Cras semper neque ipsum, ut mollis quam aliquam quis. Donec nec tellus nunc. Proin semper accumsan pulvinar. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur suscipit ipsum at imperdiet interdum. Nunc laoreet vel arcu a vulputate. Fusce in pellentesque nisi, sed porta velit. Maecenas enim mauris, vulputate ut efficitur at, egestas commodo neque. Nulla blandit lobortis felis vitae ultrices. Fusce ligula nibh, rutrum id ante eu, posuere mollis magna.\r\n\r\nCras ac condimentum libero, ut mattis neque. Nulla eu diam porta, semper leo a, volutpat erat. Aenean volutpat eros tortor, vitae fermentum ligula pellentesque eu. Nunc quis dolor felis. Aliquam nibh nisi, varius a varius non, faucibus sit amet metus. Praesent gravida lacus vel erat efficitur, nec maximus metus imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque magna erat, ultrices sed placerat in, convallis et sem. Pellentesque lacus nulla, tincidunt id lorem eget, congue hendrerit justo. In hac habitasse platea dictumst.', '2023-01-26 20:09:29'),
(7, 'e ainda outro', 'Cras ac condimentum libero, ut mattis neque. Nulla eu diam porta, semper leo a, volutpat erat. Aenean volutpat eros tortor, vitae fermentum ligula pellentesque eu. Nunc quis dolor felis. Aliquam nibh nisi, varius a varius non, faucibus sit amet metus. Praesent gravida lacus vel erat efficitur, nec maximus metus imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque magna erat, ultrices sed placerat in, convallis et sem. Pellentesque lacus nulla, tincidunt id lorem eget, congue hendrerit justo. In hac habitasse platea dictumst.\r\n\r\nAenean porttitor auctor neque. Nam eu faucibus dui, ac venenatis nulla. Sed orci magna, varius id ex sodales, dictum ornare eros. Nullam vitae arcu ante. Sed id metus tellus. Nam interdum pretium nulla, sed venenatis sem tincidunt tempor. Sed ullamcorper volutpat ipsum, sed porta ante faucibus non. In hac habitasse platea dictumst. Vivamus venenatis imperdiet ex, efficitur accumsan lacus. Nullam id turpis at tellus maximus gravida. Morbi nec ipsum ullamcorper, ultrices risus at, viverra quam. Sed vitae ante ac nibh feugiat efficitur.\r\n\r\nVestibulum hendrerit justo lectus, at lobortis purus convallis in. Aliquam fringilla pellentesque cursus. Morbi mattis tincidunt urna, ut blandit velit placerat hendrerit. Ut malesuada vel orci quis blandit. Duis ex nisl, bibendum eleifend lorem id, lacinia tempor nisl. Vestibulum tempor imperdiet ipsum, quis cursus sem scelerisque ut. Donec et metus ante. Aliquam erat volutpat. In sagittis, risus sit amet ultrices accumsan, erat sem iaculis lectus, vel aliquet felis nulla vitae diam. Fusce commodo nisi purus, vel porta metus sodales eu. Vivamus sit amet orci a erat cursus hendrerit. In hac habitasse platea dictumst. Nunc ipsum risus, vulputate vitae metus vitae, imperdiet dignissim dui. Sed sed lectus non enim vestibulum aliquet at quis erat. Duis dignissim interdum leo suscipit maximus. Quisque volutpat lectus non ex pharetra, eget ullamcorper mi efficitur.', '2023-01-26 20:10:29'),
(9, 'Pergunta222', 'ffsdfsd2222', '2023-01-28 12:42:37'),
(11, 'O que é o Express?', 'ererterter', '2023-01-28 13:25:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentario` int NOT NULL,
  `idArtigo` int NOT NULL,
  `comentario` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(50) NOT NULL DEFAULT 'Anónimo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`idComentario`, `idArtigo`, `comentario`, `data`, `nome`) VALUES
(1, 7, 'Excelente! Parabéns!!', '2023-01-26 21:52:09', 'Anónimo'),
(2, 6, 'Não concordo...', '2023-01-26 21:52:34', 'Rui'),
(3, 7, 'nvnnvnvn', '2023-01-28 11:03:58', 'Fernando Lira'),
(4, 7, 'erferferferferf', '2023-01-28 11:04:27', 'outo'),
(5, 7, 'dfgfd', '2023-01-28 11:06:51', 'dfg'),
(6, 7, 'dgdgd', '2023-01-28 11:07:58', 'Fernando Jorge Lira de Meireles'),
(7, 7, 'escreve algo', '2023-01-28 12:00:38', 'Matia'),
(8, 7, 'escreve algoghjgjhg', '2023-01-28 12:01:07', 'Matia'),
(9, 6, 'outrtrro', '2023-01-28 12:04:34', 'Fernando');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `nomeUtilizador` varchar(20) NOT NULL,
  `palavraPasse` varchar(100) NOT NULL,
  `nome` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`nomeUtilizador`, `palavraPasse`, `nome`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Fernando Lira');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artigos`
--
ALTER TABLE `artigos`
  ADD PRIMARY KEY (`idArtigo`);

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artigos`
--
ALTER TABLE `artigos`
  MODIFY `idArtigo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
