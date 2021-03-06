<?php 
    $noticias = new Noticias($mysql);
    $imagenes = new Imagenes($mysql);
    $categorias = new Categorias($mysql);
    $noticiasService = new NoticiasService($noticias, $imagenes, $categorias);
    $listaNovedades = $noticiasService->listMasLeidas();
?>
                <h3 class="sidebarDestacados"><span>Mas leido</span></h3>
                <div class="paddingContainer">
                    <ul class="sidebarListaNovedades">

                    <?php foreach($listaNovedades as $row) { ?>                                                
                        <li class="sidebarNovedad">
                            <a href="noticia.php?codigo=<?= $row['codigo'] ?>">
                                <?php if(count($row["listaImagenes"]) >= 1) { ?>
                                    <p class="sidebarMiniaturaNovedad">
                                        <img class="sidebarMiniaturaNovedad" src="static/images/fotos/<?= $row["listaImagenes"][0]["archivo"] ?>" class="" alt="<?= $row["listaImagenes"][0]["archivo"] ?>">
                                    </p>
                                <?php } else { ?>
                                    <p class="sidebarMiniaturaNovedad">
                                        <img class="sidebarMiniaturaNovedad" src="static/images/template/sin_imagen.png">
                                    </p>                
                                <?php } ?>
                                <h4 class="sidebarNovedadTitle"><?= $row['titulo'] ?></h4>
                                <p class="sidebarNovedadResumen">
                                    <?= ViewHelper::subString(strip_tags($row['descripcion']), 100) ?>...
                                </p>
                            </a>
                        </li>
                    <?php } // foreach ?>                                
                    </ul>                    
                </div>
