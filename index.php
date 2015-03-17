<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php"); 
    $mysql = Mysql::getInstance();
    $mysql->connect();
?>    
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/header.php"); ?>
        <div id="content" class="content">
            <div id="sidebar" class="sidebar">
            <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/sidebar/search.php"); ?>
            <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/sidebar/novedades.php"); ?>
            <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/sidebar/masleidos.php"); ?>
            <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/sidebar/twitter.php"); ?>
            </div>

            
            <div id="mainContent" class="mainContent">
                <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/home_destacados.php"); ?>
                <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/home_secciones.php"); ?>
            </div> <!-- mainContent -->
            
        </div> <!-- content -->

    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer.php"); ?>
<?php $mysql->close(); ?>