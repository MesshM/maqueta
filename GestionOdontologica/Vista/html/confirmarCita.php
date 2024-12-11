<?php ob_start() ?>
<h2>Información Cita</h2>

<?php 
if ($result && $result->num_rows > 0) {
    $fila = $result->fetch_object();
?>

<h3>Datos del Paciente</h3>
<table>
    <tr>
        <td>Documento</td>
        <td><?php echo htmlspecialchars($fila->CitPaciente); ?></td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><?php echo htmlspecialchars($fila->PacNombres . " " . $fila->PacApellidos); ?></td>
    </tr>
</table>

<h3>Datos del Médico</h3>
<table>
    <tr>
        <td>Documento</td>
        <td><?php echo htmlspecialchars($fila->CitMedico); ?></td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td><?php echo htmlspecialchars($fila->MedNombres . " " . $fila->MedApellidos); ?></td>
    </tr>
</table>

<h3>Datos de la Cita</h3>
<table>
    <tr>
        <td>Número</td>
        <td><?php echo htmlspecialchars($fila->CitNumero); ?></td>
    </tr>
    <tr>
        <td>Fecha</td>
        <td><?php echo htmlspecialchars($fila->CitFecha); ?></td>
    </tr>
    <tr>
        <td>Hora</td>
        <td><?php echo htmlspecialchars($fila->CitHora); ?></td>
    </tr>
    <tr>
        <td>Consultorio</td>
        <td><?php echo htmlspecialchars($fila->ConNombre); ?></td>
    </tr>
    <tr>
        <td>Estado</td>
        <td><?php echo htmlspecialchars($fila->CitEstado); ?></td>
    </tr>
    <tr>
        <td>Observaciones</td>
        <td><?php echo htmlspecialchars($fila->CitObservaciones); ?></td>
    </tr>
</table>

<?php 
} else {
    echo "<p>No se encontró la información de la cita.</p>";
}
?>

<?php
$contenido = ob_get_clean();
include 'plantilla.php';
?>