{{-- Modal Update Column Scoring --}}
<div id="columnDetailModal" class="modal fade" role="dialog">
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
                            <div class="row">
                              <div class="col-sm-6">
                                <select class="form-control input-sm" id="detailcolumn_edit" required>
                                  @foreach ($details as $index => $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->detailname) }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-sm-6">
                                <input type="text" class="form-control input-sm" id="detailnumber_edit" value="" placeholder="Example: 1" required>
                              </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="edit btn btn-xs btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-xs btn-warning" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
