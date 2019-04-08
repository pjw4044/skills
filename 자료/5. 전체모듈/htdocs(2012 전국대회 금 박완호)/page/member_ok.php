<?php

	// 테이블 선택
	$db->table = 'member';

	// 액션 값 유무 확인
	if(isset($_POST['action'])) {

		if($_POST['pw']) $_POST['pw'] = md5($_POST['pw']);

		switch($_POST['action']) {

			case 'insert' :
				// 필수기입사항 검사
				access(isset($_POST['id']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['email']),'필수기입사항이 누락되었습니다.');
				access(!$db->cnt("id=binary('{$_POST['id']}')"),'이미 등록된 아이디가 있습니다.');
				$msg = '회원가입되었습니다.\r\n로그인페이지로 이동합니다.';
				$url = '/page/member/login/';
			break;

			case 'update' :
			break;

			case 'delete' :
			break;

			case 'login' :
				// 필수기입사항 검사
				access(isset($_POST['id']) && isset($_POST['pw']),'필수기입사항이 누락되었습니다.');
				access($member = $db->fetch("id=binary('{$_POST['id']}')"),'아이디를 확인해주세요.');
				access($member['pw'] == $_POST['pw'],'비밀번호를 확인해주세요.');
				foreach($member as $key=>$val) $_SESSION[$key] = $val;
				$_SESSION['login'] = 'login';
				$msg = '로그인 되었습니다.';
				$url = '/';
				alert($msg,$url);
			break;

		}

		$cancel .= "action/";
		$column = $db->get_column($_POST,$cancel);
		$db->$_POST['action']("{$column} {$add_sql}");
		alert($msg,$url);

	}

?>