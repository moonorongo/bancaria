<?php 

    class NoticiasService {
    
        private $noticias = null;
        private $imagenes = null;
        private $categorias = null;

        function __construct($noticias, $imagenes, $categorias) {
            $this->noticias = $noticias;
            $this->imagenes = $imagenes;
            $this->categorias = $categorias;
        }
    
        
        
        public function listByCodigoCategoria($codigoCategoria, $cantidad = 4, $pagina = 0) {
            $out = Array();
            $lista = $this->noticias->listByCodigoCategoria($codigoCategoria, $cantidad, $pagina); 
            foreach($lista as $noticia) {
                $noticia["listaImagenes"] = $this->imagenes->listAllByCodigoNoticia($noticia["codigo"]);
                $noticia["listaCategorias"] = $this->categorias->listAllByCodigoNoticia($noticia["codigo"]);
                $out[] = $noticia;
            }
            return $out;
        }


        
        
        
        
        public function listMasLeidas($cantidad = 3) {
            $out = Array();
            $lista = $this->noticias->listMasLeidas($cantidad); 
            foreach($lista as $noticia) {
                $noticia["listaImagenes"] = $this->imagenes->listAllByCodigoNoticia($noticia["codigo"]);
                $noticia["listaCategorias"] = $this->categorias->listAllByCodigoNoticia($noticia["codigo"]);
                $out[] = $noticia;
            }
            return $out;
        }
        


        
        public function listByTerm($term) {
            $out = Array();
            $lista = $this->noticias->listByTerm($term); 
            foreach($lista as $noticia) {
                $noticia["listaCategorias"] = $this->categorias->listAllByCodigoNoticia($noticia["codigo"]);
                $out[] = $noticia;
            }
            return $out;
        }
        
        

        
        public function get($codigo, $registrarLectura) {
            $model = $this->noticias->get($codigo, $registrarLectura);
            $model["listaImagenes"] = $this->imagenes->listAllByCodigoNoticia($codigo);
            $model["listaCategorias"] = $this->categorias->listAllByCodigoNoticia($codigo);
            return $model;
        }

        
        
  
  
        public function getPagedSorted($sSearch, $fieldOrder, $dirOrder, $start, $length, $sEcho, $soloActivos, $codigoCategoria) {
    
            $sEcho++;
            $lista = $this->noticias->getPagedSorted($sSearch, $fieldOrder, $dirOrder, $start, $length, $soloActivos, $codigoCategoria);
            
            $out = Array();
            $out["iTotalRecords"] = $this->noticias->count();
            $out["iTotalDisplayRecords"] = $out["iTotalRecords"];
            $out["sEcho"] = $sEcho;
            $out["aaData"] = Array();
            
            foreach($lista as $row) {
                $newRow = Array(
                    "DT_RowId" => $row["codigo"],
                    "0" => $row["titulo"],
                    "1" => $row["publicado"],
                );
                $out["aaData"][] = $newRow;
            }
            
            return $out;
        }
        
        
        
        public function update($model) {
            $this->noticias->update($model);
            // elimino todas las categorias de esta noticia
            $this->categorias->deleteByCodigoNoticia($model["codigo"]);
            
            // inserto las categorias
            foreach($model["listaCategorias"] as $key=>$categoria) {
                $this->categorias->insertCategoria($categoria["codigo"], $model["codigo"]);
            }
            
            // elimino todas las imagenes de esta noticia
            $this->imagenes->deleteByCodigoNoticia($model["codigo"]);
            
            // inserto las imagenes
            foreach($model["listaImagenes"] as $key=>$imagen) {
                $imagen["codigoNoticia"] = $model["codigo"];
                $this->imagenes->create($imagen);
            }
            
        }
  
  

        public function create($model) {
            $codigo = $this->noticias->create($model);
            $model["codigo"] = $codigo;
            // elimino todas las categorias de esta noticia
            // $this->categorias->deleteByCodigoNoticia($model["codigo"]);
            
            // inserto las categorias
            foreach($model["listaCategorias"] as $key=>$categoria) {
                $this->categorias->insertCategoria($categoria["codigo"], $model["codigo"]);
            }
            
            // elimino todas las imagenes de esta noticia
            // $this->imagenes->deleteByCodigoNoticia($model["codigo"]);
            
            // inserto las imagenes
            foreach($model["listaImagenes"] as $key=>$imagen) {
                $imagen["codigoNoticia"] = $model["codigo"];
                $this->imagenes->create($imagen);
            }
            
            return $model["codigo"];
        }
        
        
    
    } // END CLASS
?>