<?php
namespace App\Imports;

use App\Imports\Validador;

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
        $validador                                = new Validador;

        for ($i = 0; $i < $length_rows_general; $i++) {
            $rfc = $rows_sheets_general[$i][18];

            $array_nomina_emisor         = [$rows_sheets_general[$i][23], $rows_sheets_general[$i][24], $rows_sheets_general[$i][25]];
            $array_emisor_entidad_sncf   = [$rows_sheets_general[$i][26], $rows_sheets_general[$i][27]];
            $array_nomina_receptor       = [$rows_sheets_general[$i][28], $rows_sheets_general[$i][29], $rows_sheets_general[$i][30], $rows_sheets_general[$i][31], $rows_sheets_general[$i][32], $rows_sheets_general[$i][33], $rows_sheets_general[$i][34], $rows_sheets_general[$i][35], $rows_sheets_general[$i][36], $rows_sheets_general[$i][37], $rows_sheets_general[$i][38], $rows_sheets_general[$i][39], $rows_sheets_general[$i][40], $rows_sheets_general[$i][41], $rows_sheets_general[$i][42], $rows_sheets_general[$i][43], $rows_sheets_general[$i][44], $rows_sheets_general[$i][45]];
            $array_nomina_percepciones   = [$rows_sheets_general[$i][46], $rows_sheets_general[$i][47], $rows_sheets_general[$i][48], $rows_sheets_general[$i][49], $rows_sheets_general[$i][50]];
            $array_percepcion_acciones   = [$rows_sheets_general[$i][51], $rows_sheets_general[$i][52]];
            $array_nomina_jubilacion     = [$rows_sheets_general[$i][53], $rows_sheets_general[$i][54], $rows_sheets_general[$i][55], $rows_sheets_general[$i][56], $rows_sheets_general[$i][57]];
            $array_nomina_separacion     = [$rows_sheets_general[$i][58], $rows_sheets_general[$i][59], $rows_sheets_general[$i][60], $rows_sheets_general[$i][61], $rows_sheets_general[$i][62]];
            $array_nomina_deducciones    = [$rows_sheets_general[$i][63], $rows_sheets_general[$i][64]];
            $array_nomina_otropago       = [$rows_sheets_general[$i][65], $rows_sheets_general[$i][66], $rows_sheets_general[$i][67], $rows_sheets_general[$i][68]];
            $array_nomina_otropago_compe = [$rows_sheets_general[$i][70], $rows_sheets_general[$i][71], $rows_sheets_general[$i][72]];

            $text_cfdrelacion                    = $validador->text_cfdrelacion($rfc, $rows_sheets_cfdrelacion);
            $text_concepto                       = $validador->text_concepto($rfc, $rows_sheets_concepto);
            $text_nomina                         = $validador->text_nomina($rfc, $rows_sheets_nomina);
            $text_nomina_recptor_subcontratacion = $validador->text_nomina_recptor_subcontratacion($rfc, $rows_sheets_nomina_recptor_sub_con);
            $text_nomina_percepcion              = $validador->text_nomina_percepcion($rfc, $rows_sheets_nomina_percepcion);
            $text_nomina_percepcion_horaextras   = $validador->text_nomina_percepcion_horaextras($rfc, $rows_sheets_nomina_percepcion_horaextras);
            $text_nomina_deducion                = $validador->text_nomina_deducion($rfc, $rows_sheets_nomina_deduciones);
            $text_nomina_incapacidad             = $validador->text_nomina_incapacidad($rfc, $rows_sheets_nomina_incapacidad);
            
            $cfdirelacionados             = $validador->existe_cfdirelacionados($rows_sheets_general[$i][14]);
            $nomina_emisor                = $validador->existe_nomina_emisor($array_nomina_emisor);
            $emisor_entidad_sncf          = $validador->existe_emisor_entidad_sncf($array_emisor_entidad_sncf);
            $nomina_receptor              = $validador->existe_nomino_recptor($array_nomina_receptor);
            $nomina_percepciones          = $validador->existe_nomina_perce($array_nomina_percepciones);
            $nomina_percepcion_acciones   = $validador->existe_percepcion_acciones($array_percepcion_acciones);
            $nomina_percepcion_jubilacion = $validador->existe_nomina_jubilacion($array_nomina_jubilacion);
            $nomina_separacion            = $validador->existe_nomina_separacion($array_nomina_separacion);
            $nomina_deducciones           = $validador->existe_nomina_deduciones($array_nomina_deducciones);
            $nomina_otropago              = $validador->existe_nomina_otropago($array_nomina_otropago);
            $nomina_otropago_subcidio     = $validador->existe_nomina_otropago_subcidio($rows_sheets_general[$i][69]);
            $nomina_otropago_compe        = $validador->existe_nomina_otropago_compen($array_nomina_otropago_compe);
                    
            $array_text[$i] =
                "@COMPROBANTE|{$rows_sheets_general[$i][0]}|{$rows_sheets_general[$i][1]}|{$rows_sheets_general[$i][2]}|{$rows_sheets_general[$i][3]}|{$rows_sheets_general[$i][4]}|{$rows_sheets_general[$i][5]}|{$rows_sheets_general[$i][6]}|{$rows_sheets_general[$i][7]}|{$rows_sheets_general[$i][8]}|{$rows_sheets_general[$i][9]}|{$rows_sheets_general[$i][10]}|{$rows_sheets_general[$i][11]}|{$rows_sheets_general[$i][12]}|{$rows_sheets_general[$i][13]}|\n" .
                $cfdirelacionados . 
                $text_cfdrelacion .
                "@EMISOR|{$rows_sheets_general[$i][15]}|{$rows_sheets_general[$i][16]}|{$rows_sheets_general[$i][17]}|\n" .
                "@RECEPTOR|{$rows_sheets_general[$i][18]}|{$rows_sheets_general[$i][19]}|{$rows_sheets_general[$i][20]}|{$rows_sheets_general[$i][21]}|{$rows_sheets_general[$i][22]}|\n" .
                $text_concepto .  $text_nomina .  $nomina_emisor . $emisor_entidad_sncf  .
                $nomina_receptor  . $text_nomina_recptor_subcontratacion . $nomina_percepciones . $text_nomina_percepcion .
                $nomina_percepcion_acciones .  $text_nomina_percepcion_horaextras . $nomina_percepcion_jubilacion .
                $nomina_separacion  .  $nomina_deducciones . $text_nomina_deducion . $nomina_otropago .
                $nomina_otropago_subcidio  .  $nomina_otropago_compe . $text_nomina_incapacidad;
        }
        // dd($array_text);
        // die();
        return $array_text;
    }

}