<?php

namespace App\Http\Controllers;

use App\Imports\AchivoText;
use App\Imports\LayoutImport;
use File;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class ExcelController extends Controller {
    public function index() {
        return view('import');
    }

    public function create() {
    }

    public function store(Request $request) {
        $file                   = $request->file('layoute_file');
        $rows                   = Excel::toArray(new LayoutImport, $file);
        $estructura             = new AchivoText;
        $text_array             = $estructura->generar_cadena_archivo($rows);
        $length                 = count($text_array);
        $zip                    = new ZipArchive;
        $zip_file               = 'files_layout_'.time().'.zip';
        $array_ficheros_creados = [];

        if ($length > 0 && !is_null($text_array)) {

            if ($zip->open(public_path($zip_file) , ZipArchive::CREATE) === TRUE) {
                for ($i = 0; $i < $length; $i++) {
                    $fichero_txt = public_path() . "/excel/archivos_generados/layout_" . time() . "{$i}" . ".txt";

                    $archivo_nuevo = fopen($fichero_txt, 'a');
                    file_put_contents($fichero_txt, $text_array[$i], LOCK_EX);
                    
                    $name_base = "layout_" . time() . "{$i}" . ".txt";
                    $zip->addFile($fichero_txt, $name_base);
                    $array_ficheros_creados[$i] = $fichero_txt;
                }
                $zip->close();
            }

            for ($i = 0; $i < count($array_ficheros_creados); $i++) {
                if (File::exists($array_ficheros_creados[$i])) {
                    unlink($array_ficheros_creados[$i]);
                }
            }

            return response()->download($zip_file);
            unlink(public_path($zip_file));
        } else {
            dd('El excel se enuentra vacio');
        }
    }

    public function show($id) {
        echo ('hola mundo desde la function show');
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
