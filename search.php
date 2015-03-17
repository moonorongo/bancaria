<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php"); 
    $mysql = Mysql::getInstance();
    $mysql->connect();
    $term = $_REQUEST["term"];
    $noticias = new Noticias($mysql);
//    $imagenes = new Imagenes($mysql);
    $categorias = new Categorias($mysql);
    $listaCategorias = $categorias->listAll();
    $noticiasService = new NoticiasService($noticias, null, $categorias);    
    $lista = $noticiasService->listByTerm($term);
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
                    <h3 class="sidebarDestacados"><span>Resultados de la busqueda &quot;<?= $term ?>&quot;</span></h3>
                    <?php if (count($lista) != 0) { ?>
                    <ul class="categoriaLista">
                    <?php foreach($lista as $row) { ?>                        
                        <li class="categoria" style="padding-left: 10px;">
                            <a href="noticia.php?codigo=<?= $row['codigo'] ?>">
                                <h4 class="categoriaTitle" style="width: 510px;"><?= str_ireplace($term, '<span class="selected">'. $term .'</span>', $row['titulo']) ?></h4>
                                <h3 class="categoriaTitle"><?= ViewHelper::swapDateFormat($row['fecha']) ?></h3>
                                <p class="categoriaResumen" style="width: 575px;">
                                    <? 
                                        $sTemp = strip_tags($row['descripcion']);
                                        $iPos = stripos($sTemp, $term );
                                        if($iPos != 0 && $iPos > 75) {
                                            $sTemp = substr($sTemp, $iPos - 75, 150);
                                            $sTemp = "... ". str_ireplace($term, '<span class="selected">'. $term .'</span>', $sTemp) ;
                                        } else {
                                            $sTemp = "... ". str_ireplace($term, '<span class="selected">'. $term .'</span>', $sTemp) ;
                                            $sTemp = ViewHelper::subString($sTemp, 150);
                                        }
                                        echo $sTemp;
                                    ?>
                                    ... &nbsp;&nbsp;&nbsp;<em>ver más</em>
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
                    
                </div>
            </div> <!-- mainContent -->
        </div> <!-- content -->
        
    <?php require_once($_SERVER["DOCUMENT_ROOT"] ."/script/template/footer.php"); ?>
<?php $mysql->close(); ?>