 <!doctype html>
 <html lang="en">
 <head>

     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

     <title>Importación de Excel</title>
 </head>
 <body>
     <div class="container m-5">
         <form action="{{route('excel_import.store')}}" method="POST" 
            accept-charset="UTF-8" enctype="multipart/form-data">
            @csrf
             <div class="form-row">
                 <div class="form-group col-md-6 ">
                     <label class="col-form-label">Ingrese el excel con el Layout</label>
                     <input class="fomr-control" type='file' name="layoute_file" accept=".csv, .xlsx">
                 </div>
                 <!-- <div class="form-group col-md-3">
                    
                 </div> -->
                 <div class="form-group col-md-12 ">
                  <button class="btn btn-success" type="submit">Guardar</button>
                  <a class="btn btn-primary" href="{{url('excel/Layout-ordenado.xlsx')}}" download="Plantilla">Descargar plantilla de Excel</a>
                 </div>
             </div>
         </form>
     </div>

     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


 </body>
 </html>
