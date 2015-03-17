<?php 
    session_start();
    
    if(!isset($_SESSION['LOGGED'])) {
        header('Location: http://'. $_SERVER['SERVER_NAME']); 
    } else {
    
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php");
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/header_admin.php");

        // aca algo con los contenidos de la configuracion
        
        
        
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer_admin.php");

    }    

?>

