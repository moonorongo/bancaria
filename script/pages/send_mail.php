<?php 
    $msg = (isset($_REQUEST["mensaje"]))? $_REQUEST["mensaje"] : "";
    $nombre = (isset($_REQUEST["nombre"]))? $_REQUEST["nombre"] : "";
    $email = (isset($_REQUEST["email"]))? $_REQUEST["email"] : "";
    
    if( (strlen(trim($msg)) != 0) && (strlen(trim($nombre)) != 0) && (strlen(trim($email)) != 0) ) {

        $mensaje = "Enviado desde:". $email .'<br /><br />'. "\n";
        $mensaje .= "Comentario:". $msg;
        $subject = $nombre ." tiene una consulta desde la pagina web";

        $mail             = new PHPMailer();


        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                                // 1 = errors and messages
                                                // 2 = messages only
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
        $mail->Username   = "bancariabahiablanca@gmail.com";  // GMAIL username
        $mail->Password   = "bNC271ca!";            // GMAIL password

        
        $mail->SetFrom($email, "Consulta desde sitio web");

        $mail->Subject    = $subject;


        $mail->MsgHTML($mensaje);

        //$address = "mscifu@gmail.com";
        $address = "sbahiablanca@bancaria.org.ar";
        
        $mail->AddAddress($address, "Consulta sitio web");

        $enviado = $mail->Send();
        
        if($enviado) {
?>
        <div class="postContent">
        Mail enviado correctamente!
        </div>
<?php } else { ?>
        <div class="postContent">
        Ocurrio un error al enviar el mail!
        </div>
<?php } // if enviado 

} else { // FALTAN DATOS ?>
    <div class="postContent">
    <strong>ES OBLIGATORIO COMPLETAR TODOS LOS DATOS</strong>
    </div>
<?php } ?>


