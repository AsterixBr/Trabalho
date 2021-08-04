-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jul-2021 às 14:45
-- Versão do servidor: 5.7.21-log
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbphp01`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `idfornecedor` int(11) NOT NULL,
  `nomeFornecedor` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(65) NOT NULL,
  `bairro` varchar(65) NOT NULL,
  `cidade` varchar(65) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `representante` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telfixo` varchar(20) NOT NULL,
  `telcel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idfornecedor`, `nomeFornecedor`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`, `cep`, `representante`, `email`, `telfixo`, `telcel`) VALUES
(1, 'adfasdf', 'asdfasdf', '23', 'asdfasdfas', 'asdfasdf', 'asdfas', 'DF', '23423423', 'dfsdsdf', 'asdf@asdf.com', '24232323', '43434332'),
(2, 'Chuchus', 'ksdfksjdkf', '23', 'sdfkajsdkfj', 'dsf', 'sdfasdf', 'df', '23423423', 'dkfaksd', 'asdfas@zsdf', '342344', '2342342'),
(3, 'Adidas', 'sdfjas', '23', 'alksdfj', 'kjsfdkj', 'sldkfjskf', 'DF', '2348927834', 'faklsdfj', 'adidas@adidas.com', '223424', '534535');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `dtNasc` date NOT NULL,
  `login` varchar(65) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da tabela produto',
  `nome` varchar(255) NOT NULL COMMENT 'campo string para receber o nome do produto',
  `vlrCompra` decimal(18,2) NOT NULL COMMENT 'campo para receber o valor de compra do produto',
  `vlrVenda` decimal(18,2) NOT NULL COMMENT 'campo para receber o valor de venda do produto',
  `qtdEstoque` int(11) NOT NULL COMMENT 'campo referente ao total de produto em estoque',
  `fkFornecedor` int(11) NOT NULL COMMENT 'campo que referencia o fornecedor do produto.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `vlrCompra`, `vlrVenda`, `qtdEstoque`, `fkFornecedor`) VALUES
(1, 'Novo', '33.00', '55.00', 11, 3),
(2, 'Camisa Gola Polo Azul', '44.00', '77.00', 22, 3),
(3, 'Boné', '22.00', '33.00', 12, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`idfornecedor`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkFornecedor` (`fkFornecedor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `idfornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da tabela produto', AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`fkFornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
