</div><!-- /.content-wrapper -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <!-- <div class="float-right d-none d-sm-inline">
                Anything you want
            </div> -->
            <!-- Default to the left -->
            <strong>(O-GHIMS) - Online Gym Information With Health Monitoring System</strong>
        </footer>
	</div>
	<!-- ./wrapper -->



<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>
<!-- Sweetalert -->
<script src="/assets/sweetalert/sweetalert.min.js"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Summernote -->
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script>
  $(document).ready(function() {

        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });

        $('#logoutButton').click(function(){
          var type = $(this).attr('data-type');
          if (type == "admin") {
            return window.location.replace('/includes/logout.php');

          }else {
            return window.location.replace('/includes/logout.php');
          }
        });
        

        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#picture_display').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#picture").change(function(){
          $('#picture_display').show();
          readURL(this);
        });
    });  
</script>

<script>
    function realtimeClock() {

        var rtClock = new Date();

        var hours = rtClock.getHours();
        var minutes = rtClock.getMinutes();
        var seconds = rtClock.getSeconds();

        var amPm = ( hours < 1) ? "AM" : "PM";

        hours = (hours > 12) ? hours - 12 : hours;

        hours = ("0" + hours).slice(-2);
        minutes = ("0" + minutes).slice(-2);
        seconds = ("0" + seconds).slice(-2);

        document.getElementById('clock').innerHTML =
        hours + " : " + minutes + " : " +  seconds + " " + amPm;
        var t = setTimeout(realtimeClock, 500);
    }

    // confirm logout
		$('#logout').click(function(e) {
			e.preventDefault();
			if(confirm('Are you sure you want to logout?')){
				window.location.href = "../includes/logout.php";
			}
		});
</script>

</body>
</html>
