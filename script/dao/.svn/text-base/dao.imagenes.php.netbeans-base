<?php
    class Imagenes {
        
        private $mysql = null;
        private $table = "imagenes";
        
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


        
        
        public function delete($codigo) {
            $stmt = $this->mysql->getStmt("DELETE FROM $this->table WHERE codigo =  ?");
            $stmt -> bind_param("i", $codigo);
            $stmt -> execute();
        }
        

        
        public function deleteByCodigoNoticia($codigo) {
            $stmt = $this->mysql->getStmt("DELETE FROM $this->table WHERE codigoNoticia =  ?");
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
            $result = $this->mysql->query("SELECT * FROM $this->table WHERE codigoNoticia = $codigoNoticia ORDER BY orden ASC");
            while ($row = $result->fetch_assoc()) {
                $out[] = $row;
            }
            return $out;
        }
        
        

        
        
        
        
        
    } // END CLASS
?>