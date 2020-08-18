//*****************************************************************
//Inyección de eventos en el HTML
//*****************************************************************

$(function () { //para la creación de los controles
    //agrega los eventos las capas necesarias
    $("#enviar").click(function () {
        addOrUpdateUsuarios();
    });
    //agrega los eventos las capas necesarias
    $("#cancelar").click(function () {
        cancelAction();
    });    //agrega los eventos las capas necesarias

    $("#btMostarForm").click(function () {
        //muestra el fomurlaior
        clearFormUsuarios();
        $("#typeAction").val("add_usuarios");
        $("#myModalFormulario").modal();
    });
    
    
    
});

//*********************************************************************
//cuando el documento esta cargado se procede a cargar la información
//*********************************************************************

$(document).ready(function () {
    cargarTablas();
    
});

//*********************************************************************
//Agregar o modificar la información
//*********************************************************************

function addOrUpdateUsuarios() {
    //Se envia la información por ajax
    if (validar()) {
        $.ajax({
            url: '../backend/controller/usuariosController.php',
            data: {
                action:         $("#typeAction").val(),
                PK_Username:      $("#PK_Username").val(),
                nombre:         $("#nombre").val(),
                apellido1:      $("#apellido1").val(),
                apellido2:      $("#apellido2").val(),
                fecNacimiento:  $("#fecNacimiento").val(),
                sexo:           $("#sexo").val(),
                email:           $("#email").val(),
                contrasena:  $("#contrasena").val(),
                telefono:  $("#telefono").val(),
                tipoUsuario:  $("#tipoUsuario").val(),
                Ubicacion:  $("#Ubicacion").val()
            },
            error: function () { //si existe un error en la respuesta del ajax
                swal("Error", "Se presento un error al enviar la informacion", "error");
            },
            success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
                var messageComplete = data.trim();
                var responseText = messageComplete.substring(2);
                var typeOfMessage = messageComplete.substring(0, 2);
                if (typeOfMessage === "M~") { //si todo esta corecto
                    swal("Confirmacion", responseText, "success");
                    clearFormUsuarios();
                    $("#dt_usuarios").DataTable().ajax.reload();
                } else {//existe un error
                    swal("Error", responseText, "error");
                }
            },
            type: 'POST'
        });
    }else{
        swal("Error de validación", "Los datos del formulario no fueron digitados, por favor verificar", "error");
    }
}

//*****************************************************************
//*****************************************************************
function validar() {
    var validacion = true;

    
    //valida cada uno de los campos del formulario
    //Nota: Solo si fueron digitados
    if ($("#PK_Username").val() === "") {
        validacion = false;
    }

    if ($("#nombre").val() === "") {
        validacion = false;
    }

    if ($("#apellido1").val() === "") {
        validacion = false;
    }

    if ($("#apellido2").val() === "") {
        validacion = false;
    }

    if ($("#fecNacimiento").val() === "") {
        validacion = false;
    }

    if ($("#sexo").val() === "") {
        validacion = false;
    }

    if ($("#contrasena").val() === "") {
        validacion = false;
    }
    if ($("#email").val() === "") {
        validacion = false;
    }
    if ($("#telefono").val() === "") {
        validacion = false;
    }
    if ($("#tipoUsuario").val() === "") {
        validacion = false;
    }
    if ($("#Ubicacion").val() === "") {
        validacion = false;
    }



    return validacion;
}

//*****************************************************************
//*****************************************************************

function clearFormUsuarios() {
    $('#formUsuarios').trigger("reset");
}

//*****************************************************************
//*****************************************************************

function cancelAction() {
    //clean all fields of the form
    clearFormUsuarios();
    $("#typeAction").val("add_usuarios");
    $("#myModalFormulario").modal("hide");
}



//*****************************************************************
//*****************************************************************

function showUsuariosByID(PK_Username) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/usuariosController.php',
        data: {
            action: "show_usuarios",
            PK_Username: PK_Username
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al consultar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var objUsuariosJSon = JSON.parse(data);
            $("#PK_Username").val(objUsuariosJSon.PK_Username);
            $("#nombre").val(objUsuariosJSon.nombre);
            $("#apellido1").val(objUsuariosJSon.apellido1);
            $("#apellido2").val(objUsuariosJSon.apellido2);
            $("#fecNacimiento").val(objUsuariosJSon.fecNacimiento);
            $("#sexo").val(objUsuariosJSon.sexo);
            $("#contrasena").val(objUsuariosJSon.contrasena);
            $("#email").val(objUsuariosJSon.email);
            $("#telefono").val(objUsuariosJSon.telefono);
            $("#tipoUsuario").val(objUsuariosJSon.tipoUsuario);
            $("#Ubicacion").val(objUsuariosJSon.Ubicacion);
            $("#typeAction").val("update_usuarios");
            
            swal("Confirmacion", "Los datos de la usuario fueron cargados correctamente", "success");
        },
        type: 'POST'
    });
}

//*****************************************************************
//*****************************************************************

function deleteUsuariosByID(PK_Username) {
    //Se envia la información por ajax
    $.ajax({
        url: '../backend/controller/usuariosController.php',
        data: {
            action: "delete_usuarios",
            PK_Username: PK_Username
        },
        error: function () { //si existe un error en la respuesta del ajax
            swal("Error", "Se presento un error al eliminar la informacion", "error");
        },
        success: function (data) { //si todo esta correcto en la respuesta del ajax, la respuesta queda en el data
            var responseText = data.trim().substring(2);
            var typeOfMessage = data.trim().substring(0, 2);
            if (typeOfMessage === "M~") { //si todo esta corecto
                swal("Confirmacion", responseText, "success");
                clearFormUsuarios();
                $("#dt_usuarios").DataTable().ajax.reload();
            } else {//existe un error
                swal("Error", responseText, "error");
            }
        },
        type: 'POST'
    });
}




//*******************************************************************************
//Metodo para cargar las tablas
//*******************************************************************************


function cargarTablas() {



    var dataTableUsuarios_const = function () {
        if ($("#dt_usuarios").length) {
            $("#dt_usuarios").DataTable({
                dom: "Bfrtip",
                bFilter: false,
                ordering: false,
                buttons: [
                    {
                        extend: "copy",
                        className: "btn-sm",
                        text: "Copiar"
                    },
                    {
                        extend: "csv",
                        className: "btn-sm",
                        text: "Exportar a CSV"
                    },
                    {
                        extend: "print",
                        className: "btn-sm",
                        text: "Imprimir"
                    }

                ],
                "columnDefs": [
                    {
                        targets: 6,
                        className: "dt-center",
                        render: function (data, type, row, meta) {
                            var botones = '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="showUsuariosByID(\''+row[0]+'\');">Cargar</button> ';
                            botones += '<button type="button" class="btn btn-default btn-xs" aria-label="Left Align" onclick="deleteUsuariosByID(\''+row[0]+'\');">Eliminar</button>';
                            return botones;
                        }
                    }

                ],
                pageLength: 2,
                language: dt_lenguaje_espanol,
                ajax: {
                    url: '../backend/controller/usuariosController.php',
                    type: "POST",
                    data: function (d) {
                        return $.extend({}, d, {
                            action: "showAll_usuarios"
                        });
                    }
                },
                drawCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('#dt_usuarios').DataTable().columns.adjust().responsive.recalc();
                }
            });
        }
    };



    TableManageButtons = function () {
        "use strict";
        return {
            init: function () {
                dataTableUsuarios_const();
                $(".dataTables_filter input").addClass("form-control input-rounded ml-sm");
            }
        };
    }();

    TableManageButtons.init();
}

//*******************************************************************************
//evento que reajusta la tabla en el tamaño de la pantall
//*******************************************************************************

window.onresize = function () {
    $('#dt_usuarios').DataTable().columns.adjust().responsive.recalc();
};
