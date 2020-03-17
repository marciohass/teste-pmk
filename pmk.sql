-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Mar-2020 às 20:27
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pmk`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `doadores`
--

CREATE TABLE `doadores` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` int(11) NOT NULL,
  `telefone1` varchar(15) NOT NULL,
  `telefone2` varchar(15) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `id_intervalo_doacao` int(11) UNSIGNED NOT NULL,
  `valor_doacao` decimal(10,0) NOT NULL,
  `id_forma_pagamento` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `doadores`
--

INSERT INTO `doadores` (`id`, `nome`, `email`, `cpf`, `telefone1`, `telefone2`, `data_nascimento`, `data_cadastro`, `id_intervalo_doacao`, `valor_doacao`, `id_forma_pagamento`) VALUES
(4, 'Marcio Teste', 'marcio@teste.com', 222222, '(11) 98768-7687', '(11) 76576-5757', '1980-12-12', '2020-03-17 00:00:00', 1, '20', 2),
(5, 'João do Pulo', 'joao@jj.com', 333333, '(11) 65757-5757', '(11) 54354-5354', '1976-02-22', '2020-03-17 00:00:00', 3, '300', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) UNSIGNED NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `cep` varchar(9) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `id_doador` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `logradouro`, `numero`, `complemento`, `cep`, `UF`, `cidade`, `id_doador`) VALUES
(2, 'Rua de teste', '222', 'dsadas', '76575-676', 'SP', 'São Paulo', 4),
(3, 'rua do jaoo', '2', 'sdas', '66546-546', 'RJ', 'Rio de Janeiro', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id`, `descricao`) VALUES
(1, 'Débito'),
(2, 'Crédito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `intervalo_doacao`
--

CREATE TABLE `intervalo_doacao` (
  `id` int(11) UNSIGNED NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `intervalo_doacao`
--

INSERT INTO `intervalo_doacao` (`id`, `descricao`) VALUES
(1, 'Único'),
(2, 'Bimestral'),
(3, 'Semestral'),
(4, 'Anual');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `doadores`
--
ALTER TABLE `doadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_intervalo_doacao` (`id_intervalo_doacao`),
  ADD KEY `id_forma_pagamento` (`id_forma_pagamento`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doador` (`id_doador`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Índices para tabela `intervalo_doacao`
--
ALTER TABLE `intervalo_doacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `doadores`
--
ALTER TABLE `doadores`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `intervalo_doacao`
--
ALTER TABLE `intervalo_doacao`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `doadores`
--
ALTER TABLE `doadores`
  ADD CONSTRAINT `doadores_ibfk_1` FOREIGN KEY (`id_intervalo_doacao`) REFERENCES `intervalo_doacao` (`id`),
  ADD CONSTRAINT `doadores_ibfk_2` FOREIGN KEY (`id_forma_pagamento`) REFERENCES `forma_pagamento` (`id`);

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `enderecos_ibfk_1` FOREIGN KEY (`id_doador`) REFERENCES `doadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
