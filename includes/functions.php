<?php
require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}

function crearInfraccion($infraccion, $descripcion, $costo_infraccion, $fechaEntrega) {
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'infraccion' => sanitizeInput($infraccion),
        'descripcion' => sanitizeInput($descripcion),
        'costo_infraccion' => sanitizeInput($costo_infraccion),
        'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
        'cancelado' => false
    ]);
    return $resultado->getInsertedId();
}

function obtenerInfracciones() {
    global $tasksCollection;
    return $tasksCollection->find();
}

// Añadiremos más funciones en pasos posteriores
function obtenerInfraccionPorId($id) {
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

function actualizarInfraccion($id, $infraccion, $descripcion, $costo_infraccion, $fechaEntrega, $cancelado) {
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'infraccion' => sanitizeInput($infraccion),
            'descripcion' => sanitizeInput($descripcion),
            'costo_infraccion' => sanitizeInput($costo_infraccion),
            'fechaEntrega' => new MongoDB\BSON\UTCDateTime(strtotime($fechaEntrega) * 1000),
            'cancelado' => $cancelado
        ]]
    );
    return $resultado->getModifiedCount();
}

function eliminarInfraccion($id) {
    global $tasksCollection;
    $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $resultado->getDeletedCount();
}


