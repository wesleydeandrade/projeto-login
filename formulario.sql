-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/04/2024 às 23:02
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `formulario`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `certificado`
--

CREATE TABLE `certificado` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `data_certificacao` date NOT NULL,
  `validade` varchar(45) NOT NULL,
  `certificado_pdf` blob NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_vencimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `certificado`
--

INSERT INTO `certificado` (`id`, `titulo`, `data_certificacao`, `validade`, `certificado_pdf`, `usuario_id`, `data_vencimento`) VALUES
(1, 'Titulo', '2024-04-19', 'vitalicia', '', 0, NULL),
(2, 'Titulo', '2024-04-19', 'vitalicia', '', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `email` varchar(110) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_nasc` date NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `email`, `telefone`, `sexo`, `data_nasc`, `cidade`, `estado`, `endereco`) VALUES
(1, 'Wesley Gustavo de Andrade', '', 'volki.sims@gmail.com', '(16) 99170-0590', 'masculino', '2024-04-10', 'Monte Alto', 'São Paulo', 'Rua das acácias '),
(2, 'Wesley Gustavo de Andrade', '', 'volki.sims@gmail.com', '(16) 99170-0590', 'masculino', '2024-04-09', 'Monte Alto', 'São Paulo', 'Rua das acácias '),
(3, 'mariana coelho silva', '1234', 'volki.sims@gmail.com', '(16) 99170-0590', 'masculino', '2024-04-16', 'Monte Alto', 'São Paulo', 'Rua das acácias '),
(4, 'Lucas Netto', '4321', 'lucas@neto.com', '(16) 99170-0590', 'masculino', '2024-04-26', 'Monte Alto', 'São Paulo0', 'Rua das acácias '),
(5, 'Ines Brasil', '110492', 'Ines@brasil.com', '(16) 99170-0590', 'feminino', '2008-02-13', 'Monte Alto', 'São Paulo0', 'Rua das acácias ');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
