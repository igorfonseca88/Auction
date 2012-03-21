-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 20/03/2012 às 20h25min
-- Versão do Servidor: 5.5.16
-- Versão do PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `otimolance`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido`
--

CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `total` float NOT NULL,
  `desconto` decimal(10,0) NOT NULL,
  `idConta` int(11) NOT NULL,
  `idLeilao` int(11)  NULL,
  `status` varchar(20) NOT NULL,
  `dataCriacao` datetime NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Extraindo dados da tabela `tb_pedido`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
