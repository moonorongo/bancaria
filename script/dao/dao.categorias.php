<?php
    class Categorias {
        
        private $mysql = null;
        private $table = "categorias";
        
        function __construct($mysql) {
            $this->mysql = $mysql;
        }
        
/*        
        private function getNewId() {
            $result = $this->mysql->query("SELECT codigo FROM $table ORDER BY codigo desc limit 1");
            if($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $out = $row["codigo"] + 1;
                }
            } else {
                $out = 1;
            }
            return $out;
        }
*/        

        
        public function deleteByCodigoNoticia($codigo) {
            $stmt = $this->mysql->getStmt("DELETE FROM noticiascategorias WHERE codigoNoticia = ?");
            $stmt -> bind_param("i", $codigo);
            $stmt -> execute();
        }
        

        

        public function insertCategoria($codigoCategoria, $codigoNoticia) {
            $sql = "INSERT INTO noticiascategorias (codigoNoticia, codigoCategoria) VALUES ($codigoNoticia, $codigoCategoria)"; 
            $result = $this->mysql->query($sql);
        }

        
        
        
        
        
// -------------------------------- CRUD -------------------------------- 
/*


        public function update($modelData) {
            
            $sql = "UPDATE $this->table SET 
                        codigoNoticia = ? , 
                        archivo = ? , 
                        orden = ? 
                        WHERE codigo = ? ";
            
            $stmt = $this->mysql->getStmt($sql);
            $stmt -> bind_param("isii", 
                    $modelData['codigoNoticia'],
                    $modelData['archivo'],
                    $modelData['orden'],
                    $modelData['codigo']);
            
            $stmt -> execute();
        }

 *         
        
        public function delete($codigo) {
            $stmt = $this->mysql->getStmt("DELETE FROM $this->table WHERE codigo =  ?");
            $stmt -> bind_param("i", $codigo);
            $stmt -> execute();
        }
        

        
        
        
        public function get($codigo) {

            $stmt = $this->mysql->getStmt("SELECT i.codigoNoticia, i.archivo, i.orden 
                FROM $this->table i WHERE codigo = ?");
            $stmt->bind_param("i",$codigo);
            $stmt->execute();
            
            $stmt->bind_result($codigoNoticia, $archivo, $orden);

            $stmt->fetch();
            $out = array("codigo" => $codigo,
                           "codigoNoticia" => $codigoNoticia,
                           "archivo" => $archivo,
                           "orden" => $orden);
            $stmt->close();            
            return $out;
        }
        
        
        
  */      
        
// -------------------------------- EXTRAS --------------------------------         
        
        public function listAll() {
            $out = Array();
            $result = $this->mysql->query("SELECT * FROM $this->table");
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        

    
    
        
        public function listAllByCodigoNoticia($codigoNoticia) {
            $out = Array();
            $result = $this->mysql->query(
                "SELECT c.codigo, c.descripcion FROM noticiascategorias nc 
                 INNER JOIN categorias c ON nc.codigoCategoria = c.codigo 
                 WHERE nc.codigoNoticia = $codigoNoticia"
            );
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        
        

        
        
        
        
        
    } // END CLASS
?>