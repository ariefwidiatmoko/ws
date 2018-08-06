{{-- Modal Update Column Scoring --}}
<div id="columnScoreModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-sm-12">
                          <input type="hidden" id="csbatch_id_edit">
                          <input type="hidden" id="type_id_edit">
                          <div class="row">
                            <div class="col-sm-12">
                            <select id="columnscore_edit" class="form-control" name="columnscore" required>
                              <option value="">Select Column Score</option>
                              <option value="5">5 Columns</option>
                              <option value="10">10 Columns</option>
                              <option value="15" selected>15 Columns</option>
                              <option value="20">20 Columns</option>
                              <option value="30">30 Columns</option>
                              <option value="40">40 Columns</option>
                              <option value="50">50 Columns</option>
                            </select>
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="edit btn btn-xs btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
