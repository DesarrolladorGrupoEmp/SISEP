<!-- Form participantes -->
<div class="modal fade bs-example-modal-lg" id="frm_modal_asistencia" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header fondomodalheader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="imgedicion"></div><h3 class="modal-title titulomodal" id="lbl_form_asistencia">-</h3>
      </div>
      <div class="modal-body">
        <!-- form modal contenido -->

                <form id="form_asistencia" method="POST">
                <br>

                  <div class="form-group " hidden>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pkID" name="pkID">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fecha_acompanamiento_asistencia" class="control-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha_acompanamiento_asistenciaa" name="fecha_acompanamiento_asistencia" placeholder="Fecha" required = "true">
                    </div>

                <div class="form-group">
                    <label for="archivo" class="control-label">Adjuntar Documento</label>
                    <input id="fileuploadPM" type="file" name="files[]" data-url="../server/php/" multiple>
                </div>

                <div id="not_archivo" class="alert alert-info"></div>

                <div id="res_form"></div>

                <div id="not_documentos" class="alert alert-info"></div>
</form>
                    <div id='select_tutor'>
                      <label class="control-label">Participantes Asignados</label>
                      <form id="frm_participante_acompanamiento" name="frm_participante_acompanamiento"></form>
                    </div>



        <!-- /form modal contenido-->
      </div>
      <div class="modal-footer">
        <button id="btn_actionasistencia" type="button" class="btn btn-primary botonnewgrupo" data-action="-">
            <span id="lbl_btn_actionasistencia"></span>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- /form modal -->
