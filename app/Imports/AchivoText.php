<?php
namespace App\Imports;

class AchivoText {

    public function generar_cadena_archivo($array) {
        $array_text                               = [];
        $rows_sheets_general                      = $array[0];
        $rows_sheets_cfdrelacion                  = $array[1];
        $rows_sheets_concepto                     = $array[2];
        $rows_sheets_nomina                       = $array[3];
        $rows_sheets_nomina_recptor_sub_con       = $array[4];
        $rows_sheets_nomina_percepcion            = $array[5];
        $rows_sheets_nomina_percepcion_horaextras = $array[6];
        $rows_sheets_nomina_deduciones            = $array[7];
        $rows_sheets_nomina_incapacidad           = $array[8];
        $length_rows_general                      = count($rows_sheets_general);
    
        for ($i = 0; $i < $length_rows_general; $i++) {
            $rfc                                 = $rows_sheets_general[$i][18];
            $text_cfdrelacion                    = $this->text_cfdrelacion($rfc, $rows_sheets_cfdrelacion);
            $text_concepto                       = $this->text_concepto($rfc, $rows_sheets_concepto);
            $text_nomina                         = $this->text_nomina($rfc, $rows_sheets_nomina);
            $text_nomina_recptor_subcontratacion = $this->text_nomina_recptor_subcontratacion($rfc, $rows_sheets_nomina_recptor_sub_con);
            $text_nomina_percepcion              = $this->text_nomina_percepcion($rfc, $rows_sheets_nomina_percepcion);
            $text_nomina_percepcion_horaextras   = $this->text_nomina_percepcion_horaextras($rfc, $rows_sheets_nomina_percepcion_horaextras);
            $text_nomina_deducion                = $this->text_nomina_deduciones($rfc, $rows_sheets_nomina_deduciones);
            $text_nomina_incapacidad             = $this->text_nomina_incapacidad($rfc, $rows_sheets_nomina_incapacidad);
            $array_text[$i]                      =
                "@COMPROBANTE|{$rows_sheets_general[$i][0]}|{$rows_sheets_general[$i][2]}|{$rows_sheets_general[$i][3]}|{$rows_sheets_general[$i][4]}|{$rows_sheets_general[$i][5]}|{$rows_sheets_general[$i][6]}|{$rows_sheets_general[$i][7]}|{$rows_sheets_general[$i][8]}|{$rows_sheets_general[$i][9]}|{$rows_sheets_general[$i][10]}|{$rows_sheets_general[$i][11]}|{$rows_sheets_general[$i][12]}|{$rows_sheets_general[$i][13]}|\n" .
                "@CFDIRELACIONADADOS|{$rows_sheets_general[$i][14]}|\n" .
                $text_cfdrelacion .
                "@EMISOR|{$rows_sheets_general[$i][15]}|{$rows_sheets_general[$i][16]}|{$rows_sheets_general[$i][17]}|\n" .
                "@RECEPTOR|{$rows_sheets_general[$i][18]}|{$rows_sheets_general[$i][19]}|{$rows_sheets_general[$i][20]}|{$rows_sheets_general[$i][21]}|{$rows_sheets_general[$i][22]}|\n" .
                $text_concepto .
                $text_nomina .
                "@NOMINA-EMISOR|{$rows_sheets_general[$i][23]}|{$rows_sheets_general[$i][24]}|{$rows_sheets_general[$i][25]}|\n" .
                "@NOMINA-EMISOR-ENTIDAD-SNCF|{$rows_sheets_general[$i][26]}|{$rows_sheets_general[$i][27]}|\n" .
                "@NOMINA-RECEPTOR|{$rows_sheets_general[$i][28]}|{$rows_sheets_general[$i][29]}|{$this->formatear_fecha($rows_sheets_general[$i][30])}|{$rows_sheets_general[$i][31]}|{$rows_sheets_general[$i][32]}|{$rows_sheets_general[$i][33]}|{$rows_sheets_general[$i][34]}|{$rows_sheets_general[$i][35]}|{$rows_sheets_general[$i][36]}|{$rows_sheets_general[$i][37]}|{$rows_sheets_general[$i][38]}|{$rows_sheets_general[$i][39]}|{$rows_sheets_general[$i][40]}|{$rows_sheets_general[$i][41]}|{$rows_sheets_general[$i][42]}|{$rows_sheets_general[$i][43]}|{$rows_sheets_general[$i][44]}|{$rows_sheets_general[$i][45]}|\n" .
                $text_nomina_recptor_subcontratacion .
                "@NOMINA-PERCEPCIONES|{$rows_sheets_general[$i][46]}|{$rows_sheets_general[$i][47]}|{$rows_sheets_general[$i][48]}|{$rows_sheets_general[$i][49]}|{$rows_sheets_general[$i][50]}|\n" .
                $text_nomina_percepcion .
                "@NOMINA-PERCEPCION-ACCIONES|{$rows_sheets_general[$i][51]}|{$rows_sheets_general[$i][52]}|\n" .
                $text_nomina_percepcion_horaextras .
                "@NOMINA-JUBILACIONPENSIONRETIRO|{$rows_sheets_general[$i][53]}|{$rows_sheets_general[$i][54]}|{$rows_sheets_general[$i][55]}|{$rows_sheets_general[$i][56]}|{$rows_sheets_general[$i][57]}|\n" .
                "@NOMINA-SEPARACIONINDEMNIZACION|{$rows_sheets_general[$i][58]}|{$rows_sheets_general[$i][59]}|{$rows_sheets_general[$i][60]}|{$rows_sheets_general[$i][61]}|{$rows_sheets_general[$i][62]}|\n" .
                "@NOMINA-DEDUCCIONES|{$rows_sheets_general[$i][63]}|{$rows_sheets_general[$i][64]}|\n" .
                $text_nomina_deducion .
                "@NOMINA-OTROPAGO|{$rows_sheets_general[$i][65]}|{$rows_sheets_general[$i][66]}|{$rows_sheets_general[$i][67]}|{$rows_sheets_general[$i][68]}|\n" .
                "@NOMINA-OTROPAGO-SUBSIDIOALEMPLEO|{$rows_sheets_general[$i][69]}|\n" .
                "@NOMINA-OTROPAGO-COMPESACION|{$rows_sheets_general[$i][70]}|{$rows_sheets_general[$i][71]}|{$rows_sheets_general[$i][72]}|\n" .
                $text_nomina_incapacidad;
        }

        return $array_text;
    }

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
            $texto = "@CFDIRELACION||\n";
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
            $texto = "@CONCEPTO|||||||||\n";
        }
        return $texto;
    }

    public function text_nomina($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $fecha_pago = $this->formatear_fecha($array[$j][2]);
                    $fecha_inicio_pago = $this->formatear_fecha($array[$j][3]);
                    $fecha_final_pago = $this->formatear_fecha($array[$j][4]);
                    $texto .= "@NOMINA|{$array[$j][1]}|{$fecha_pago}|{$fecha_inicio_pago}|{$fecha_final_pago}|{$array[$j][5]}|{$array[$j][6]}|{$array[$j][7]}|\n";
                }
            }
        } else {
            $texto = "@NOMINA|||||||||\n";
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
            $texto = "@NOMINA-RECEPTOR-SUBCONTRATACION|||\n";
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
            $texto = "@NOMINA-PERCEPCION||||||\n";
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
            $texto = "@NOMINA-PERCEPCION-HORASEXTRA|||||\n";
        }
        return $texto;
    }

    public function text_nomina_deduciones($rfc, $array) {
        $lenght = count($array);
        $texto  = "";
        if ($lenght > 0) {
            for ($j = 0; $j < $lenght; $j++) {
                if ($rfc == $array[$j][0]) {
                    $texto .= "@NOMINA-DEDUCCION|{$array[$j][1]}|{$array[$j][2]}|{$array[$j][3]}|{$array[$j][4]}|\n";
                }
            }
        } else {
            $texto = "@NOMINA-DEDUCCION|||||\n";
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
            $texto = "@NOMINA-INCAPACIDAD||||\n";
        }
        return $texto;
    }

    public function formatear_fecha($excel_date) {
        $miliseconds = ($excel_date - (25567 + 2)) * 86400 * 1000;
        $seconds     = $miliseconds / 1000;
        return date("Y-m-d", $seconds);
    }

}