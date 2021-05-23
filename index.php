<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Compilador</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <h1 class="navbar-brand">Compilador</h1>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-md-5">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="codigo" class="form-label">Ingrese su código aquí</label>
                            <textarea id="codigo" class="form-control" rows="10">
                            </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-warning" id="analizar">
                                Analizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header bg-warning">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Lista de Simbolos</h4>
                        <table class="table table-striped table-bordered" id="tablaSimbolos">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Resultado</h4>
                        <table class="table table-striped table-hover table-bordered" id="tablaResultado">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Línea</th>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>