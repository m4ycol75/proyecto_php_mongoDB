<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearTarea($_POST['curso'], $_POST['descripcion'], $_POST['fechaEntrega']);
    if ($id) {
        header("Location: index.php?mensaje=Tarea creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la tarea.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nueva tarea</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <h1>Agregar nueva tarea</h1>
    <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

    <form action="" method="post">
        <label for="">Curso:
            <input type="text" name="curso">
        </label><br><br>
        <label for="">Descripcion:
            <input type="text" name="descripcion">
        </label><br><br>
        <label for="">Fecha de Entrega:
            <input type="date" name="fechaentrega">
        </label><br><br>

        <input type="submit" value="Crear Tarea">
        
        <button><a href="index.php">Volver</button>
        </a>
    </form>

</body>

</html>