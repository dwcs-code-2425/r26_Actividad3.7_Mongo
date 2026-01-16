<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A3.2 Listado de editoriales</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Listado de editoriales</h1>

        <a href="add_editor.php">Crear editorial</a>

        <?php
        //phpinfo();
        require_once 'util.php';
        try {
            $data = getPublishers();
            showPublishers($data);
        }
        catch (Exception $e){
            error_log ("Ha ocurrido una excepción: " . $e->getMessage());
            showMsg("Ha ocurrido un error inesperado", "danger");
        }
        ?>
    </div>
</body>

</html>