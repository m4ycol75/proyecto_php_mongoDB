<?php
require_once __DIR__ . '/includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$tarea = obtenerTareaPorId($_GET['id']);

if (!$tarea) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarTarea($_GET['id'], $_POST['curso'], $_POST['descripcion'], $_POST['fechaEntrega'], isset($_POST['completada']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Tarea actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la tarea.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Tarea</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Curso: <input type="text" name="curso" value="<?php echo htmlspecialchars($tarea['curso']); ?>" required></label>
            <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea></label>
            <label>Fecha de Entrega: <input type="date" name="fechaEntrega" value="<?php echo formatDate($tarea['fechaEntrega']); ?>" required></label>
            <label>Completada: <input type="checkbox" name="completada" <?php echo $tarea['completada'] ? 'checked' : ''; ?>></label>
            <input type="submit" value="Actualizar Tarea">
        </form>
        <a href="index.php" class="button">Volver a la lista de tareas</a>
    </div>
</body>

</html>