$(function() {
    $("#btn_nuevotalento_humano").jquery_controllerV2({
        nom_modulo: 'talento_humano',
        titulo_label: 'Nuevo talento humano',
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(ajustes) {
            console.log('Ejecutando despues de todo...');
            id = $("#btn_nuevotalento_humano").attr('data-proyecto');
            $("#fkID_proyecto_marco").val(id);
            console.log(id);
            //console.log(ajustes);
            //destruye_cambia_pass();
            //------------------------------------------
            //matrix Relation
            //limpia el form
            //------------------------------------------      
        }
    });
    $("#btn_actiontalento_humano").jquery_controllerV2({
        tipo: 'inserta/edita',
        nom_modulo: 'talento_humano',
        nom_tabla: 'funcionario_cargo',
        recarga: false,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(data, ajustes) {
            console.log('Ejecutando despues de todo...');
            console.log(data)
            console.log(ajustes)
            location.reload()
        }
    });
    $("[name*='edita_talento_humano']").jquery_controllerV2({
        tipo: 'carga_editar',
        nom_modulo: 'talento_humano',
        nom_tabla: 'funcionario_cargo',
        titulo_label: 'Editar Asignacion laboral',
        tipo_load: 1,
        functionBefore: function(ajustes) {
            console.log('Ejecutando antes de todo...');
            console.log(ajustes);
        },
        functionAfter: function(data) {
            console.log('Ejecutando despues de todo...');
            console.log(data);
            //----------------------------------------------------------------
        }
    });
    $("[name*='elimina_talento_humano']").click(function(event) {
        id_funciona = $(this).attr('data-id-talento_humano');
        console.log(id_funciona)
        elimina_talento_humano(id_funciona);
    });

    function elimina_talento_humano(id_funciona) {
        console.log('Eliminar el talento humano: ' + id_funciona);
        var confirma = confirm("En realidad quiere eliminar este talento humano?");
        console.log(confirma);
        /**/
        if (confirma == true) {
            //si confirma es true ejecuta ajax
            $.ajax({
                url: '../controller/ajaxController12.php',
                data: "pkID=" + id_funciona + "&tipo=eliminarlogico&nom_tabla=funcionario_cargo",
            }).done(function(data) {
                //---------------------
                console.log(data);
                location.reload();
            }).fail(function() {
                console.log("errorfatal");
            }).always(function() {
                console.log("complete");
            });
        } else {
            //no hace nada
        }
    };
    //click al detalle en cada fila----------------------------
    $('.table').on('click', '.detail', function() {
        window.location.href = $(this).attr('href');
    });
    //------------------------------------------------------
    //Funcion para pasar condicion de año
    $("#btn_filtro_anio").click(function(event) {
        proyecto = $("#btn_nuevotalento_humano").attr("data-proyecto");
        nombre = $('select[name="anio_filtro"] option:selected').text();
        location.href = "talento_humano.php?id_proyectoM=" + proyecto + "&anio='" + nombre + "'";
    });
});