{{-- Modal Update Column Grading --}}
<div id="columnGradingModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                  <input type="hidden" id="id_edit">
                  <div class="form-group">
                    <label class="control-label col-sm-2" style="text-align: left;">Score <i class="fa fa-arrow-circle-down fa-fw"></i></label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control input-sm" id="score1_edit" value="" placeholder="Example: 90">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" style="text-align: left;">Alphabet</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control input-sm" id="alphabet_edit" value="" placeholder="Example: A">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" style="text-align: left;">Score <i class="fa fa-arrow-circle-up fa-fw"></i></label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control input-sm" id="score2_edit" value="" placeholder="Example: 100">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" style="text-align: left;">Description</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control input-sm" id="description_edit" value="" placeholder="Example: Sangat Bagus" required>
                    </div>
                  </div>
                </form>
                <div class="detail modal-footer">
                    <button type="button" class="edit btn btn-xs btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
