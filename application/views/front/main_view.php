<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

<link href="/asets/css/jquery-ui.css" rel="stylesheet">
<link href="/asets/css/jquery-ui.theme.css" rel="stylesheet">
<script src="/asets/js/jquery.js"></script>
<script src="/asets/js/jquery-ui.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="extjs/resources/css/ext-all.css">
<script type="text/javascript" src="extjs/ext-all.js"></script>
<script type="text/javascript" src="extjs/locale/ext-lang-ru.js"></script> -->

<link rel="stylesheet" href="/asets/css/styles.css" type="text/css">

 <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="/asets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<title>Твое право</title>

</head>
<body>

<script src="/asets/bootstrap/js/bootstrap.min.js"></script>
<div clas="main_wrapper" style="width: 100%;height: 100%;margin:0;padding: 0;">
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="/favicon.ico" style="display:inline-block; margin-right:10px; margin-top:-10px; margin-left:-10px; heidht:40px; width:40px;"><span style="vertical-align: top;">Твое право</span></a>
    </div>
	<? $this->load->view('mainmenu'); ?>
	</div>
</nav>

<!-- Start modal -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<img style="display:inline-block; vertical-align: middle; width:24px;heigth:24px;" src="/favicon.ico"> 
				<div style="vertical-align:middle;display:inline-block;width: 100%;margin-right: -40px;padding-right: 40px;">
					<button type="button" class="close" style="float: right;" data-dismiss="modal" aria-hidden="false">X</button>
					<h4 class="modal-title" style="padding-left: 10px;"> Войти в Личный кабинет</h4>
				</div>
			</div>
			<div class="modal-body" style="color: #ccc;">
					<form id="login-form" class="form-horizontal" method="POST" action="<?=site_url('user/login/');?>">
						<div class="form-group"> 
							<label for="identity" class="control-label col-sm-4">Логин</label>
							<div class="col-sm-8"> 
								<input type="text" class="form-control input-sm" id="identity" placeholder="Введите Ваш логин"> 
							</div>
						</div>	
						<div class="form-group"> 
							<label for="password" class="control-label col-sm-4">Пароль</label>
							<div class="col-sm-8"> 
								<input type="password" class="form-control input-sm " id="password" placeholder="Введите пароль"> 
							</div>
						</div>	
						<div class="form-group" > 
							<label for="remember" class="control-label col-sm-4"></label>
							<div class="col-sm-8"> 
								<input type="checkbox"  name="remember" value="checked"> <b> Запомнить меня</b>
								<input type="submit" value="Войти" name="B1" class="btn btn-primary" style="float:right;" >
							</div>
						</div>			
					<input type="hidden" name="redirect_to" value="http://pager.test/index.php/admin" />
					</form>
					<div id="login-error"></div><div id="login-success"></div>
					<div style="text-align: right;">
					<div class="cssload-jumping">
						<span></span><span></span><span></span><span></span><span></span>
					</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Регистрация</button>
				<button type="button" class="btn btn-default">Забыли пароль?</button>
			</div>
		</div>
	</div>
</div>
<!-- End modal -->

<div class="container">
	<div class="row">
		<div class="col-md-9">
			<?if(isset($content)) echo $content;?>
		</div> 
		<div class="col-md-3">
			<div class="panel panel-success">
				<div class="panel-heading condensed">
							Каталог организаций
				</div> 
				<div class="panel-body">
					<ul class="nav nav-pills nav-stacked" >
						<li><a href="/?pag=agency"> Агентства недвижимости </a></li>
						<li><a href="#"> Застройщики </a> </li>
						<li> <a href="#"> Управляющие компании </a> </li>
						<li> <a href="#"> Оценочные компании </a> </li>
						<li> <a href="#"> Банки </a> </li>
						<li> <a href="#"> Нотариусы </a> </li>
					</ul>
				</div>
			</div>
            <!--
			<div class="panel panel-success">
				<div class="panel-heading">
							Поддержали проект
				</div> 
				<div class="panel-body">
					<div id="donate">
						<a href="">yoga</a>, <a href="">Евген</a>, <a href="">Олег Владимирович</a>, 
						 <a href="">maria</a>, <a href="">OOO Inkom</a>, <a href="">rieltor45</a>
					</div>	
				</div>

			</div> -->
		</div>
	</div>



</div>
<!-- /.container-fluid -->
</div>
<!--
<section class="footer">
	<ul>
		<li><a href="http://pager-forum.eu.pn">Форум</a></li>
		<li><a href="">Партнерская программа</a></li>
		<li><a href="">Оферта</a></li>
		<li><a href="">Реклама на сайте</a></li>
	 	<li><a href="/?setmobile">Мобильная версия</a></li>
	 </ul>
</section>
-->
</body>
</html>
<script>
$(function(){
	$('#login-form').on('submit', function(el){
		el.preventDefault();
		if($('#password').val() !=+ "" &&  $('#identity').val() !== "") {
			$('#login-error').removeClass('show');
			$('#cssload-jumping').addClass('show');
			
			 //alert($('#identity').val());
			$.ajax({
				url: '<?=site_url('/auth/login/')?>',
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
				$('#login-error').html(r).addClass('show');
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