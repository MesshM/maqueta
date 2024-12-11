<?php
require_once 'Modelo/Conexion.php';

try {
    $conexion = new Conexion();
    echo "Conexión exitosa a la base de datos.";

    // Probar una consulta simple
    $resultado = $conexion->consulta("SELECT * FROM Pacientes LIMIT 1");
    if ($resultado && $resultado->num_rows > 0) {
        $paciente = $resultado->fetch_assoc();
        echo "<br>Primer paciente: " . $paciente['PacNombres'] . " " . $paciente['PacApellidos'];
    } else {
        echo "<br>No se encontraron pacientes.";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}