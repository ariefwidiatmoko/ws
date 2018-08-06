@extends('layouts.dashboard')

@section('title', 'Grading Scale')

@section('stylesheets')

@endsection

@section('navmenu')
  <a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home fa-fw"></i></a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a>Settings</a> <i class="fa fa-angle-right fa-fw" style="color: #3c8dbc;"></i>
  <a class="active">@yield('title')</a>
@endsection

@section('searchbox')

@endsection

@section('button')

  <button type="button" id="toggle-btn" class="btn btn-xs btn-success"><i class="fa fa-plus fa-fw"></i> Add Grading Scale</button>

@endsection

@section('content')
<div class="content" id="main-content" style="margin-top: -20px; margin-left: 1px;">
<div class="box box-primary collapsed-box" style="margin-top: 20px;">
  <div class="box-header">
    <div class="col-md-6">
      @yield('navmenu')
    </div>
    {{--box-tools--}}
  </div>
  {{--box-header--}}
</div>
  <div class="box" style="margin-top: -20px;">
    <div class="box-header" style="margin-left: 16px;">
      <h3 class="box-title">@yield('button')</h3>
    </div>
    <div class="toggle col-xs-12" style="margin-left: 10px; margin-bottom: 15px;">
      <form enctype="multipart/form-data" role="form" action="{{route('gradings.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-xs-2">
            <input type="number" name="score1" class="autofocus form-control input-sm" placeholder="Score: 90" required>
          </div>
          <div class="col-xs-2">
            <input type="text" name="alphabet" class="form-control input-sm" placeholder="Alphabet: A" required>
          </div>
          <div class="col-xs-2">
            <input type="number" name="score2" class="score2 form-control input-sm" placeholder="Score: 100" required>
          </div>
          <div class="col-xs-2">
            <div class="input-group">
              <input type="text" name="description" class="form-control input-sm" placeholder="Description: Sangat Bagus" required>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i></button>
              </div>
            </div>
          </div>
          <div class="col-xs-4"></div>
        </div>
      </form>
    </div>
    {{--box-header--}}
    <div id="inlist" class="table-responsive box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="inlist" class="table table-hover">
            <thead>
              <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Score</th>
                <th style="text-align: center;"><</th>
                <th style="text-align: center;">Alphabet</th>
                <th style="text-align: center;">&le;</th>
                <th style="text-align: center;">Score</th>
                <th style="text-align: center;">Description</th>
                <th style="text-align: center;">Action</th>
              </tr>
              {{ csrf_field() }}
            </thead>
            <tbody>
            @forelse ($result as $index => $item)
              <tr>
                <td style="text-align: center;">{{ $index + $result->firstItem() }}</td>
                <td style="text-align: center;">{{$item->score[0]}}</td>
                <td style="text-align: center;"><</td>
                <td style="text-align: center;">{{$item->alphabet}}</td>
                <td style="text-align: center;">&le;</td>
                <td style="text-align: center;">{{$item->score[1]}}</td>
                <td style="text-align: center;">{{$item->description}}</td>

                <td style="text-align: center;">
                  <div class="row">
                    <div class="btn-group" role="group">
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">

                        <a class="column-grading-modal btn btn-xs btn-info" data-id="{{$item->id}}" data-score1="{{$item->score[0]}}" data-score2="{{$item->score[1]}}" data-alphabet="{{$item->alphabet}}" data-description="{{$item->description}}">Edit</a>

                      </div>
                      <div class="col-xs-1 margin" style="margin: -1px 8px -1px 8px;">

                        {!! Form::open( ['method' => 'delete', 'url' => route('gradings.destroy', $item->id), 'onSubmit' => 'return confirm("Are yous sure wanted to delete ' . $item->alphabet . ' ?")']) !!}
                          <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        {!! Form::close() !!}

                      </div>
                    </div>
                  </div>
                </td>

              </tr>
              @empty
              <tr>
                <td colspan="8">No Grading Scale</td>
              </tr>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="hidden-xs hidden-sm" style="margin-left: 10px;">Showing <b>Page {{ $result->currentPage() }}</b> ( {{ $result->count() }} of {{ $result->total() }} details )</div>
          </div>
          <div class="col-sm-7 text-right" style="margin-top: -34px;">
            {!! $result->appends(Request::all())->render() !!}
          </div>
        </div>
      </div>
      {{--box-body--}}
    </div>
  </div>
</div>
@include('settings.gradings._modal_columngrading')
@endsection

@section('scripts')
    @include('shared._part_notification')
    <script>
        $(document).ready(function(){
            {{--Alert Sliding--}}
            $('div.alert').not('.alert-important').delay(3000).slideUp(300);
            {{--hide Add Grading Scale--}}
            $("div.toggle").hide();
            {{--Togle Grading Scale--}}
            $("#toggle-btn").click(function(){
                $("div.toggle").toggle(10);
                $(":input.autofocus").focus();
            });

            $("form").submit(function(){
                {{--Validate Number Input--}}
                var score1 = $(":input.autofocus").val();
                var score2 = $(":input.score2").val();

                if(100 < score1 || 100 < score2)
                {
                    alert("Please insert the correct number!");
                    return false;
                }
            });
        });

        {{--Edit Grading Scale--}}
        $(document).on('click', '.column-grading-modal', function() {
            $('.modal-title').text('Edit Grading Scale');
            $('#id_edit').val($(this).data('id'));
            $('#score1_edit').val($(this).data('score1'));
            $('#score2_edit').val($(this).data('score2'));
            $('#alphabet_edit').val($(this).data('alphabet'));
            $('#description_edit').val($(this).data('description'));
            id = $('#id_edit').val();
            $('#columnGradingModal').modal('show');
        });
        $('.detail').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: '/home/settings/gradings/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'score1': $("#score1_edit").val(),
                    'score2': $("#score2_edit").val(),
                    'alphabet': $("#alphabet_edit").val(),
                    'description': $('#description_edit').val(),
                },
                success: function(data) {
                    window.location.reload();
                },
            });
        });
    </script>
@endsection
