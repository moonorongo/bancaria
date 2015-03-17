<?php 
    $noticias = new Noticias($mysql);
    $imagenes = new Imagenes($mysql);
    $categorias = new Categorias($mysql);
    $noticiasService = new NoticiasService($noticias, $imagenes, $categorias);
    $listaDestacados = $noticiasService->listByCodigoCategoria(7);
?>


    <?php foreach($listaDestacados as $row) { ?>
        <div class="destacadoPostBrief">
            <div class="destacadoPostImageContainer">
                <?php if(count($row["listaImagenes"]) >= 1) { ?>
                    <img class="destacadoPostImage" src="static/images/fotos/<?= $row["listaImagenes"][0]["archivo"] ?>" class="" alt="<?= $row["listaImagenes"][0]["archivo"] ?>">
                <?php } else { ?>
                    <img class="destacadoPostImage" src="static/images/template/sin_imagen.png">
                <?php } ?>
            </div>
            <div class="destacadoPostContent">
                <h1 class="destacadoPostTitle"><?= $row['titulo'] ?></h1>
                <h2 class="destacadoPostCategoria">
                <?php foreach($row['listaCategorias'] AS  $i => $categoria) { ?>
                    <?= ($i != 0)? ", " : "" ?>
                    <?= $categoria["descripcion"] ?>
                <?php } ?>
                </h2>
             
                <hr class="destacadoPostSeparador" />
                <div class="destacadoPostText">
                    <?= $row['descripcion'] ?>
                </div>
            </div>
            
            <div style="text-align: center; height: 35px;">
                <a href="noticia.php?codigo=<?= $row['codigo'] ?>" class="destacadoPostButton destacadoPostButtonVerMas">ver más</a> 
            </div>
            
            <div class="destacadoPostBottom">
                <div class="floatLeft" style="width: 202px">
                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>                    
                </div>
            </div>
        </div>
    <?php } // foreach ?>                
    <script>
        $('.destacadoPostContent').each(function(i,e){
            var jObj = $('h1.destacadoPostTitle', e);

            var cantChars = 340;
            if(jObj.height() >= 23) cantChars = 293;
            if(jObj.height() > 46) cantChars = 200;
            if(jObj.height() > 69) cantChars = 152;
            
            var jText = $('div.destacadoPostText', e);
            var sTemp = jText.html().trim().replace(/(<([^>]+)>)/ig,"");
            sTemp = wcat.subString(sTemp,cantChars);
            jText.html(sTemp + "...");
            
        });
    </script>
    <div class="clear"></div>   
