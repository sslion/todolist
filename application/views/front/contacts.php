<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
<table width="100%" border=0>
	<tr>
		<td valign="top">	
		<div class="panel panel-default">
			<div class="panel-heading">
				Обратная связь
			</div> 
			<div class="panel-body"> 
		<div class="col-xs-3" ><img src="/asets/images/icons/feedback-icon.png">
			<h6><font face="Tahoma" color="#000080">Введите Ваше сообщение и 
		контактную информацию, и наш специалист в кротчайшие сроки свяжется с Вами!</font></h6>
		</div>
		<div class="col-xs-9">
		<form style=" border: 1 solid #000;" class="form-horizontal" method="POST" action="/contacts&act=add">
			<div class="form-group"> 
				<label for="name" class="control-label col-sm-4">Имя</label>
				<div class="col-sm-8"> 
					<input type="text" class="form-control input-sm" id="name" placeholder="Ваше имя"> 
				</div>
			</div>	
			<div class="form-group"> 
				<label for="email" class="control-label col-sm-4">Email</label>
				<div class="col-sm-8"> 
					<input type="email" class="form-control input-sm " id="email" placeholder="E-mail"> 
				</div>
			</div>	
			
			<div class="form-group"> 
				<label for="tema" class="control-label col-sm-4">Тема сообщения</label>
				<div class="col-sm-8"> 
					<input type="text" class="form-control input-sm " id="tema" placeholder="Тема сообщения"> 
				</div>
			</div>	
			<div class="form-group"> 
				<label for="msg" class="control-label col-sm-4">Текст сообщения</label>
				<div class="col-sm-8"> 
					<textarea rows="5" class="form-control input-sm " id="msg" placeholder="Текст сообщения"></textarea>
				</div>
			</div>	
		</form>
		<button type="submit" style="float: right;" class="btn btn-primary">Отправить</button>
		</div>
		</div></div>
		<br>
			<div class="panel panel-default">
			 <div class="panel-heading">
				Наши контакты
				</div> 
				<div class="panel-body"> 
				
			<table border="0"><tr><td width="100px"><img src="/asets/images/icons/contact.jpg"></td><td>

			<a href="mailto:pager-reklama@rambler.ru">pager-reklama@rambler.ru</a> - отдел рекламы<br>
			<a href="mailto:pager-support@rambler.ru">pager-support@rambler.ru</a> - тех. поддержка<br>
			
			141006019 <img src="http://wwp.icq.com/scripts/online.dll?icq=141006019&img=27" border="0" /> - администратор проекта<br>
			</td></tr></table>
			
				</div> 
			</div>

		</td>
	</tr>
</table>
</div>