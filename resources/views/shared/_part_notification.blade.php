<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";

    if(type == 'success') {
      toastr.success("{{ Session::get('message') }}");
    } else {
      toastr.error("{{ Session::get('message') }}");
    }
  @endif
</script>
