<!DOCTYPE html>
<html lang="en">
<head>
	<title>Вход в личный кабинет1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="/asets/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/asets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="/asets/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="/asets/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="/asets/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/asets/css/util.css">
	<link rel="stylesheet" type="text/css" href="/asets/css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/asets/images/img-01.jpg');">
			<div class="wrap-login100 p-t-80 p-b-30">
				<form class="login100-form validate-form" id="login-form">
					<div class="login100-form-avatar">
						<img src="/asets/images/avatar-01.jpg" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						ТВОЕ ПРАВО
					</span>

					<div id="login-error"></div><div id="login-success"></div>
					<div style="text-align: right;">
						<div class="cssload-jumping">
							<span></span><span></span><span></span><span></span><span></span>
						</div>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Введите логин">
						<input class="input100" type="text" name="identity" id="identity" placeholder="Логин">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Введите пароль">
						<input class="input100" type="password" name="password" id="password" placeholder="Пароль">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Войти
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-80">
						<a href="#" class="txt1">
							Забыли Логин / Пароль?
						</a>
					</div>

					<div class="text-center w-full">
						<a class="txt1" href="#">
							Зарегистрироваться
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
				</form>

			</div>
		</div>
	</div>
	
	<script src="/asets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="/asets/vendor/bootstrap/js/popper.js"></script>
	<script src="/asets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/asets/vendor/select2/select2.min.js"></script>
	<script src="/asets/js/main.js"></script>

</body>
<script>
$(function(){
	$('#login-form').on('submit', function(el){
		el.preventDefault();
		if($('#password').val() !=+ "" &&  $('#identity').val() !== "") {
			$('#login-error').removeClass('show');
			$('#cssload-jumping').addClass('show');
			
			 //alert($('#identity').val());
			$.ajax({
				url: '<?=site_url('/user/login')?>',
				type: 'POST',
				dataType: 'json',
				data: {
					identity: $('#identity').val(),
					password: $('#password').val(),
				},
			})
			.done(function(data) {
				$('юcssload-jumping').removeClass('show');
				if(data.success != undefined) {
					$('#login-success').html(data.success);
					$('#login-success').addClass('show');
					window.location.replace(data.redirect_to);
				}
				if(data.error != undefined) {
					$('#login-error').html(data.error );
					$('#login-error').addClass('show');
				}
				console.log(data);
			})
			.fail(function(o, e, r) {
				console.log("error "+o);
				console.log("error "+e);
				console.log("error "+r);
				$('#login-error').html(r);
				$('#login-error').addClass('show');
			})
			.always(function() {
				console.log("complete");
			});		
		} else {
			$('#login-error').html("<p>Не введен логин/пароль!</p>");
			$('#login-error').addClass('show');
		}
	})
});
</script>
</html>