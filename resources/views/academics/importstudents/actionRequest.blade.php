<div id="advsearch">
   <div class="form-group" style="width: 370px; margin-left: 15px; margin-top: -5px;">
   <div class="form-group">
     <form enctype="multipart/form-data" role="form" action="{{ route('importstudents.import') }}" method="POST">
       {{ csrf_field() }}
       <div class="input-group">
         <div class="input-group-btn">
           <a type="button" href="{{url('data/student_data_example.csv')}}" class="btn btn-success btn-sm">CSV Template</i></a>
         </div>
         <input id="file" type="file" class="form-control input-sm" name="file" required>
         <div class="input-group-btn">
           <button id="import" type="submit" class="btn btn-primary btn-sm">Import Students</button>
         </div>
       </div>
     </form>
   </div>
   </div>
</div>
