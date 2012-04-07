<?php if (!defined('ALLOW_PAGSEGURO_CONFIG')) { die('No direct script access allowed'); }
/*
************************************************************************
PagSeguro Config File
************************************************************************
*/

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = Array();
$PagSeguroConfig['environment']['environment'] = "production";

$PagSeguroConfig['credentials'] = Array();
$PagSeguroConfig['credentials']['email'] = "wwwitters@gmail.com";
$PagSeguroConfig['credentials']['token'] = "2C36B0FEB8844C62947D65145B09115A";

$PagSeguroConfig['application'] = Array();
$PagSeguroConfig['application']['charset'] = "ISO-8859-1"; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = Array();
//INFORMA SE O LOG ESTA ATIVO = TRUE ou INATIVO = FALSE
$PagSeguroConfig['log']['active'] = TRUE;
//LOCAL ONDE SE ENCONTRA O ARQUIVO DE LOG
$PagSeguroConfig['log']['fileLocation'] = "logs/log.txt";

?>