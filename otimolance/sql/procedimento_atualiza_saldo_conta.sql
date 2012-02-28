DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `sp_atualizasaldo`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_atualizasaldo`(v_idConta int)
BEGIN

UPDATE tb_conta set saldo = saldo - 1 
               WHERE idConta = v_idConta ;

END$$

DELIMITER ;