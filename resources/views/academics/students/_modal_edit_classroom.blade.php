{{-- Modal Set Classroom --}}
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">Classroom</label>
                        <div class="col-sm-10">
                            <input type="hidden" id="id_edit">
                            <input type="hidden" id="index_edit">
                            <select class="form-control input-sm" id="classroomname_edit">
                              @foreach ($classrooms as $index => $item)
                                <option value="{{ $item->classroomname }}">{{ ucfirst($item->classroomname) }}</option>
                              @endforeach
                            </select>
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
