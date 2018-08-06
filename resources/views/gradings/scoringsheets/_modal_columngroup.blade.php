{{-- Modal Update Column Scoring --}}
<div id="columnGroupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <input type="hidden" id="csbatch_id_edit">
                    <input type="hidden" id="index_edit">
                    <input type="hidden" id="type_edit">
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="id">Group</label>
                      <div class="col-sm-8">
                        <select class="form-control input-sm" id="group_edit" required>
                          @foreach ($groups as $index => $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->groupname) }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-4" for="id">Detail Percentage (%)</label>
                      <div class="col-sm-8">
                        <input class="form-control input-sm" type="number" id="grouppercentage_edit" placeholder="Example: 20" required>
                      </div>
                    </div>
                </form>
                <div class="group modal-footer">
                    <button type="button" class="edit btn btn-xs btn-primary" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
