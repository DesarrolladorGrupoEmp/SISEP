<!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_inventario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_inventario">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_inventario" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_salida" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de inventario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de inventario" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="" class=" control-label">Cantidad</label>
                        <input type="number" pattern="[0-9]{9}" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad de inventario" required = "true">
                    </div>
                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actioninventario" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actioninventario"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
