<style>
    #contacto label {
        display: block;
        width: 90px;
        float: left;
        line-height: 22px;
    }
    
    #contacto input {
        display: block;
        width: 462px;
        margin-bottom: 10px;
    }
    
    #contacto textarea {
        display: block;
        width: 462px;
        height: 200px;
        margin-bottom: 20px;
    }
</style>



<div class="postContent">
<form id="contacto" action="pagina.php?id=send_mail" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" />

    <label>Email:</label>
    <input type="text" name="email" />

    <label>Mensaje:</label>
    <textarea name="mensaje"></textarea>
    
    
    <div style="text-align: center">
        <input type="submit" id="send" value="Enviar consulta" style="width: 100px; display: inline" />
    </div>
</form>
</div>


