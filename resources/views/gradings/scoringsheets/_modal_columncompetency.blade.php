{{-- Modal Update Column Competency --}}
<div id="columnCompetencyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">Detail</label>
                        <div class="col-sm-10">
                          <input type="hidden" id="csbatch_id_edit">
                          <input type="hidden" id="index_edit">
                          <input type="hidden" id="type_edit">
                          <div class="row">
                            <div class="col-sm-12">
                              <select class="form-control input-sm" id="arraycompetency_edit" required>
                                @foreach ($competencies as $index => $item)
                                  <option value="{{ $index }}">KD {{ $peng->typename . '.' . (1 + $index) . ' ' . ucfirst($item) }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
                <div class="competency modal-footer">
                    <button type="button" class="edit btn btn-xs btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
