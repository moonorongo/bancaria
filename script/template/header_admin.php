<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>La Bancaria - Bahía Blanca</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="keywords" content="">  
    <meta name="description" content="">

    <link rel="stylesheet" type="text/css" href="../static/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../static/css/main_admin.css">
    <link rel="stylesheet" type="text/css" href="../static/css/aristo/aristo.css">
    <link rel="stylesheet" type="text/css" href="../static/css/font-awesome.css">
    <!--<link rel="stylesheet" type="text/css" href="../static/css/swfupload/default.css">-->

    <style type="text/css" title="currentStyle">
        @import "../static/css/datatables/demo_table_jui.css";
    </style> 

    <script src="../static/js/jquery-1.9.1.js"></script>

    <script src="../static/js/lib/underscore-min.js"></script>
    <script src="../static/js/lib/backbone.js"></script>
    <script src="../static/js/lib/jquery.dataTables.min.js"></script>
    <script src="../static/js/lib/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="../static/js/lib/moment.min.js"></script>
    <script src="../static/js/lib/refresh_dt.js"></script>
    <script src="../static/js/lib/wcat.js"></script>
    <script src="../static/js/lib/datatable.delayQuery.js"></script>
    <script src="../static/js/lib/datatables.fnRedrawAjax.js"></script>

    <script src="../static/js/lib/fckedit/ckeditor.js"></script>
    <script src="../static/js/lib/fckedit/config.js"></script> 
    <script src="../static/js/lib/swfupload/swfupload.js"></script>
    <script src="../static/js/lib/swfupload/handlers.js"></script>
    
    <script>
        globalConfig = {};
        globalConfig.SESSIONID = '<?php echo session_id() ?>';
        globalConfig.categorias = <?php 
            $mysql = Mysql::getInstance();
            $mysql->connect();
            $categorias = new Categorias($mysql);
            $out = $categorias->listAll();
            echo json_encode($out);
            $mysql->close();
        ?>;

        
        $.extend($.ui.dialog.prototype.options, {
                closeOnEscape: false
        });
        
        $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
            var msg = "<strong>ERROR: </strong>"+ thrownError +"<br />";
            msg += "<strong>URL: </strong>"+ ajaxOptions.url +"<br />";
            msg += xhr.responseText;
            
            wcat.jConfirm(msg, function(){ window.location = "login.php" }, function(){ window.location = "login.php" } ,{title: "Error", width: 600, height: 400});
        });        
        

        $(document).ready(function() {
            window.noticias = new Noticias();
            wcat.init();
            Backbone.emulateHTTP = true;
            Backbone.emulateJSON = true;
        });
        
    </script>

</head>

<body>
        <div class="headerContainer" style="background-color: #00a178; height: 10px; margin-top: 0"></div>
        <div id="headerContainer" class="headerContainer">
            <div id="header" class="header">
                <div class="headerLogo">
                    <img src="../static/images/template/logo.png" />
                </div>
                <div class="headerMenu" style="float: right; line-height: 27px;">
                    <a href="#" id="salir" style="color: white; text-decoration: none; font-size: 14px;"
                    onClick="location.href='http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/logout.php'">Cerrar sesi&oacute;n</a>
                </div>
            </div>
        </div>
        <div id="waitingPopup">Procesando...</div>   
        
