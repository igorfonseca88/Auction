-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/02/2012 às 20h14min
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
-- Estrutura da tabela `tb_itemleilao`
--

CREATE TABLE IF NOT EXISTS `tb_itemleilao` (
  `idItemLeilao` int(11) NOT NULL AUTO_INCREMENT,
  `idLeilao` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `valorProduto` float NOT NULL,
  `valorFrete` float DEFAULT NULL,
  PRIMARY KEY (`idItemLeilao`),
  KEY `fk_itemleilao_produto` (`idProduto`),
  KEY `fk_itemleilao_leilao` (`idLeilao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_itemleilao`
--
ALTER TABLE `tb_itemleilao`
  ADD CONSTRAINT `fk_itemleilao_leilao` FOREIGN KEY (`idLeilao`) REFERENCES `tb_leilao` (`idLeilao`),
  ADD CONSTRAINT `fk_itemleilao_produto` FOREIGN KEY (`idProduto`) REFERENCES `tb_produto` (`idProduto`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
