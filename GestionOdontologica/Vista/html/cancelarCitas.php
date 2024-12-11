<?php
if ($result->num_rows > 0) {
    ?>
    <table>
        <tr>
            <th>Número</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($fila = $result->fetch_object()) {
            ?>
            <tr>
                <td><?php echo $fila->CitNumero; ?></td>
                <td><?php echo $fila->CitFecha; ?></td>
                <td><?php echo $fila->CitHora; ?></td>
                <td><a href="#" onclick="confirmarCancelar(<?php echo $fila->CitNumero; ?>)">Cancelar</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
} else {
    ?>
    <p>El paciente no tiene citas asignadas</p>
<?php
}
?>