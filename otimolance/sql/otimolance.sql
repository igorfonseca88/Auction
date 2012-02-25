-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/02/2012 às 20h19min
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
-- Estrutura da tabela `tb_categoria`
--

CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `idCategoria` int(15) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`idCategoria`, `nome`) VALUES
(1, 'Apple');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categorialeilao`
--

CREATE TABLE IF NOT EXISTS `tb_categorialeilao` (
  `idCategoriaLeilao` int(11) NOT NULL AUTO_INCREMENT,
  `categoriaLeilao` varchar(200) NOT NULL,
  PRIMARY KEY (`idCategoriaLeilao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_categorialeilao`
--

INSERT INTO `tb_categorialeilao` (`idCategoriaLeilao`, `categoriaLeilao`) VALUES
(1, 'Nunca venci'),
(2, 'Expert');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_conta`
--

CREATE TABLE IF NOT EXISTS `tb_conta` (
  `idConta` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `receberEmail` int(11) DEFAULT NULL,
  `aceitarTermo` int(11) DEFAULT NULL,
  `saldo` decimal(14,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_conta`
--

INSERT INTO `tb_conta` (`idConta`, `login`, `idTipoUsuario`, `senha`, `nome`, `sobrenome`, `cpf`, `email`, `receberEmail`, `aceitarTermo`, `saldo`) VALUES
(1, 'admin', 2, 'admin', 'igor teste', '', NULL, NULL, NULL, NULL, 0.00),
(2, 'igor', 1, '12345', NULL, '', NULL, NULL, NULL, NULL, 0.00),
(3, 'fernanda', 2, '12345', 'fernanda', '', NULL, NULL, NULL, NULL, 37.00);

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
  `valorArremate` float DEFAULT NULL,
  `idContaArremate` int(11) DEFAULT NULL,
  PRIMARY KEY (`idItemLeilao`),
  KEY `fk_itemleilao_produto` (`idProduto`),
  KEY `fk_itemleilao_leilao` (`idLeilao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_itemleilao`
--

INSERT INTO `tb_itemleilao` (`idItemLeilao`, `idLeilao`, `idProduto`, `valorProduto`, `valorFrete`, `valorArremate`, `idContaArremate`) VALUES
(1, 2, 1, 2890, 100, NULL, NULL),
(2, 6, 1, 2890, 100, NULL, NULL),
(3, 7, 1, 2890, 200, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Extraindo dados da tabela `tb_lance`
--

INSERT INTO `tb_lance` (`idLance`, `data`, `idConta`, `idLeilao`, `valor`) VALUES
(43, '2012-02-24 19:49:07', 1, 2, 0.01),
(44, '2012-02-24 19:49:12', 3, 2, 0.02),
(45, '2012-02-24 19:49:18', 1, 2, 0.03),
(46, '2012-02-24 19:49:20', 3, 2, 0.04),
(47, '2012-02-24 19:49:26', 3, 2, 0.05),
(48, '2012-02-24 19:49:30', 1, 2, 0.06),
(49, '2012-02-24 19:49:31', 3, 2, 0.07),
(50, '2012-02-24 19:49:43', 1, 2, 0.08),
(51, '2012-02-24 19:49:44', 3, 2, 0.09),
(52, '2012-02-24 19:49:55', 1, 2, 0.1),
(53, '2012-02-24 19:49:57', 3, 2, 0.11),
(54, '2012-02-24 19:50:04', 1, 2, 0.12),
(55, '2012-02-24 19:50:05', 3, 2, 0.13),
(56, '2012-02-24 19:50:12', 3, 2, 0.14),
(57, '2012-02-24 19:50:21', 1, 2, 0.15),
(58, '2012-02-24 19:50:22', 3, 2, 0.16);

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
  PRIMARY KEY (`idLeilao`),
  KEY `fk_leilao_categorialeilao` (`idCategoriaLeilao`),
  KEY `fk_leilao_conta` (`idConta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_leilao`
--

INSERT INTO `tb_leilao` (`idLeilao`, `dataCriacao`, `dataInicio`, `dataFim`, `tempoCronometro`, `valorLeilao`, `valorInicial`, `freteGratis`, `idConta`, `idCategoriaLeilao`, `publicado`) VALUES
(2, '0000-00-00 00:00:00', '2012-02-24 19:49:00', NULL, 15, 0.01, 0.00, 0, 2, 1, 1),
(6, '2012-01-25 19:41:17', '2012-02-24 19:42:00', NULL, 15, 1.00, 0.00, 0, 2, 1, 1),
(7, '2012-02-15 21:53:39', '2012-02-23 21:10:00', NULL, 15, 1.00, 0.00, 0, 2, 1, 0),
(8, '2012-02-16 21:57:58', '2012-02-16 23:00:00', NULL, 15, 1.00, 0.00, 0, 2, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_parametrosistema`
--

CREATE TABLE IF NOT EXISTS `tb_parametrosistema` (
  `idParametro` int(11) NOT NULL,
  `maxIp` int(2) DEFAULT NULL,
  `emailRemetente` varchar(100) DEFAULT NULL,
  `numLancesNovoCadastro` int(3) DEFAULT NULL,
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_port` varchar(5) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `padraoEmailConfirmarCadastro` varchar(4000) DEFAULT NULL,
  `padraoEmailCadastroConfirmado` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`idParametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_parametrosistema`
--

INSERT INTO `tb_parametrosistema` (`idParametro`, `maxIp`, `emailRemetente`, `numLancesNovoCadastro`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `padraoEmailConfirmarCadastro`, `padraoEmailCadastroConfirmado`) VALUES
(1, 0, 'igorfonseca88@gmail.com', 5, '', '', '', '', 'Olá, precisamos confirmar seu cadastro, clique aqui %LINKCONFIRMACAO%', 'Olá, %NOME% <br/>  Seu cadastro foi confirmado com sucesso.  <br/>  Seus dados de acesso são:  %DADOSACESSO%');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produto`
--

CREATE TABLE IF NOT EXISTS `tb_produto` (
  `idProduto` int(15) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET latin1 NOT NULL,
  `descricao` text CHARACTER SET latin1 NOT NULL,
  `idCategoria` int(15) NOT NULL,
  `preco` float NOT NULL,
  PRIMARY KEY (`idProduto`),
  KEY `fk_produto_categoria` (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `tb_produto`
--

INSERT INTO `tb_produto` (`idProduto`, `nome`, `descricao`, `idCategoria`, `preco`) VALUES
(1, 'MacBook', 'MacBook de 13 polegadas', 1, 2890);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipousuario`
--

CREATE TABLE IF NOT EXISTS `tb_tipousuario` (
  `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipoUsuario` varchar(50) NOT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tb_tipousuario`
--

INSERT INTO `tb_tipousuario` (`idTipoUsuario`, `tipoUsuario`) VALUES
(1, 'administrador'),
(2, 'cliente'),
(3, 'interno');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `tb_itemleilao`
--
ALTER TABLE `tb_itemleilao`
  ADD CONSTRAINT `fk_itemleilao_leilao` FOREIGN KEY (`idLeilao`) REFERENCES `tb_leilao` (`idLeilao`),
  ADD CONSTRAINT `fk_itemleilao_produto` FOREIGN KEY (`idProduto`) REFERENCES `tb_produto` (`idProduto`);

--
-- Restrições para a tabela `tb_lance`
--
ALTER TABLE `tb_lance`
  ADD CONSTRAINT `fk_lance_conta` FOREIGN KEY (`idConta`) REFERENCES `tb_conta` (`idConta`),
  ADD CONSTRAINT `fk_lance_leilao` FOREIGN KEY (`idLeilao`) REFERENCES `tb_leilao` (`idLeilao`);

--
-- Restrições para a tabela `tb_leilao`
--
ALTER TABLE `tb_leilao`
  ADD CONSTRAINT `fk_leilao_categorialeilao` FOREIGN KEY (`idCategoriaLeilao`) REFERENCES `tb_categorialeilao` (`idCategoriaLeilao`),
  ADD CONSTRAINT `fk_leilao_conta` FOREIGN KEY (`idConta`) REFERENCES `tb_conta` (`idConta`);

--
-- Restrições para a tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `tb_categoria` (`idCategoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
