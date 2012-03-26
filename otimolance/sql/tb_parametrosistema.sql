-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Mar 26, 2012 as 02:58 
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
  `padraoEmailRecuperarSenha` varchar(4000) DEFAULT NULL,
  `padraoEmailTrocaDeSenha` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`idParametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_parametrosistema`
--

INSERT INTO `tb_parametrosistema` (`idParametro`, `maxIp`, `emailRemetente`, `numLancesNovoCadastro`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `padraoEmailConfirmarCadastro`, `padraoEmailCadastroConfirmado`, `padraoEmailRecuperarSenha`, `padraoEmailTrocaDeSenha`) VALUES
(1, 5, 'thiago.berbet@gmail.com', 5, 'smtp.gmail.com', '587', 'otimolance@gmail.com', 'wmc749fr', 'Olá,\r\n\r\nEstamos felizes por querer fazer parte do OtimoLance!\r\n\r\nPor medidas de segurança, precisamos validar o e-mail cadastrado para que possamos ativar sua conta.\r\n\r\nPara ativar sua conta e participar do OtimoLance, clique no link abaixo: \r\n%s\r\n\r\nAtenção: verifique se os dados cadastrados estão corretos. Caso seja identificada alguma divergência, no caso de arremate e/ou compra de produtos, a entrega poderá ser prejudicada.\r\n\r\nObrigado\r\n\r\nUm Abraço,\r\n\r\nEquipe OtimoLance', 'Olá, \r\n\r\nSeu cadastro foi confirmado. Seja bem-vindo(a) ao OtimoLance, o site de leilões de centavos onde você não perde o dinheiro investido na compra de lances!\r\n\r\nSeus dados de acesso são:\r\n\r\n%s\r\n\r\nPara darmos uma forcinha em seus primeiros leilões, você ganhará um super desconto em sua 1ª compra de pacote de lances! Basta clicar no link abaixo e escolher seu pacote de lances que o desconto aparecerá automaticamente na sacola de compras.\r\n\r\nhttp://localhost/otimolance/compraController/comprarLances \r\n\r\nCom seus lances em estoque, escolha o leilão que quer participar e prepare sua estratégia. \r\n\r\nLembramos que caso não vença o leilão, você poderá usar o valor pago pelos lances dados como desconto na compra do produto em até 24 horas após a finalização do mesmo, ou estes lances serão automaticamente convertidos em bônus para usar em nossos parceiros ou como novos lances.\r\n\r\nÉ um prazer ter você com a gente!\r\n\r\nUm Abraço,\r\n\r\nEquipe OtimoLance', 'Olá,\r\n\r\nFoi recuperada a senha do seu cadastro.\r\n\r\n%s\r\n%s\r\n\r\nVocê poderá alterar a senha indicada acima para outra de sua preferência. Para isso, siga os seguintes passos: \r\n\r\n1° - Insira o usuário e senha indicados acima na página principal do site;\r\n2° - Após de logar-se, selecione a opção “Minha conta”;\r\n3° - Dentro da página “Minha conta”, selecione a opção “Alterar senha” que fica na parte inferior do menu lateral;\r\n4° - Insira a senha atual, que está sendo indicada neste e-mail, e em seguida escreva a senha que desejar.\r\n\r\nCaso tenha dúvidas, reclamações, elogios e/ou sugestões entre em contato através do e-mail otimolance@gmail.com\r\n\r\nUm abraço,\r\n\r\nEquipe OtimoLance', 'Olá,\r\n\r\nFoi solicitada uma nova senha para o seu cadastro.\r\n\r\n%s\r\n%s\r\n\r\nVocê poderá alterar a senha indicada acima para outra de sua preferência. Para isso, siga os seguintes passos: \r\n\r\n1° - Insira o usuário e senha indicados acima na página principal do site;\r\n2° - Após de logar-se, selecione a opção “Perfil”;\r\n3° - Dentro da página “Perfil”, selecione a opção “Alterar senha” que fica na parte inferior do menu lateral;\r\n4° - Insira a senha atual, que está sendo indicada neste e-mail, e em seguida escreva a senha que desejar.\r\n\r\nCaso tenha dúvidas, reclamações, elogios e/ou sugestões entre em contato através do e-mail otimolance@gmail.com\r\n\r\nUm abraço!\r\n\r\nEquipe OtimoLance');
