<?php 
    session_start();
    
    if(!isset($_SESSION['LOGGED'])) {
        header('Location: http://'. $_SERVER['SERVER_NAME'] .'/admin/'); 
    } else {
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php");
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/header_admin.php");
?>


<div id="content" class="content">

    <div class="dataTableWrapper" id="listaNoticias">
        <div class="headerMenu" style="width: 100%">
            <button id="nuevaNoticia">Nueva Noticia</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Mostrar categoria: 
            <select id="codigoCategoriaLista">
                <option value="-1">Todas</option>
                <option value="1">Notas</option>            
                <option value="2">Gremiales</option>            
                <option value="3">Accion Social</option>            
                <option value="4">Cultura</option>            
                <option value="5">Salud</option>            
                <option value="6">Novedades</option>            
                <option value="7">Principal</option>            
                <option value="8">Deportivas</option>            
            </select>
        </div>
        
        <table class="display dataTable" id="datatable" style="width: 100%">
            <thead>
                <tr>
                    <th style="text-align: left; width: 80%">Titulo de la noticia</th>
                    <th style="text-align: left; width: 20%">Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div><!-- dataTableWrapper -->

    <div id="noticiasModificarContainer" class="noticiasModificarContainer"></div>
    
</div> <!-- content -->


<script type="text/template" id="noticiasModificarTemplate">
    <div class="noticiasModificarMenu">
        <div class="floatLeft" style="width: 100px">
            <button id="anterior" style="display: none">&lt;&lt;</button>
            &nbsp;
        </div>
        <div class="floatLeft" style="width: 730px; text-align: center">
            <a href="#" class="cancelar" style="color: #0087c7; text-decoration: none; font-size: 14px;">Volver</a>
        </div>
        <div class="floatLeft" style="width: 100px; text-align: right;">
            &nbsp;
            <button id="siguiente">&gt;&gt;</button>
        </div>        
    </div>
    <div class="clear"></div>
    
    <div id="noticiasModificarPanelContainer" class="noticiasModificarPanelContainer">
        <div class="noticiasModificarPanel">
            <h1>Titulo y Contenidos</h1>
            <div id="editorContainer" style="margin-left: 75px;">
                <label>T&iacute;tulo de la noticia </label>
                <input type="text" id="titulo" value="<@= titulo @>" style="width: 743px; font-size: 18px;" />
                <br />
                <br />
                <textarea id="descripcion" style="width: 885px; height: 450px;"><@= descripcion @></textarea>
            </div>
        </div>
        
        <div class="noticiasModificarPanel">
            <h1>Seccion Principal</h1>
            <@ _.each(globalConfig.categorias, function(c){ @> 
                <@ if(c.interna === "1") { @>
                <@ var checked = _.where(listaCategorias, { descripcion : c.descripcion }); @>
                <label class="categoriaContainer">
                    <input type="checkbox" class="categoria" id="<@= c.codigo @>" <@= (checked.length != 0)? "checked":"" @> /> <@= c.descripcion @> <br />
                </label>
                <@ } // if @>
            <@ }) @>
            <div class="clear"></div>
            <h1 style="margin-top: 30px;">Otras Categorias</h1>
            <@ _.each(globalConfig.categorias, function(c){ @> 
                <@ if(c.interna === "0") { @>            
                <@ var checked = _.where(listaCategorias, { descripcion : c.descripcion }); @>
                <label class="categoriaContainer">
                    <input type="checkbox" class="categoria" id="<@= c.codigo @>" <@= (checked.length != 0)? "checked":"" @> /> <@= c.descripcion @> <br />
                </label>
                <@ } // if @>
            <@ }) @>
        </div>

        <div class="noticiasModificarPanel">
            <h1 style="float: left; margin-right: 10px;">Subir im&aacute;genes: </h1>
            <form style="margin-top: 6px;">
                <div style="display: inline; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">
                    <span id="spanButtonPlaceholder"></span>
                </div>
            </form>
            <div class="clear"></div>            
            
            <div id="divFileProgressContainer" style="height: 45px; margin-top: 10px;"></div>
            <div class="clear"></div>
    
            <h1 style="margin-top: 15px;">Imagenes seleccionadas</h1>            
            <ul id="listaImagenes" class="listaImagenes">
            <@ _.each(listaImagenes, function(c){ @> 
                <li class="thumbContainer">
                    <span class="closeButton" id="img<@= c.codigo @>">x</span><br />
                    <img src="../static/images/fotos/<@= c.archivo @>" class="imageThumb" />
                </li>
            <@ }) @>
            </ul>            
        </div>

        
        <div class="noticiasModificarPanel">
            <h1 style="float: left; margin-right: 10px;">Informaci&oacute;n extra: </h1>
            <br /><br /><br />
            <label>Fecha publicaci&oacute;n </label>
            <input type="text" id="fecha" value="<@= wcat.swapDateFormat(fecha) @>" style="width: 100px; font-size: 18px;" />
            <br /><br />
            <label>Publicado </label>
            <input type="checkbox" id="publicado" <@= (publicado == 1)? "checked":"" @> />
            
            <br /><br />
            <div style="text-align: center">
                <button id="aceptar" style="padding: 15px;font-size: 20px;">Aceptar y guardar los cambios</button>
                o <a href="#" class="cancelar" style="color: #0087c7; text-decoration: none; font-size: 14px;">Cancelar</a>            
            </div>
        </div>
        
    </div>

</script>

    
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer_admin.php"); ?>
<?php } ?>

