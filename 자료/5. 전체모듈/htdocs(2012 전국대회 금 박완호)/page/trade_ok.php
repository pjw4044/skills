<?php

	// 테이블 선택
	$db->table = 'trade';

	// 액션 값 유무 확인
	if(isset($_POST['action'])) {

		switch($_POST['action']) {

			case 'insert' :
				// 필수기입사항 검사
				access(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']),'필수기입사항이 누락되었습니다.');
				$_POST['parent'] = $_POST['idx'];
				$cancel .= "idx/";
				$msg = '가구대여신청을 하였습니다.';
				$url = "{$get_page}";
				if($sidx == 'search' || $sub['type'] == 'search') $url = "{$_GET['param']}";
			break;

			case 'update' :
				// 필수기입사항 검사
				access(isset($_POST['idx']),'필수기입사항이 누락되었습니다.');
				access($trade = $db->fetch("idx='{$_POST['idx']}'"),'정보를 불러오지 못하였습니다.');
				if($trade['lv'] == '2') {
					$msg = '승인하였습니다.';
					$db->update("date = now() where idx='{$_POST['idx']}'");
				}
				if($trade['lv'] == '1') $msg = '반납하였습니다.';
				if($trade['lv'] == '0') $msg = '반납확인하였습니다.';
				$url = "{$get_page}";
				$db->update("lv = lv - 1 where idx='{$trade['idx']}'",'trade');
				if($trade['lv'] == '0') $db->delete("idx='{$_POST['idx']}'");
				alert($msg,$url);
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

		$cancel .= "action/year/month/day/";
		$column = $db->get_column($_POST,$cancel);
		$db->$_POST['action']("{$column} {$add_sql}");
		alert($msg,$url);

	}

?>