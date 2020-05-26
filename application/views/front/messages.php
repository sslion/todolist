<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<table class=' table table-hover table-condensed '> 
<!-- <table class=' table table-striped table-hover table-condensed '> -->
	<tbody>
	<? foreach($messages as $item) 
    	{ ?>
			<tr id="tr<?=$item->id;?>"><td>
						<? echo $item->mess_data." ".$item->mess_ph." ".$item->mess_type." " .$item->mess_ps." ".$item->date; ?>
			</td></tr>
			<? } ?>
    </tbody></table>
