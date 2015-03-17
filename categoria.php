<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php"); 
    $mysql = Mysql::getInstance();
    $mysql->connect();
    $codigo = $_REQUEST["codigo"];
    $pagina = (isset($_REQUEST["pagina"]))? $_REQUEST["pagina"]:0;
    $noticias = new Noticias($mysql);
    $imagenes = new Imagenes($mysql);
    $categorias = new Categorias($mysql);
    $listaCategorias = $categorias->listAll();
    $noticiasService = new NoticiasService($noticias, $imagenes, $categorias);    
    $lista = $noticiasService->listByCodigoCategoria($codigo, $__NOTICIAS_POR_PAGINA__, $pagina);
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
                    <h3 class="sidebarDestacados"><span><?= $listaCategorias[$codigo - 1]["descripcion"]?></span></h3>
                    <?php if (count($lista) != 0) { ?>
                    <ul class="categoriaLista">
                    <?php foreach($lista as $row) { ?>                        
                        <li class="categoria">
                            <a href="noticia.php?codigo=<?= $row['codigo'] ?>">
                                <p class="categoriaMiniatura">
                                    <?php if(count($row["listaImagenes"]) >= 1) { ?>
                                        <img class="categoriaMiniatura" src="static/images/fotos/<?= $row["listaImagenes"][0]["archivo"] ?>" class="" alt="<?= $row["listaImagenes"][0]["archivo"] ?>">
                                    <?php } else { ?>
                                        <img class="categoriaMiniatura" src="static/images/template/sin_imagen.png">
                                    <?php } ?>
                                </p>
                                <h4 class="categoriaTitle"><?= $row['titulo'] ?></h4>
                                <h3 class="categoriaTitle"><?= ViewHelper::swapDateFormat($row['fecha']) ?></h3>
                                <p class="categoriaResumen">
                                    <?= ViewHelper::subString(strip_tags($row['descripcion']), 150) ?>... &nbsp;&nbsp;&nbsp;
                                    <em>ver más</em>
                                </p>
                            </a>
                        </li>
                    <?php } // foreach ?>                
                    </ul>
                    <?php } else { // no se encontraron registros ?>
                    <!-- llamar a un template desde aqui -->
                    <br /><br />
                    <h1 style="text-align: center">No se encontraron mas noticias en esta categoría</h1>
                    <br /><br />
                    <?php } // if count ?>                

                    <div class="clear"></div>                       
                    <div class="pager" style="margin: 10px 0; height: 40px">
                        <div class="floatLeft" style="width: 208px; padding: 0 10px;">
                        <?php if($pagina != 0) { $paginaAnterior = $pagina - 1; ?>
                            <a class="pageButton" href="http://<?= $_SERVER["SERVER_NAME"] ?>/categoria.php?codigo=<?= $codigo ?>&pagina=<?= $paginaAnterior ?>">Noticias más nuevas</a>
                        <?php } else { ?>&nbsp; <?php } ?>
                        </div>
                        
                        <div class="floatLeft" style="width: 200px;">&nbsp;</div>                        
                        
                        <div class="floatLeft" style="text-align: right; padding: 0 10px;">
                        <?php if(count($lista) != 0) { $paginaSiguiente = $pagina + 1; ?>
                            <a class="pageButton" href="http://<?= $_SERVER["SERVER_NAME"] ?>/categoria.php?codigo=<?= $codigo ?>&pagina=<?= $paginaSiguiente ?>">Noticias pasadas</a>
                        <?php } else { ?>&nbsp; <?php } ?>
                        </div>
                    </div>
                </div>
            </div> <!-- mainContent -->
        </div> <!-- content -->
        
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer.php"); ?>
<?php $mysql->close(); ?>