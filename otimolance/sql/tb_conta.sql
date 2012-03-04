-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 02, 2012 as 02:52 
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `otimolance`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conta`
--

CREATE TABLE IF NOT EXISTS `tb_conta` (
  `idConta` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `receberEmail` bit(1) NOT NULL,
  `aceitarTermo` bit(1) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  saldo	decimal(14,2) NOT NULL DEFAULT 0.00	
  PRIMARY KEY (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `tb_conta`
--

INSERT INTO `tb_conta` (`idConta`, `nome`, `sobrenome`, `cpf`, `email`, `login`, `idTipoUsuario`, `senha`, `receberEmail`, `aceitarTermo`, `ip`, `status`) VALUES
(2, 'Willian', 'Witter', '00628813104', 'wwwitter@gmail.com', 'wsilva', 1, '1', '1', '1', '', 'liberado'),
(13, 'Igor', 'Fonseca', '00628813104', 'igorfonseca88@gmail.com', 'igor', 1, '1', '1', '1', '', 'liberado'),
(16, 'Thiago', 'Berbet', '00628813104', 'thiago.berbet@gmai.com', 'thiago', 1, '1', '1', '1', '', 'liberado'),
(27, 'Teste', 'Teste', '22923024036', 'thiago.berbet@hotmail.com', 'teste', 2, '1', '1', '1', '127.0.0.1', 'liberado');