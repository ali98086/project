@if(session('toast-error'))


<!-- toast is bootstrap 4.6 because version of bootstrap project is 4.6 -->

<div class="toast bg-danger mb-0" data-delay="5000">
  <div class="toast-body d-flex bg-danger text-white rounded">
    <strong class="ml-auto font-weight-normal">{{session('toast-error')}}</strong>
    <button type="button" class="btn-close pl-0" data-dismiss="toast" aria-close="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>

<script>
  $('.toast').toast('show');
</script>

@endif


<!-- ------------------------------------------------------------------------------------------------------------------>

<!-- <div id="toast-error" class="toast bg-danger mb-0 show">
  <div class="toast-header d-flex bg-danger text-white rounded">
    <strong class="ml-auto font-weight-normal">{{session('toast-error')}}</strong>
    <button type="button" class="btn-close pl-0" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true" onclick="cls()">&times;</span>
    </button>
  </div>
</div>


<script type="text/javascript">

const myTimeout = setTimeout(cls, 5000);

  function cls() {
    var toast = document.querySelector("#toast-error");
    toast.style.display = "none";
  }
</script> -->

