
<div class="form">
<?php
echo form_open_multipart(FORM);
echo form_hidden('test','test');
foreach($input as $val){
	echo '<div class="row">';
	echo form_label($val,$val);
	if($val == 'password'){
		echo form_password($val);
	}else if($val == 'img'){
		echo form_upload($val);
	}else{
		echo form_input($val);
	}
	echo '</div>';
}
echo form_submit('Submit','Submit');
echo form_close();
?>
</div><!-- form -->