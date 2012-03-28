-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 28, 2012 as 03:37 
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
-- Estrutura da tabela `tb_tipoaquisicao`
--

CREATE TABLE IF NOT EXISTS `tb_tipoaquisicao` (
  `idTipoAquisicao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`idTipoAquisicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_tipoaquisicao`
--

INSERT INTO `tb_tipoaquisicao` (`idTipoAquisicao`, `nome`) VALUES
(1, 'Gratuito (parceiros)');
