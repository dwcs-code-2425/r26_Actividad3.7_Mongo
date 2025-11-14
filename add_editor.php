<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=d, initial-scale=1.0">
    <title>Crear editor</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Crear editor</h1>
        <a href="index.php">Volver al listado</a>

        <form method="post">
            <label for="nombre" class="form-label"></label>
            <input id="nombre" type="text" class="form-control" name="nombre" required>

            <button name="crear" class="btn btn-primary mt-3 mb-3" value="Crear">Crear </button>
        </form>

        <?php
        require_once 'util.php';
        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];

            try {
                if (($id = insertPublisher($nombre) ) !== false) {
                    showMsg("Se ha creado una nueva editorial con id $id", "success");
                } else {
                    showMsg("Ha ocurrido un error y no ha podido crearse el registro", "danger");
                }
            } catch (Exception $e) {
                showMsg("Ha ocurrido un error inesperado", "danger");
            }
        }
        ?>
    </div>
</body>

</html>