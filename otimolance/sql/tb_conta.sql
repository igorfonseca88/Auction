-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 26, 2012 as 02:57 
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
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `receberEmail` bit(1) NOT NULL,
  `aceitarTermo` bit(1) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `dtNascimento` date DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `logradouro` varchar(200) DEFAULT NULL,
  `numero` int(5) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  `celular` varchar(13) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Extraindo dados da tabela `tb_conta`
--

INSERT INTO `tb_conta` (`idConta`, `nome`, `sobrenome`, `cpf`, `email`, `login`, `idTipoUsuario`, `senha`, `receberEmail`, `aceitarTermo`, `ip`, `status`, `sexo`, `dtNascimento`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `estado`, `cidade`, `telefone`, `celular`, `saldo`) VALUES
(13, 'Igor', 'Fonseca', '778.749.361-59', 'igorfonseca88@gmail.com', 'igor', 2, '1', '1', '1', '', 'liberado', 'Masculino', '2012-03-23', '79063-520', 'Rua: Brigadeiro Thiago', 1234, '', 'Universitário', 'MS', 'Campo Grande', '(67)9279-7526', '(67)9279-7526', 88),
(16, 'Administrador', 'do Sistema', '388.576.345-15', 'thiago.berbet@hotmail.com', 'admin', 1, '1', '1', '1', '', 'liberado', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Thiago', 'Berbet', '006.288.131-04', 'thiago.berbet@gmail.com', 'thiago', 2, '123456', '1', '1', '127.0.0.1', 'liberado', '0', '0000-00-00', '79063-520', 'Rua: Brigadeiro Thiago', 2212, '', 'Universitário', '0', 'Campo Grande', '(67)9279-7526', '(67)9279-7526', 100),
(50, 'Thiago', 'Berbet', '945.642.045-05', 'thiago.berbet@hotmail.com', 'thiago10', 2, '123123', '0', '1', '127.0.0.1', 'bloqueado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5);
