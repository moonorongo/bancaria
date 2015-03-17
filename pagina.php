<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php"); 
    $mysql = Mysql::getInstance();
    $mysql->connect();
    $id = $_REQUEST["id"]; // LIMPIAR LO Q VENGA ACA
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
                <div class="post">            
                    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/pages/$id.php"); ?>
                    
                    <div style="text-align: center; height: 35px; margin-top: 30px">
                    <a href="javascript:history.back();" class="destacadoPostButton destacadoPostButtonVerMas">Volver</a> 
                    </div>
                </div>
            </div> <!-- mainContent -->
        </div> <!-- content -->
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer.php"); ?>
<?php $mysql->close(); ?>    