<option value="">---Seleccione la hora---</option>
<?php
while ($fila = $result->fetch_object()) {
    echo "<option value='" . $fila->hora . "'>" . $fila->hora . "</option>";
}
?>