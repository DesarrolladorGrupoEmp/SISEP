<!-- Form institucion -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_acompanamiento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_acompanamiento">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_acompanamiento" method="POST" enctype="multipart/form-data">
                <br>
                    <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fkID_proyecto_marco" name="fkID_proyecto_marco">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_acompanamiento" name="fecha_acompanamiento" placeholder="Fecha de acompañamiento" required = "true">
                    </div>

                    <div class="form-group">
                        <label for="descripcion" class="control-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required="true">
                    </div>

                    <div class="form-group">
                        <label for="url_imagen" class="control-label">Documento tecnico</label>
                        <input id="archivo1" type="file" name="archivo1">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url_documento" name="url_documento" disabled="disabled" >
                    </div>

                    <div class="form-group">
                        <label for="url_imagen" class="control-label">Documento tecnico</label>
                        <input id="archivo2" type="file" name="archivo2">
                    </div>

                </form>

        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionacompanamiento" type="button" class="btn btn-primary botonnewacompanamiento" data-action="-">
            <span id="lbl_btn_actionacompanamiento"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->