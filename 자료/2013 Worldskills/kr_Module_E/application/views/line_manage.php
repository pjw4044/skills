<table>
<tbody>
<?php
foreach($list as $unit){
?>
	<tr>
		<td style="border:1px solid #dbdbdb">
		<?php
		$js = ' onclick=" window.location=\''.HOME.U2.'/view/'.$unit['id'].'\'; " ';
		echo form_button('VIEW','VIEW',$js);
		$js = ' onclick=" window.location=\''.HOME.U2.'/modify/'.$unit['id'].'\'; " ';
		echo form_button('Modify','Modify',$js);
		$js = ' onclick=" window.location=\''.HOME.U2.'/delete/'.$unit['id'].'\'; " ';
		echo form_button('Delete','Delete',$js);
		$js = ' onclick=" window.location=\''.HOME.'line_vehicle/manage/'.$unit['id'].'\'; " ';
		echo form_button('Associate Vehicle','Associate Vehicle',$js);
		$js = ' onclick=" window.location=\''.HOME.'line_station/manage/'.$unit['id'].'\'; " ';
		echo form_button('Associate Station','Associate Station',$js).'<br />';
		?>
		Name : <?php echo $unit['code'];?><br />
		start_time_operation : <?php echo $unit['start_time_operation'];?><br />
		end_time_operation : <?php echo $unit['end_time_operation'];?><br />
		Type : <?php echo $unit['type'];?><br />
		Map  <p><?php if(isset($unit['map'])){ echo '<img src="'.UPLOAD.$unit['map'].'" style="width:500px" />';}else{ echo "Do not have date"; } ?></p>
		</td>
	</tr>
<?php
}
?>
</tbody>
</table>