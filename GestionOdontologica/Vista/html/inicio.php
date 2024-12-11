<?php ob_start() ?>
<h2>Información General</h2>
<p>El Sistema de Gestión Odontológica permite administrar la información de los pacientes, 
tratamientos y citas a través de una interfaz web.</p>
<p>El sistema cuenta con las siguientes secciones:</p>
<ul>
    <li>Asignar cita</li>
    <li>Consultar cita</li>
    <li>Cancelar cita</li>
</ul>
<?php
$contenido = ob_get_clean();
include 'plantilla.php';
?>