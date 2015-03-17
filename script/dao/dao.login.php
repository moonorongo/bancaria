<?php
    class Login {
        
        private $mysql = null;
        
        function __construct($mysql) {
            $this->mysql = $mysql;
        }
        
        function check($user, $password) {
            $stmt = $this->mysql->getStmt("SELECT count(u.codigo) AS logged
                                            FROM usuarios u
                                            WHERE u.nombre = ? AND u.clave = ?");
            
            $stmt->bind_param("ss",$user, $password);
            $stmt->execute();
            
            $stmt->bind_result($logged);

            $stmt->fetch();
            $out = array( "LOGGED" => $logged );
            
            $stmt->close();            
            return $out;            
        }
        
    }
?>
