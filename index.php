<?php
require_once __DIR__ . '/includes/functions.php';
$tareas = obtenerTareas();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas de Cursos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Gestión de Tareas de Cursos</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_tarea.php" class="button">Agregar Nueva Tarea</a>

        <h2>Lista de Tareas</h2>
        <!-- ... -->

        <table>
            <tr>
                <th>Curso</th>
                <th>Descripción</th>
                <th>Fecha de Entrega</th>
                <th>Completada</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($tareas as $tarea): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarea['curso']); ?></td>
                    <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                    <td><?php echo formatDate($tarea['fechaEntrega']); ?></td>
                    <td><?php echo $tarea['completada'] ? 'Sí' : 'No'; ?></td>
                    <td class="actions">
                        <a href="editar_tarea.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
                        <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>