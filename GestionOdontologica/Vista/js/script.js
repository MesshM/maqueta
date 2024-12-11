$(document).ready(function(){
    $("#frmPaciente").dialog({
        autoOpen: false,
        height: 310,
        width: 400,
        modal: true,
        buttons: {
            "Insertar": insertarPaciente,
            "Cancelar": cancelar
        }
    });
});

function consultarPaciente(){
    var url = "index.php?accion=consultarPaciente&documento=" + $("#asignarDocumento").val();
    $("#paciente").load(url);
}

function mostrarFormulario(){
    documento = "" + $("#asignarDocumento").val();
    $("#PacDocumento").attr("value", documento);
    $("#frmPaciente").dialog('open');
}

function insertarPaciente(){
    queryString = $("#agregarPaciente").serialize();
    url = "index.php?accion=ingresarPaciente&" + queryString;
    $("#paciente").load(url);
    $("#frmPaciente").dialog('close');    
}

function cancelar(){
    $(this).dialog('close');    
}

function cargarHoras() {
    if ($("#medico").val() === "" || $("#fecha").val() === "") {
        $("#hora").html("<option value=''>---Seleccione la hora---</option>");
        return;
    }
    
    var queryString = "medico=" + $("#medico").val() + "&fecha=" + $("#fecha").val();
    var url = "index.php?accion=consultarHora&" + queryString;
    
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            $("#hora").html(data);
        },
        error: function() {
            alert("Error al cargar las horas disponibles");
        }
    });
}

$(document).ready(function() {
    $("#medico").change(cargarHoras);
    $("#fecha").change(cargarHoras);
});

$(document).ready(function() {
    $("#medico").change(cargarHoras);
    $("#fecha").change(cargarHoras);
});

function seleccionarHora() {
    if ($("#medico").val() == "-1") {
        alert("Debe seleccionar un médico");
        return false;
    }
    if ($("#fecha").val() == "") {
        alert("Debe seleccionar una fecha");
        return false;
    }
}

$(document).ready(function() {
    $("#medico").change(cargarHoras);
    $("#fecha").change(cargarHoras);
});

function consultarPaciente() {
    if ($("#asignarDocumento").val().trim() === "") {
        alert("Por favor ingrese un documento");
        return;
    }
    var url = "index.php?accion=consultarPaciente&documento=" + $("#asignarDocumento").val();
    $("#paciente").load(url);
}

function seleccionarHora() {
    if ($("#medico").val() == "-1") {
        alert("Debe seleccionar un médico");
        return false;
    }
    if ($("#fecha").val() == "") {
        alert("Debe seleccionar una fecha");
        return false;
    }
}

function seleccionarHora(){
    if($("#medico").val() == -1 ){
        alert("Debe seleccionar un médico");
    } else if ($("#fecha").val() == ""){
        alert("Debe seleccionar una fecha");
    }
}

function consultarCita(){
    url = "index.php?accion=consultarCita&consultarDocumento=" + $("#consultarDocumento").val();
    $("#paciente2").load(url);
}

function cancelarCita(){
    url = "index.php?accion=cancelarCita&cancelarDocumento=" + $("#cancelarDocumento").val();
    $("#paciente3").load(url);    
}

function confirmarCancelar(numero){
    if(confirm("¿Está seguro de cancelar la cita " + numero + "?")){
        $.get("index.php", {accion:'confirmarCancelar', numero:numero}, function(mensaje){
           alert(mensaje);
        });
    }
    $("#cancelarConsultar").trigger("click");
}
