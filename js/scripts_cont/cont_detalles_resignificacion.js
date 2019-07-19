$(function() {
    var arrParticipante = [];
    var arrParticipantes = [];
    var arrParticipantesasignados = []
    var arrEstado = [];
    $("#btn_asignarevidencia").click(function() {
        $("#lbl_form_evidencia").html("Crear evidencia");
        $("#lbl_btn_actionevidencia").html("Guardar <span class='glyphicon glyphicon-save'></span>");
        $("#btn_actionevidencia").attr("data-action", "crear");
        $("#form_evidencia")[0].reset();
        cargar_input_documento();
    });
    //Definir la acción del boton del formulario 
    $("#btn_actionevidencia").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionasistencia").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("#btn_actionasignarparticipante").click(function() {
        console.log("al principio");
        action = $(this).attr("data-action");
        //define la acción que va a realizar el formulario
        valida_actio(action);
        console.log("accion a ejecutar: " + action);
    });
    $("[name*='elimina_evidencia']").click(function(event) {
        id_estudian = $(this).attr('data-id-evidencia');
        console.log(id_estudian)
        deleteSaberNumReg(id_estudian);
    });
    sessionStorage.setItem("id_tab_participante", null);
    //---------------------------------------------------------
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //valida accion a realizar
    function valida_actio(action) {
        console.log("en la mitad");
        if (action === "crear") {
            crea_evidencia();
        } else {
            guardar();
        }
    };

    function crea_evidencia() {
        resignficacion = $("#btn_asignarevidencia").attr('data-resignificacion');
        var data = new FormData();
        data.append('file', $("#url_evidencia").get(0).files[0]);
        data.append('fecha', $("#fecha").val());
        data.append('descripcion', $("#descripcion").val());
        data.append('fkID_resignificacion', resignficacion);
        data.append('tipo', "crear_evidencia");
        $.ajax({
            type: "POST",
            url: "../controller/ajaxresignificacion.php",
            data: data,
            contentType: false,
            processData: false,
            success: function(a) {
                console.log(a);
                location.reload();
            }
        })
    }

    function crea_asistencia() {
        if (upload.arregloDeArchivos.length > 0) {
            $('#fileuploadPM').fileupload('send', {
                files: upload.arregloDeArchivos
            }).success(function(result, textStatus, jqXHR) {
                upload.functionSend($("#pkID").val(), result);
            });
        } else {
            location.reload()
        }
    }
    //valida si existe el documento
    function validaEqualIdentifica(num_id) {
        console.log("busca valor " + encodeURI(num_id));
        var consEqual = "SELECT COUNT(*) as res_equal FROM `estudiante` WHERE `documento_estudiante` = '" + num_id + "'";
        $.ajax({
            url: '../controller/ajaxController12.php',
            data: "query=" + consEqual + "&tipo=consulta_gen",
        }).done(function(data) {
            /**/
            //console.log(data.mensaje[0].res_equal);
            if (data.mensaje[0].res_equal > 0) {
                alert("El Número de indetificación ya existe, por favor ingrese un número diferente.");
                $("#documento_estudiante").val("");
            } else {
                //return false;
            }
        }).fail(function() {
            console.log("error");
        }).always(function() {
            console.log("complete");
        });
    }
    $("#fkID_docente").change(function(event) {
        estado = valida_estado();
        if (estado == false) {
            alert('Seleccione un estado');
            $("#fkID_docente").val('');
            $("#fkID_estado").focus();
        } else {
            idDocente = $(this).val();
            nomDocente = $(this).find("option:selected").data('nombre')
            idEstado = $("#fkID_estado").val();
            nomEstado = $("#fkID_estado").find("option:selected").data('nombre')
            console.log(idEstado);
            console.log(nomEstado);
            if (verPkIdTutor()) {
                if (document.getElementById("fkID_paricipante_form_" + idDocente)) {
                    console.log(document.getElementById("fkID_participante_form_" + idDocente));
                    console.log("Este participante ya fue seleccionado.");
                } else {
                    arrParticipante.length = 0;
                    selectParticipante(idEstado, nomEstado, idDocente, nomDocente, 'select', $(this).data('accion'));
                    serializa_array(crea_array(arrParticipante, $("#pkID").val(), fecha));
                }
            } else {
                selectParticipante(idEstado, nomEstado, idDocente, nomDocente, 'select', $(this).data('accion'));
            };
        }
    });

    function valida_estado() {
        if ($("#fkID_estado").val() == '') {
            return false;
        } else {
            return true;
        }
    }

    function crea_array(array, id_grupo, fecha) {
        console.log("no te vallas chavito")
        console.log(array)
        array.forEach(function(element, index) {
            //statements
            var obtHE = {
                "fkID_saber_propio": id_grupo,
                "fkID_estudiante": element
            };
            arrParticipantesasignados.push(obtHE);
            console.log(obtHE);
        });
        return arrParticipantesasignados;
    }

    function serializa_array(array) {
        console.log("no te vallas chavito")
        console.log(array);
        var cadenaSerializa = "";
        $.each(array, function(index, val) {
            var dataCadena = "";
            $.each(val, function(llave, valor) {
                console.log("llave=" + llave + " valor=" + valor);
                dataCadena = dataCadena + llave + "=" + valor + "&";
            });
            dataCadena = dataCadena.substring(0, dataCadena.length - 1);
            console.log(dataCadena);
            insertatutgrupo(dataCadena)
        });
        console.log('Se terminó de insertar los usuarios!')
    }

    function insertatutgrupo(data) {
        $.ajax({
            url: "../controller/ajaxController12.php",
            data: data + "&tipo=inserta&nom_tabla=funcionario_grupo",
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        }).always(function() {
            console.log("complete");
        });
    }

    function selectParticipante(idEstado, nomEstado, idDocente, nomDocente, type, numReg) {
        console.log(idEstado)
        if (idEstado != "") {
            if (document.getElementById("fkID_participante_form_" + idDocente)) {
                alert("Este participante ya fue seleccionado.")
            } else {
                if (type == 'select') {
                    console.log("1");
                    $("#frm_participante_acompanamiento").append('<div class="form-group" id="frm_group' + idDocente + '">' + '<input type="text" style="width: 45%;display: inline;" class="form-control" id="fkID_estado_form_' + idEstado + '" name="fkID_estado" value="' + nomEstado + '" readonly="true">' + '<input type="text" style="width: 45%;display: inline;" class="form-control" id="fkID_participante_form_' + idDocente + '" name="fkID_docente" value="' + nomDocente + '" readonly="true"><button name="btn_actionRmUsuario_' + idDocente + '"  data-id-frm-group="frm_group' + idDocente + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                } else {
                    console.log("2");
                    $("#frm_participante_acompanamiento").append('<div class="form-group" id="frm_group' + idDocente + '">' + '<input type="text" style="width: 90%;display: inline;" class="form-control" id="fkID_participante_form_' + id + '" name="fkID_usuario" value="' + nombre + '" readonly="true"> <button name="btn_actionRmUsuario_' + id + '" data-id-tutor="' + id + '" data-id-frm-group="frm_group' + id + '" data-numReg = "' + numReg + '" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>' + '</div>');
                }
                $("[name*='btn_actionRmUsuario_" + idDocente + "']").click(function(event) {
                    console.log('click remover usuario ' + $(this).data('id-frm-group'));
                    removeUsuario($(this).data('id-frm-group'));
                    //buscar el indice
                    var idUsuario = $(this).attr("data-id-tutor");
                    console.log('el elemento es:' + idUsuario);
                    var indexArr = arrParticipante.indexOf(idUsuario);
                    console.log("El indice encontrado es:" + indexArr);
                    //quitar del array
                    if (indexArr >= 0) {
                        arrParticipante.splice(indexArr, 1);
                        console.log(arrParticipante);
                    } else {
                        console.log('salio menor a 0');
                        console.log(arrParticipante);
                    }
                    //deleteSaberNumReg(numReg);
                });
                arrParticipante.push(idDocente);
                console.log(arrParticipante);
                arrEstado.push(idEstado);
                console.log(arrEstado);
            }
        } else {
            alert("No se seleccionó ningún usuario.")
        }
    };

    function removeUsuario(id) {
        $("#" + id).remove();
    }

    function verPkIdTutor() {
        var id_proyecto_form = $("#pkID").val();
        if (id_proyecto_form != "") {
            return true;
        } else {
            return false;
        }
    };

    function deleteSaberNumReg(numReg) {
        var confirma = confirm("En realidad quiere eliminar la evidencia?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + numReg + "&tipo=eliminarlogico&nom_tabla=evidencia_resignificacion",
            }).done(function(data) {
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("error");
            }).always(function() {
                console.log("complete");
            });
        }
    }
    //Función para cargar varios archivos
    self.upload = new funcionesUpload("btn_actionasistencia", "res_form", "not_documentos", "acompanamiento_asistencia", "fkID_proyectoM")
    $('#fileuploadPM').fileupload({
        dataType: 'json',
        add: function(e, data) {
            upload.functionAdd(data)
        },
        done: function(e, data) {
            console.log('Load finished.');
        }
    });

    function cargar_input_documento() {
        $("#form_evidencia").append('<div class="form-group" id="pdf_documento">' + '<label for="adjunto" id="lbl_url_acompanamiento" class=" control-label">Documento</label>' + '<input type="file" class="form-control" id="url_evidencia" name="documento" placeholder="Email del acompanamiento" required = "true">' + '</div>')
    }
});