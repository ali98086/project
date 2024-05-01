@if(session('toast-success'))

<!-- toast is bootstrap 4.6 because version of bootstrap project is 4.6 -->

<div class="toast bg-danger mb-0" data-delay="5000">
  <div class="toast-body d-flex bg-success text-white rounded">
    <strong class="ml-auto font-weight-normal">{{session('toast-success')}}</strong>
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

<!-- <div id="toast-success" class="toast bg-success show mb-0 ">
  <div class="toast-header d-flex bg-success text-white rounded">
    <strong class="ml-auto font-weight-normal">با موفقیت</strong>
    <button type="button" class="btn-close pl-0" data-bs-dismiss="toast">
    <span aria-hidden="true" onclick="cls_success()">&times;</span>
    </button>
  </div>
</div> 
<script type="text/javascript">

const myTimeout = setTimeout(cls_success, 5000);

  function cls_success() {
    var toast = document.querySelector("#toast-success");
    toast.style.display = "none";
  }
</script> -->