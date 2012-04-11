-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/02/2012 às 20h13min
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
-- Estrutura da tabela `tb_leilao`
--

CREATE TABLE IF NOT EXISTS `tb_leilao` (
  `idLeilao` int(11) NOT NULL AUTO_INCREMENT,
  `dataCriacao` datetime NOT NULL,
  `dataInicio` datetime NOT NULL,
  `dataFim` datetime DEFAULT NULL,
  `tempoCronometro` int(11) NOT NULL,
  `valorLeilao` decimal(14,2) DEFAULT NULL,
  `valorInicial` decimal(14,2) NOT NULL,
  `freteGratis` tinyint(1) NOT NULL,
  `idConta` int(11) DEFAULT NULL,
  `idCategoriaLeilao` int(11) NOT NULL,
  `publicado` int(11) NOT NULL DEFAULT '0',
  `idContaArremate` int(11) DEFAULT NULL,
  `valorArremate` decimal(12,2) DEFAULT NULL,
   valorMinimoLeilao decimal(12,2) DEFAULT NULL
  PRIMARY KEY (`idLeilao`),
  KEY `fk_leilao_categorialeilao` (`idCategoriaLeilao`),
  KEY `fk_leilao_conta` (`idConta`),
  KEY `fk_leilao_contaarremate` (`idContaArremate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 


--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_leilao`
--
ALTER TABLE `tb_leilao`
  ADD CONSTRAINT `fk_leilao_contaarremate` FOREIGN KEY (`idContaArremate`) REFERENCES `tb_conta` (`idConta`),
  ADD CONSTRAINT `fk_leilao_categorialeilao` FOREIGN KEY (`idCategoriaLeilao`) REFERENCES `tb_categorialeilao` (`idCategoriaLeilao`),
  ADD CONSTRAINT `fk_leilao_conta` FOREIGN KEY (`idConta`) REFERENCES `tb_conta` (`idConta`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
