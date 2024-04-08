<script src="{{asset('admin-assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{asset('admin-assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-assets/js/grid.js')}}"></script>
<script src="{{asset('admin-assets/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin-assets/sweetalert/sweetalert2.js')}}"></script>

<script>
    function readAll() {

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("notification").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "/admin/notification/readAll", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("_token={{csrf_token()}}");
        document.querySelector('#notification-badge').classList.add('d-none');

        
        // OR

        // $.ajax({
           
        //     type: "POST",
        //     url: '/admin/notification/readAll',
        //     data: {_token : "{{csrf_token()}}" },
            
        //     success: function() {
        //         document.querySelector('#notification-badge').classList.add('d-none');
        //     }

        // });
    }



</script>