<script>
    {{--Freeze Panel, requires jquery library--}}
    jQuery(document).ready(function() {
     jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
</script>
<script>
    {{--Edit Column Detail--}}
    $(document).on('click', '.column-score-modal', function() {
        $('.modal-title').text('Set Column Score');
        $('#csbatch_id_edit').val($(this).data('csbatch_id'));
        $('#type_id_edit').val($(this).data('type_id'));
        id = $('#csbatch_id_edit').val();
        $('#columnScoreModal').modal('show');
    });
    $('.modal-footer').on('click', '.edit', function() {
      if($('#columnscore_edit').val() < {{count($arraydetails)}})
      {
        alert("Please Select Column Bigger than Column Score!");
        setTimeout(function(){getElementById("mySave")
          window.location.reload();
        },200);
        return false;
      }
        $.ajax({
            type: 'PUT',
            url: '/home/scorings/scoringsheets/update-column-score/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#csbatch_id_edit").val(),
                'type_id': $("#type_id_edit").val(),
                'columnscore': $('#columnscore_edit').val(),
            },
            success: function(data) {
                window.location.reload();
            },
        });
    });
</script>
