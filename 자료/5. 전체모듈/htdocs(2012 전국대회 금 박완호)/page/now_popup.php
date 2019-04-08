<?php

	// DB ���� & ���̺귯��
	include_once("{$_SERVER['DOCUMENT_ROOT']}/include/dbcon.php");
	include_once("{$_SERVER['DOCUMENT_ROOT']}/include/lib.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- Html Start -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<!-- Head Start -->
<head>
<!-- Title -->
<title> ������ ���� </title>
<meta name="generator" content="editplus" />
<meta http-equiv="Content-Type" content="text/html; charste=euc-kr" />
<meta name="author" content="WanHo Park" />
<meta name="keywords" content="<?php echo $meta_keywords ?>" />
<meta name="description" content="<?php echo $meta_description ?>" />
<!-- Css, Js, Flash, Print -->
<link rel="stylesheet" type="text/css" href="/common/css/common.css" />
<link rel="stylesheet" type="text/css" href="/common/css/sub.css" />
<link rel="stylesheet" type="text/css" href="/common/css/print.css" media="print" />
<script type="text/javascript" src="/common/js/common.js"></script>
<script type="text/javascript" src="/common/js/flash.js"></script>
<style type="text/css">
	
	body { background:none }
	.bottom_popup a {  color:#fff; font-weight:bold; margin-top:10px; margin-left:10px; margin-right:10px }
	img { z-index:0; position:relative }
	.bottom_popup {  z-index:10; background:url(/img/bg_popup.png); position:absolute; bottom:0px; left:0px; height:30px; width:100% }

</style>
<script type="text/javascript">

	function setCookie() {
		opener.document.forms['popup_frm'].submit();
		window.close();
	}

</script>
</head>
<!-- // Head End -->
<!-- Body Start -->
<body>

	<?php

		$db->table = 'furniture';

		$list_s = "lv='1'";

		$now_popup = $db->fetch("{$list_s} order by rand()");

		echo "<img src=\"/data/uploaded_file/{$now_popup['file_name']}\" title=\"{$now_popup['file']}\" alt=\"{$now_popup['file']}\" style=\"width:320px; height:240px\" />";

		echo "<div class=\"bottom_popup\">";

			echo "<a href=\"javascript:window.close()\" class=\"f_left\" title=\"�ݱ�\" class=\"close\">�ݱ�</a>";

			echo "<a href=\"javascript:setCookie()\" class=\"f_right\" title=\"���� �׸� ����\">���� �׸� ����</a>";

		echo "</div>";

	?>

</body>
<!-- // Body End -->
</html>
<!-- // Html End -->