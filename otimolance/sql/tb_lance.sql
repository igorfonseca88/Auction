-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 13/03/2012 às 20h38min
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
-- Estrutura da tabela `tb_lance`
--

CREATE TABLE IF NOT EXISTS `tb_lance` (
  `idLance` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `idConta` int(11) NOT NULL,
  `idLeilao` int(11) NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`idLance`),
  KEY `fk_lance_leilao` (`idLeilao`),
  KEY `fk_lance_conta` (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `tb_lance`
--



--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_lance`
--
ALTER TABLE `tb_lance`
  ADD CONSTRAINT `fk_lance_conta` FOREIGN KEY (`idConta`) REFERENCES `tb_conta` (`idConta`),
  ADD CONSTRAINT `fk_lance_leilao` FOREIGN KEY (`idLeilao`) REFERENCES `tb_leilao` (`idLeilao`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
