<?php
class ViewHelper {
    
    public static function subString($in, $cantCaracteres = 190) {
        $in = substr($in, 0, $cantCaracteres);
        $lastWhitespacePosition = strrpos($in, ' ');
        $in = substr($in, 0, $lastWhitespacePosition);
        return $in;
    }

    
    public static function swapDateFormat($fecha) {
        $aFecha = explode("-", $fecha);
        if (count($aFecha) != 0) {
            return $aFecha[2] ."/". $aFecha[1] ."/". $aFecha[0];
        } else {
            $aFecha = explode("/", $fecha);
            return $aFecha[2] ."-". $aFecha[1] ."-". $aFecha[0];
        }
    }



    public static function mes($mes) {
        $m = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return $m[$mes];
    }
    
    
    
} // END CLASS
?>
