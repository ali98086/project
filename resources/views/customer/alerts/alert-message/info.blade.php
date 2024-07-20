@if(session('alert-message-info'))

<div class="alert alert-info d-flex justify-content-between py-2" role="alert">

{{session('alert-message-info')}}

  <button type="button" style="background-color: inherit; border: none;" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true" style="font-size:20px">×</span>
  </button>

</div>


<script>
  $(document).ready(function() {

    $('.alert').alert();

  })
</script>


@endif