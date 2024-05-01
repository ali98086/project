@if(session('alert-message-info'))

<div class="alert alert-info alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">اطلاعات</h4>
  <hr>
  <h5>{{session('alert-message-info')}}</h5>
  <button type="button" class="close-btn-left font-weight-bold h4" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button>
</div>

<script>

  $(document).ready(function(){

    $('.alert').alert()

  })


</script>

@endif