<?php
namespace App\Imports;

class Validador {

    public function text_cfdrelacion($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@CFDIRELACION|{$array[$j][1]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_concepto($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@CONCEPTO|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|{$array[$j][4]}|{$array[$j][5]}|{$array[$j][6]}|{$array[$j][7]}|{$array[$j][8]}|{$array[$j][9]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $fecha_pago        = $this->formatear_fecha($array[$j][2]);
                    $fecha_inicio_pago = $this->formatear_fecha($array[$j][3]);
                    $fecha_final_pago  = $this->formatear_fecha($array[$j][4]);
                    $texto .= "@NOMINA|{$array[$j][1]}|{$fecha_pago}|{$fecha_inicio_pago}|{$fecha_final_pago}|{$array[$j][5]}|{$array[$j][6]}|{$array[$j][7]}|{$array[$j][8]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina_recptor_subcontratacion($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-RECEPTOR-SUBCONTRATACION|{$array[$j][1]}|{$array[$j][2]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina_percepcion($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-PERCEPCION|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|{$array[$j][4]}|{$array[$j][5]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina_percepcion_horaextras($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-PERCEPCION-HORASEXTRA|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|{$array[$j][4]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina_deducion($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-DEDUCCION|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|{$array[$j][4]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function text_nomina_incapacidad($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-INCAPACIDAD|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|\n";
                }
            }
        } else {
            $texto = "";
        }
        return $texto;
    }

    public function formatear_fecha($excel_date) {
        $miliseconds = ($excel_date - (25567 + 2)) * 86400 * 1000;
        $seconds     = $miliseconds / 1000;
        return date("Y-m-d", $seconds);
    }

    public function existe_cfdirelacionados($tipo_relacion) {
        if (is_null($tipo_relacion)) {
            return "";
        } else {
            return "@CFDIRELACIONADOS|{$tipo_relacion}|\n";
        }
    }

    public function existe_nomina_emisor($array) {
        if (is_null($array[0]) && is_null($array[1]) && is_null($array[2])) {
            return "";
        } else {
            return "@NOMINA-EMISOR|{$array[0]}|{$array[1]}|{$array[2]}|\n";
        }
    }

    public function existe_emisor_entidad_sncf($array) {
        if (is_null($array[0]) && is_null($array[1])) {
            return "";
        } else {
            return "@NOMINA-EMISOR-ENTIDAD-SNCF|{$array[0]}|{$array[1]}|\n";
        }
    }

    public function existe_nomino_recptor($array) {
        if (is_null($array[0]) && is_null($array[1]) && is_null($array[2])
            && is_null($array[3]) && is_null($array[4])
            && is_null($array[5]) && is_null($array[6]) && is_null($array[7])
            && is_null($array[8]) && $array[9] && $array[10] && $array[11] && $array[12]
            && $array[13] && $array[14] && $array[15] && $array[16] && $array[17]) {
            return "";
        } else {
            return "@NOMINA-RECEPTOR|{$array[0]}|{$array[1]}|{$this->formatear_fecha($array[2])}|{$array[3]}|{$array[4]}|{$array[5]}|{$array[6]}|{$array[7]}|{$array[8]}|{$array[9]}|{$array[10]}|{$array[11]}|{$array[12]}|{$array[13]}|{$array[14]}|{$array[15]}|{$array[16]}|{$array[17]}|\n";
        }
    }

    public function existe_nomina_perce($array) {
        if (is_null($array[0]) && is_null($array[1]) && is_null($array[2])
            && is_null($array[3]) && is_null($arry[4])) {
            return "";
        } else {
            return "@NOMINA-PERCEPCIONES|{$array[0]}|{$array[1]}|{$array[2]}|{$array[3]}|{$array[4]}|\n";
        }
    }

    public function existe_percepcion_acciones($array) {
        if (is_null($array[0]) && is_null($array[1])) {
            return "";
        } else {
            return "@NOMINA-PERCEPCION-ACCIONES|{$array[0]}|{$array[1]}|\n";
        }
    }

    public function existe_nomina_jubilacion($array) {
        if (is_null($array[0]) && is_null($array[1]) && is_null($array[2])
            && is_null($array[3]) && is_null($array[4])) {
            return "";
        } else {
            return "@NOMINA-JUBILACIONPENSIONRETIRO|{$array[0]}|{$array[1]}|{$array[2]}|{$array[3]}|{$array[4]}|\n";
        }
    }

    public function existe_nomina_separacion($array) {
        if( is_null($array[0]) && is_null($array[1]) && is_null($array[2]) 
            && is_null($array[3]) && is_null($array[4])){
            return "";
        } else { 
            return "@NOMINA-SEPARACIONINDEMNIZACION|{$array[0]}|{$array[1]}|{$array[2]}|{$array[3]}|{$array[4]}|\n";
        }
    }

    public function existe_nomina_deduciones($array) {
        if(is_null($array[0]) && is_null($array[1])){
            return "";
        } else { 
            return "@NOMINA-DEDUCCIONES|{$array[0]}|{$array[1]}|\n";
        }
    }

    public function existe_nomina_otropago($array) {
        if(is_null($array[0]) && is_null($array[1]) && is_null($array[2]) && is_null($array[3])){
            return "";
        } else { 
            return "@NOMINA-OTROPAGO|{$array[0]}|{$array[1]}|{$array[2]}|{$array[3]}|\n";
        }
    }

    public function existe_nomina_otropago_compen($array) {
        if(is_null($array[0]) && is_null($array[1]) && is_null($array[2])){
            return "";
        } else { 
            return "@NOMINA-OTROPAGO|{$array[0]}|{$array[1]}|{$array[2]}|\n";
        }
    }

    public function existe_nomina_otropago_subcidio($subsidio_causado) {
        if(is_null($subsidio_causado)){
            return "";
        } else { 
            return "@NOMINA-OTROPAGO-SUBSIDIOALEMPLEO|{$subsidio_causado}|\n";
        }
    }



}