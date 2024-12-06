<!-- JAVASCRIPT -->
<script src="{{ asset('/public/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('/public/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{ asset('/public/assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ asset('/public/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('/public/assets/libs/node-waves/node-waves.min.js')}}"></script>
<script>
	$(document).ready(function() {
    setTimeout(function() {
        $('.flash-message').fadeOut('slow');
    }, 3000);  // Hide after 3 seconds
});

</script>
<script>
    $('#change-password').on('submit',function(event){
        event.preventDefault();
        var Id = $('#data_id').val();
        var current_password = $('#current-password').val();
        var password = $('#password').val();
        var password_confirm = $('#password-confirm').val();
        $('#current_passwordError').text('');
        $('#passwordError').text('');
        $('#password_confirmError').text('');
        $.ajax({
            url: "{{ url('update-password') }}" + "/" + Id,
            type:"POST",
            data:{
                "current_password": current_password,
                "password": password,
                "password_confirmation": password_confirm,
                "_token": "{{ csrf_token() }}",
            },
            success:function(response){
                $('#current_passwordError').text('');
                $('#passwordError').text('');
                $('#password_confirmError').text('');
                if(response.isSuccess == false){
                    $('#current_passwordError').text(response.Message);
                }else if(response.isSuccess == true){
                    setTimeout(function () {
                        window.location.href = "{{ route('admin.dashboard') }}";
                    }, 1000);
                }
            },
            error: function(response) {
                $('#current_passwordError').text(response.responseJSON.errors.current_password);
                $('#passwordError').text(response.responseJSON.errors.password);
                $('#password_confirmError').text(response.responseJSON.errors.password_confirmation);
            }
        });
    });
</script>

@yield('script')

<!-- App js -->
<script src="{{ asset('/public/assets/js/app.min.js')}}"></script>
<script>
function delete_confirmation(link="http://www.google.com", text="You won't be able to revert this!", btntxt = "delete")
	{
		Swal.fire({
			title: 'Are you sure?',
			text: text,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: btntxt
		}).then((result) => {
			if (result.isConfirmed) {
				window.location = link;
			}
		})
	}
</script>
<script type="text/javascript">

	var Toast = Swal.mixin({
		toast: true,
		position: 'top',
		showConfirmButton: false,
		timer: 3000
	});

	function toast_error(message){
		toastr.error(message)
	}

	function toast_success(message){
		toastr.success(message)
	}

	function toast_info(message){
		toastr.info(message)
	}

	function sweet_alert_info(message)
	{
		Toast.fire({
			icon: 'info',
			title: message
		});
	}
</script>
@if(session('success'))
<script type="text/javascript">
	toast_success("{{session('success')}}")
</script>
@endif

@if(session('error'))
<script type="text/javascript">
	toast_error("{{session('error')}}")
</script>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<script type="text/javascript">
	toast_error("{{$error}}")
</script>
@endforeach
@endif
@yield('script-bottom')
