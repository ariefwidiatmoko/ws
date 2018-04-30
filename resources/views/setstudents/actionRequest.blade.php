
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
     $(function() {
         // run on change for the selectbox
         $( "#frm_duration" ).change(function() {
             updateDurationDivs();
         });

         // handle the updating of the duration divs
         function updateDurationDivs() {
             // hide all form-duration-divs
             $('.form-duration-div').hide();

             var divKey = $( "#frm_duration option:selected" ).val();
             $('#divFrm'+divKey).show();
         }

         // run at load, for the currently selected div to show up
         updateDurationDivs();
     });
  </script>
  <div id="advsearch">
  <form>
  <div class="col-xs-2 form-group">
    <!-- Publish Unpublish -->
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-btn">
          <a type="button" href="#" class="btn btn-default btn-sm">Action</i></a>
        </div>
        <select class="form-control input-sm" id="frm_duration">
           <option value="">Select</option>
           <option value="AddStudent">Add Student</option>
           <option value="AddYear">Add Year</option>
           <option value="SetGrade">Set Grade</option>
           <option value="SetClass">Set Classroom</option>
        </select>
      </div>
    </div>
  </div>
  </form>
   <div class="col-xs-2 form-group">
   <div id="divFrmAddStudent" class="form-group form-duration-div" style="display:none">
     <form enctype="multipart/form-data" role="form" action="{{ route('setstudents.importStudent') }}" method="POST">
       {{ csrf_field() }}
       <div class="input-group">
         <input id="file" type="file" class="form-control input-sm" name="file" required placeholder="Choose CSV file">
         <div class="input-group-btn">
           <button class="btn btn-primary btn-sm">Go!</i></button>
         </div>
       </div>
     </form>
   </div>
     <div id="divFrmAddYear" class="form-group form-duration-div" style="display:none">
       <div class="input-group">
         <select class="form-control input-sm" id="frm_duration" name="yearName">
           <option value="">Select Year</option>
           @foreach ($years as $item)
             @if(old('yearName') == $item->name)
             <option value="{{ $item->name }}" selected="selected">{{ ucfirst($item->name) }}</option>
            @else
              <option value="{{ $item->name }}">{{ ucfirst($item->name) }}</option>
            @endif
           @endforeach
         </select>
         <div class="input-group-btn">
           <button type="submit" class="btn btn-primary btn-sm">Go!</i></button>
         </div>
       </div>
     </div>
     <div id="divFrmSetGrade" class="form-group form-duration-div" style="display:none">
       <div class="input-group">
         <select class="form-control input-sm" id="frm_duration" name="gradeName">
           <option value="">Select Grade</option>
           @foreach ($grades as $item)
             @if(old('gradeName') == $item->name)
             <option value="{{ $item->name }}" selected="selected">{{ ucfirst($item->name) }}</option>
            @else
              <option value="{{ $item->name }}">{{ ucfirst($item->name) }}</option>
            @endif
           @endforeach
         </select>
         <div class="input-group-btn">
           <button type="submit" class="btn btn-primary btn-sm">Go!</i></button>
         </div>
       </div>
     </div>
     <div id="divFrmSetClass" class="form-group form-duration-div" style="display:none">
       <a href="#" class="btn btn-primary btn-sm">Set Classroom</i></a>
     </div>
   </div>
</div>
