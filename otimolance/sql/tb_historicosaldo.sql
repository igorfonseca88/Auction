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
-- Estrutura da tabela `tb_historicosaldo`
--

CREATE TABLE IF NOT EXISTS `tb_historicosaldo` (
  `idHistoricoSaldo` int(11) NOT NULL AUTO_INCREMENT,
  `dataCadastro` date NOT NULL,
  `qtdeLances` int(11) NOT NULL,
  `idTipoAquisicao` int(11) NOT NULL,
  `idConta` int(11) NOT NULL,
  PRIMARY KEY (`idHistoricoSaldo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_historicosaldo`
--

INSERT INTO `tb_historicosaldo` (`idHistoricoSaldo`, `dataCadastro`, `qtdeLances`, `idTipoAquisicao`, `idConta`) VALUES
(1, '2012-03-28', 5, 1, 52),
(2, '2012-03-27', 5, 1, 48);
