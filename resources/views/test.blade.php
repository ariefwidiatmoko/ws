<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>test</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js">

    </script>
  </head>
  <body>
    <div class="container">
      <div class="col-xs-12">
        <h5>Test X-editable</h5>
      </div>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $item)
              <tr>
                <td> <div class="hidden" id="_token" data-token="{{ csrf_token() }}"></div> <p id="text" data-column="name" data-title="Username" data-name="name" data-type="text" data-pk="{{$item->id}}" data-url="{{ route('test.update', $item->id) }}"> {{ $item->name }} </p> </td>
                <td>{{$item->email}}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <script>
  $.fn.editable.defaults.mode = 'popup';
  $(function(){
    $("#text").editable({
      params: function(params) {
        params._token = $("#_token").data("token");
        params.name = $(this).editable().data('name');
        return params;
      },
      error: function(response, newValue) {
        if(response.status === 500) {
          return 'Server error. Chech entered data.';
        } else {
          return response.responseText;
        }
      }
    });
  });
  </script>
  </body>
</html>
