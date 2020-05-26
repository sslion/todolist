<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	.ag_info {
		border-radius: 5px;
		border: 1px solid #aaa;
		background-color: #eee;
		position: relative;
		font-family: Tahoma;
		font-size: 10pt;
		min-height: 150px;
	}
	
	.logo {
		width: 150px;
		position: relative;
		margin: 5px;
		top: 0px;
		left: 0px;
	}
	
	.ag_info_details {
		position: absolute;
		margin: 5px;
		top: 0px;
		left: 155px;
	}
	
	.ag_name {
		//border: 1px solid #aaa;
		position: absolute;
		top: 0px;
		left: 0px;
		font-weight: bold;
	}
	
	.ag_details {
		//border: 1px solid #aaa;
		position: relative;
		top: 24px;
		left: 0px;
	}
	.ag_details span{
		font-weight: bold;
	}	
	
	.ag_details p{
		margin: 0 0 5px;
	}
	
	.podrobno {
		position: absolute;
		right: 5px;
		bottom: 0px;
	}
	.podrobno a {
		cursor: pointer;
		text-decoration: none;
	}
	.podrobno a:hover {
		//text-decoration: none;
	}
</style>

<section class="section">
<table class=' table table-hover table-condensed '> 
<!-- <table class=' table table-striped table-hover table-condensed '> -->
	<tbody>
	<? foreach($agency as $item) 
    	{ ?>
			<tr id="tr<?=$item->id;?>" onclick="show_details('<?=$item->id;?>');">
			<? if($item->logo != ""){$logo = '/asets/images/logos/'.$item->logo;} else {$logo = '/asets/images/no_logo.jpg';} ?>

			<script >
			detl[<?=$item->id;?>]= {
				name:"<?=addslashes($item->name);?>",
				city:"<?=trim($item->city);?>",
				adress:"<?=$item->adress;?>",
				phone:"<?=$item->phone;?>",
				contact:"<?=$item->contact;?>",
				email:"<?=$item->email;?>",
				about:"<?=addslashes($item->about);?>",
				logo:"<?=$logo;?>"
			};
			</script>
			
			<td>
				<div class="ag_info">
					<img class="logo" src="<?=$logo;?>">
					<div class="ag_info_details">
						<span class="ag_name"><?=$item->name;?></span>
						<div class="ag_details">
							<p><span >Адрес: </span> <?=$item->city;?>, <?=$item->adress;?></p>
							<p><span >Телефон: </span> <?=$item->phone;?></p>
							<p><span >Контакт: </span> <?=$item->contact;?></p>
							<p><span >Email: </span> <?=$item->email;?></p>
							<p><span >Описание: </span> <?=$item->about;?></p>					
					</div>
					</div>
					<div class="podrobno"><a>Подробная информация</a></div>
				</div>
			</td>
			</tr>
<? 		} ?>
    </tbody></table>
</section>
	<script >
		function show_details() {}
	</script>