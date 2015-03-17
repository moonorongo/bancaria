<?php
    class Noticias {
        
        private $mysql = null;
        private $table = "noticias";
        private $columns = Array("titulo");
        
        function __construct($mysql) {
            $this->mysql = $mysql;
        }
        
        
        private function getNewId() {
            $result = $this->mysql->query("SELECT codigo FROM $this->table ORDER BY codigo desc limit 1");
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $out = $row["codigo"] + 1;
                }
            } else {
                $out = 1;
            }
            return $out;
        }
        
        
// -------------------------------- CRUD -------------------------------- 

        public function create($modelData) {
        
            $newId = $this->getNewId();
            $sql = "INSERT INTO $this->table (codigo) VALUES ($newId)"; 
            $result = $this->mysql->query($sql);
            $modelData["codigo"] = $newId;
            $this->update($modelData);
            return $modelData["codigo"];
        }

        
        
        public function update($modelData) {
            
            $sql = "UPDATE $this->table SET ". 
                   " titulo = ? , ".
                   " descripcion = ? , ".
                   " fecha = ? , ".
                   " publicado = ? , ".
                   " activo = ? ".
                   " WHERE codigo = ? ";
            
            $stmt = $this->mysql->getStmt($sql);
            $stmt -> bind_param("sssiii", 
                    $modelData['titulo'],
                    $modelData['descripcion'],
                    $modelData['fecha'],
                    $modelData['publicado'],
                    $modelData['activo'],
                    $modelData['codigo']);
            
            $stmt -> execute();
        }


        
        
        public function delete($codigo) {
            $stmt = $this->mysql->getStmt("UPDATE $this->table SET activo = 0 WHERE codigo =  ?");
            $stmt -> bind_param("i", $codigo);
            $stmt -> execute();
        }
        

        
        
        
        public function get($codigo, $registrarLectura = false) {

            $stmt = $this->mysql->getStmt("SELECT n.titulo, n.descripcion, n.fecha, n.publicado, n.activo, n.cantidadLecturas 
                FROM $this->table n WHERE codigo = ?");
            $stmt->bind_param("i",$codigo);
            $stmt->execute();
            
            $stmt->bind_result($titulo, $descripcion, $fecha, $publicado, $activo, $cantidadLecturas);

            $stmt->fetch();
            $out = array("codigo" => $codigo,
                           "titulo" => $titulo,
                           "descripcion" => $descripcion,
                           "fecha" => $fecha,
                           "publicado" => $publicado, 
                           "cantidadLecturas" => $cantidadLecturas, 
                           "activo" => $activo);
            $stmt->close();            
            
            if($registrarLectura) {
                $cantidadLecturas++;
                $this->mysql->query("UPDATE $this->table SET cantidadLecturas = $cantidadLecturas WHERE codigo = $codigo");
            }
            
            return $out;
        }
        
        
        
        
        
// -------------------------------- EXTRAS --------------------------------         
        
        public function listAll($cantidad = -1) {
            $condicionLimit = ($cantidad != -1)? "LIMIT $cantidad" : "";
            $out = Array();
            $result = $this->mysql->query("SELECT * FROM $this->table WHERE publicado = 1 $condicionLimit ");
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        


        public function listByCodigoCategoria($codigoCategoria, $cantidad = -1, $pagina = -1) {
            $offset = $pagina * $cantidad;
                
            if($cantidad != -1) {
                if($pagina != -1) {
                    $condicionLimit = " LIMIT $offset, $cantidad ";
                } else {
                    $condicionLimit = " LIMIT $cantidad ";
                }
            } else {
                $condicionLimit = "";
            }
        
            $out = Array();
            $sql = "SELECT n.* FROM $this->table n
                INNER JOIN noticiascategorias nc ON nc.codigoNoticia = n.codigo 
                WHERE publicado = 1 
                AND nc.codigoCategoria = $codigoCategoria ORDER BY n.fecha DESC 
                $condicionLimit ";
            $result = $this->mysql->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        
        

        
        
        // lista las mas leidas, en los ultimos 30 dias
        public function listMasLeidas($cantidad) {
            $out = Array();
            $sql = "SELECT * FROM noticias WHERE  fecha > DATE_ADD(CURRENT_DATE, INTERVAL -30 DAY) AND publicado = 1 
                ORDER BY cantidadLecturas DESC LIMIT $cantidad";
            $result = $this->mysql->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        

        
        // lista por termino de busqueda
        public function listByTerm($term) {
            $out = Array();
            $sql = "SELECT * FROM noticias WHERE publicado = 1 AND 
                (titulo LIKE '%$term%' OR descripcion LIKE '%$term%')
                ORDER BY fecha DESC";
            $result = $this->mysql->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        
        
        
        
        
        
        public function getPagedSorted($sSearch, $fieldOrder, $dirOrder, $start, $length, $soloActivos, $codigoCategoria) {
        
//            $sSearch = strtoupper($sSearch); // descomentar para habilitar busqueda
            $sSearch = "";
            
            // Armo query busqueda en base a configuracion columns
            $searchCondition = " ( ";
            foreach ($this->columns as $key => $value) {
                $or = ($key == 0)? " ":" OR ";
                $searchCondition .= $or ."(UPPER(". $value .") LIKE '%". $sSearch ."%') ";
            }
            $searchCondition .= " ) ";
            
            $aBuscar = (strlen($sSearch) == 0)? " (1 = 1) " : $searchCondition;
            $aBuscar .= ($soloActivos)? " AND activo = 1 ":"";
            $aBuscar .= ($codigoCategoria != -1)? " AND nc.codigoCategoria = $codigoCategoria ":"";
        
            $out = Array();

            $sql =  "SELECT n.* FROM ". $this->table ." n "
                    ." LEFT JOIN noticiascategorias nc ON nc.codigoNoticia = n.codigo "
                    ." WHERE ". $aBuscar 
                    ." GROUP BY n.codigo ORDER BY ". $this->columns[$fieldOrder] ." ". $dirOrder ." LIMIT ". $start .','. $length;
                    
            $result = $this->mysql->query($sql);


            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        
        
        
        
        
        public function count() {
            $result = $this->mysql->query("SELECT count(codigo) as total from ". $this->table );
            
            while ($row = $result->fetch_assoc()) {
                $out = $row["total"];
            }
            return $out;
        }
        
        
        
        
        
        
    } // END CLASS
?>