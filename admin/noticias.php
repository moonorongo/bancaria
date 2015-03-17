<?php
/*
    noticias Controller
*/    
    session_start();
    if(!isset($_SESSION['LOGGED'])) { // si no esta logueado
        header('HTTP/1.0 401 Unauthorized');
        echo ('NO AUTORIZADO: click <a href="http://'. $_SERVER['SERVER_NAME'] .'/admin">aqui</a> para entrar');
    } else { // si esta logueado
        require_once($_SERVER["DOCUMENT_ROOT"] ."/script/inc/config.php");
        header('Content-Type: application/json');
    

        $mysql = Mysql::getInstance();
        $mysql->connect();

        $action = (isset($_REQUEST["action"])) ? $_REQUEST["action"] : null;
        $_method = (isset($_REQUEST["_method"]))? $_REQUEST["_method"] : null;
        $model = (isset($_REQUEST["model"]))? $_REQUEST["model"] : null;
	$model = str_replace('\"', '"', $model);        
	
        $codigo = (isset($_REQUEST["codigo"]))? $_REQUEST["codigo"] : null;

        $noticias = new Noticias($mysql);
        $imagenes = new Imagenes($mysql);
        $categorias = new Categorias($mysql);
        $noticiasService = new NoticiasService($noticias, $imagenes, $categorias);  // imagenes, categorias
        
        // dataTables Handler
        if(isset($_REQUEST["sEcho"])) {
            $codigoCategoria = (isset($_REQUEST["codigoCategoria"]))? $_REQUEST["codigoCategoria"] : null;
            $out = $noticiasService->getPagedSorted($_REQUEST["sSearch"],
                                        $_REQUEST["iSortCol_0"],
                                        $_REQUEST["sSortDir_0"],
                                        $_REQUEST["iDisplayStart"],
                                        $_REQUEST["iDisplayLength"],
                                        $_REQUEST["sEcho"], 
                                        true,
                                        $codigoCategoria);
            
            echo json_encode($out);
        }


        

    // clientesModelCRUD
    if ($action=="noticiasModelCRUD") {
        // CRUD Handler - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
        // fetch (GET) * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  
        if ( ($_method == null) && ($model == null) && ($codigo != null) ) {    
            $out = $noticiasService->get($codigo, false);
            echo json_encode($out);
        }
        
        
        // destroy (DELETE) * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        if ( (($_method != null) && ($_method=="DELETE")) && ($model == null) && ($codigo != null) ) {
            $clientes->delete($codigo);
            echo('{"success" : true}');
        }
        
        
        // save (CREATE) * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        if ( ($_method == null) && ($model != null) && ($codigo == null) ) {

            $modelData = json_decode($model, true);
            $codigo = $noticiasService->create($modelData);
            $modelData['codigo'] = $codigo;
            echo(json_encode($modelData)); 
        }
        
        
        // save(PUT) * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        if ( ($_method != null) && (($_method=="PUT")) && ($model != null) && ($codigo != null) ) {
            // "{"titulo":"test","descripcion":"<p>El otro d&iacute;a coment&aacute;bamos <a target="_blank" href="http://danielmarin.naukas.com/2013/12/16/los-proximos-planes-de-china-en-el-espacio-traer-rocas-lunares-y-la-exploracion-de-marte/">los planes de China</a>  para explo</p>","fecha":"2014-01-28","publicado":"1","cantidadLecturas":0,"activo":1,"listaCategorias":[],"listaImagenes":[],"codigo":"13"}"
            //$model = str_replace('"', '\"', $model);
            $modelData = json_decode($model, true);
            $modelData["descripcion"] = str_replace("'", '"', $modelData["descripcion"]);
            $noticiasService->update($modelData);
            echo('{"success" : true}');
        }   
         
    
    }
    
/*        
    if ($action=="getClientes") {
        echo json_encode($clientes->listByNombre($_REQUEST["term"]));
    }

    if ($action=="getAllClientes") {
        echo json_encode($clientes->listByNombre());
    }    
*/

    $mysql->close();    
    } // if logged    
?>