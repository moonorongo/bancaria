<?php

// INCLUDE SECTION ------------------------------------------------------------------------------------
// DAOs
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/dao/dao.mysql.php");
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/dao/dao.login.php");
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/dao/dao.noticias.php");
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/dao/dao.imagenes.php");
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/dao/dao.categorias.php");
    
    
// Services    
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/service/service.noticias.php");
    
// Auxiliares
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/class.ViewHelper.php"); 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/class.smtp.php"); 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/class.phpmailer.php"); 

    
    
?>
