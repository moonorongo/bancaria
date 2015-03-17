<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php"); 
    $mysql = Mysql::getInstance();
    $mysql->connect();
    $codigo = $_REQUEST["codigo"];
    $noticias = new Noticias($mysql);
    $imagenes = new Imagenes($mysql);
    $categorias = new Categorias($mysql);
    $noticiasService = new NoticiasService($noticias, $imagenes, $categorias);    
    $model = $noticiasService->get($codigo, true); // true incrementa leida
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
                    <?php if(count($model["listaImagenes"]) >= 1) { ?>
                        <div class="postImageContainer">
                            <img class="postImage" src="static/images/fotos/<?= $model["listaImagenes"][0]["archivo"] ?>" class="" alt="<?= $row["listaImagenes"][0]["archivo"] ?>">
                        </div>
                    <?php } ?>                    
                    <div class="postContent">
                        <h1 class="postTitle"><?= $model['titulo'] ?></h1>
                        <h2 class="postCategoria">Publicado el <?= ViewHelper::swapDateFormat($model["fecha"]) ?> en: 
                        <?php foreach($model['listaCategorias'] AS  $i => $categoria) { ?>
                            <?= ($i != 0)? ", " : "" ?>
                            <?= $categoria["descripcion"] ?>
                        <?php } ?>
                        </h2>
                        <hr class="destacadoPostSeparador">
                        <?= $model['descripcion'] ?>
                        
                        
                        <?php foreach($model["listaImagenes"] as $i => $archivo) { 
                            if($i != 0) { ?>
                            <div class="postImageFillContainer">
                                <a href="static/images/fotos/<?= $archivo["archivo"] ?>" data-lightbox="gallery">
                                    <img name="image<?= $i ?>" class="postImageFill" src="static/images/fotos/<?= $archivo["archivo"] ?>">
                                    <label class="clickParaAmpliar">click para ampliar</label>
                                </a>
                            </div>
                        <?php } } ?>
                        
                        <div style="text-align: center; height: 35px; margin-top: 30px">
                        <a href="javascript:history.back();" class="destacadoPostButton destacadoPostButtonVerMas">Volver</a> 
                        </div>
                        
                        <div>
                            <div class="floatLeft" style="width: 202px">
                                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>                    
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </div> <!-- mainContent -->
        </div> <!-- content -->
        
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer.php"); ?>
<?php $mysql->close(); ?>