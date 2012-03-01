-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 01, 2012 as 08:52 
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
  PRIMARY KEY (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `tb_conta`
--

INSERT INTO `tb_conta` (`idConta`, `nome`, `sobrenome`, `cpf`, `email`, `login`, `idTipoUsuario`, `senha`, `receberEmail`, `aceitarTermo`, `ip`) VALUES
(2, 'Willian', 'Witter', '00628813104', 'wwwitter@gmail.com', 'wsilva', 1, '1', '1', '1', NULL),
(13, 'Igor', 'Fonseca', '00628813104', 'igorfonseca88@gmail.com', 'igor', 1, '1', '1', '1', NULL),
(16, 'Thiago', 'Berbet', '00628813104', 'thiago.berbet@gmail.com', 'thiago', 1, '1', '1', '1', NULL);
