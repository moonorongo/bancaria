<?php 
    session_start();
    
    if(isset($_SESSION['LOGGED'])) {
        header('Location: http://'. $_SERVER['SERVER_NAME'] .'/admin/default.php'); 
    } 
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>La Bancaria - Bahía Blanca - Panel de administracion</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="keywords" content="">  
    <meta name="description" content="">

    <link rel="stylesheet" type="text/css" href="../static/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../static/css/main.css">
    <link rel="stylesheet" type="text/css" href="../static/css/megadrop.css">
    
    <script src="../static/js/jquery-1.9.1.js"></script>
    <!--<script src="js/megadrop_scripts.js"></script>-->

    <script>
        function send() {
            window.loginForm.submit();
        }
        
        $(document).ready(function(){
            $("input[name='user']").focus()
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
                <div class="headerMenu" style="text-align: right; margin-top: 5px; color: white; float: right;">
                    <form name="loginForm" action="login.php" method="POST" style="margin-top: 12px;">
                    <label for="nombre">Usuario </label>
                    <input type="text" name="user" />
                    <label for="clave" style="margin-left: 30px;">Clave </label>
                    <input type="password" name="pass" />
                    <button onClick="send()" style="margin-left: 30px;">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        
        
        <div id="content" class="content">
        
        </div> <!-- content -->
        


</body>
</html>
