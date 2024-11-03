<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb+srv://maycolguzmanmiranda75:jzvzZ2F86eH9OGfP@cluster0.gfnmf.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
$database = $mongoClient->selectDatabase('Infracciones_transito');
$tasksCollection = $database->Infracciones;

