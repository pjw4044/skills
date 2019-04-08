
<div class="form">
<?php
echo form_open_multipart(FORM);
echo form_hidden('test','test');

echo '<div class="row">';
echo form_label('name','name');
echo form_input('code',$list['code']);
echo '</div>';

for($i  =0; $i <= 23; $i++){
	$time = $i < 10 ? '0'.$i : $i;
	$time .= ':00:00';
	$arr["$time"] = $time;
}

echo '<div class="row">';
echo form_label('start_time_operation','start_time_operation');
echo form_dropdown('start_time_operation',$arr,$list['start_time_operation']);
echo '</div>';


echo '<div class="row">';
echo form_label('end_time_operation','end_time_operation');
echo form_dropdown('end_time_operation',$arr,$list['end_time_operation']);
echo '</div>';

echo '<div class="row">';
echo form_label('type','type');
echo form_dropdown('type',$line_type,$list['type']);
echo '</div>';

echo '<div class="row">';
echo form_label('map','img');
echo form_upload('img');
echo '</div>';


echo form_submit('Submit','Submit');
echo form_close();
?>
</div><!-- form -->