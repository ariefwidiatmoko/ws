
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
   <div class="form-group" style="width: 320px; margin-left: 15px;">
   <div class="form-group">
     <form enctype="multipart/form-data" role="form" action="{{ route('importstudents.import') }}" method="POST">
       {{ csrf_field() }}
       <div class="input-group">
         <div class="input-group-btn">
           <a type="button" href="#" class="btn btn-default btn-sm">Import CSV</i></a>
         </div>
         <input id="file" type="file" class="form-control input-sm" name="file" required placeholder="Choose CSV file" required>
         <div class="input-group-btn">
           <button type="submit" class="btn btn-primary btn-sm">Go!</button>
         </div>
       </div>
       <label for="file" style="font-size: 0.7em;"><a href="{{url('data/student_data_example.csv')}}">CSV file Template</a></label>
     </form>
   </div>
   </div>
</div>
