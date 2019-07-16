<?php

/**/

include '../controller/actorController.php';

include '../conexion/datos.php';

$actorInst = new actorController();

$arrPermisos = $actorInst->getPermisosModulo_Tipo($id_modulo, $_COOKIE[$NomCookiesApp . '_IDtipo']);

$crea           = $arrPermisos[0]['crear'];
$pkID_proyectoM = $_GET["id_proyectoM"];
$proyectoMGen   = $actorInst->getProyectosMarcoId($pkID_proyectoM);

include "form_actor.php";
include "form_modal_archivos.php";
?>

<div id="page-wrapper" style="margin: 0px;">

  <div class="row">
    <!-- Campo que contiene el valor del id del modulo para auditoria con el nombre del modulo-->
      <input type="hidden" id="id_mod_page_actor" value=<?php echo $id_modulo ?>>

      <div class="col-lg-12">
          <h1 class="page-header titleprincipal"><img src="../img/botones/actoronly.png">Actores - <?php echo $proyectoMGen[0]["nombre"] ?></h1>
      </div>
      <!-- /.col-lg-12 -->
    <div class="col-md-8">
          <ol class="breadcrumb migadepan">
            <li><a href="proyecto_marco.php" class="migadepan">Inicio</a></li>
            <li><a href="principal.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Menú principal</a></li>
            <li><a href="academico.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Académico</a></li>
            <li><a href="apropiacion.php?id_proyectoM=<?php echo $pkID_proyectoM; ?>" class="migadepan">Apropiación social</a></li>
            <li class="active migadepan">Actores - <?php echo $proyectoMGen[0]["nombre"] ?> </li>
          </ol>
    </div>

      <div class="col-md-2 text-right form-inline">
                    <label for="grupo_filtrop" class="control-label">Año: </label>
                      <?php
$actorInst->getSelectAnioFiltro();
?>
     </div>
    <div class="col-md-1 text-left form-inline">
                     <button class="btn btn-success" id="btn_filtrarg"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>

                     <hr>

            </div>

  </div>
  <!-- /.row -->

  <div class="row">

      <div class="col-lg-12">

        <div class="panel panel-default">

          <div class="titulohead">

            <div class="row">
              <div class="col-md-6">
                  <div class="titleprincipal"><h4>Registro de Actores</h4></div>
              </div>
              <div class="col-md-6 text-right">
                 <button id="btn_nuevoActor" type="button" class="btn btn-primary botonnewgrupo" data-toggle="modal" data-target="#frm_modal_actor" <?php if ($crea != 1) {echo 'disabled="disabled"';}?> >
                 <span class="glyphicon glyphicon-plus"></span>Nuevo Actor</button>
              </div>
            </div>

          </div>
          <!-- /.panel-heading -->

        <div class="panel-body">

          <div class="dataTable_wrapper">
              <table class="display table table-striped table-bordered table-hover" id="tbl_actor">
                  <thead>
                      <tr>
                         <!-- <th>ID Actor</th>-->
                          <th class="tabla-form-ancho-std">Nombre Actor</th>
                          <th class="tabla-form-ancho-std">Tipo de Actor</th>
                          <th class="tabla-form-ancho-std">Nombre Contacto</th>
                          <th class="tabla-form-ancho-std">Apellido Contacto</th>
                          <th class="tabla-form-ancho-std">Email Contacto</th>
                          <th class="tabla-form-ancho-std">Télefono Contacto</th>

                          <th class="tabla-form-ancho-sm" data-orderable="false">Opciones</th>
                      </tr>
                  </thead>

                  <tbody>
                      <?php
//print_r($_COOKIE);
//echo "valor de cookie de tipo ".$_COOKIE[$NomCookiesApp."_tipo"];
$actorInst->getTablaActor();
?>
                  </tbody>
              </table>
          </div>
          <!-- /.table-responsive -->

        </div>
        <!-- /.panel-body -->

        </div>
        <!-- /.panel -->

      </div>
      <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->