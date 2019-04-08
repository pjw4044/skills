/* 링크 */
function link(url) {
	window.location.href = url;
}

/* 메뉴 보기 */
function depView(Idx,Num) {
	for(var i = 1; i <= Num; i++) {
		document.getElementById('dep2_'+i).style.display = 'none';
	}
	document.getElementById('dep2_'+Idx).style.display = 'inline';
}

/* 폰트 사이즈 조절 */
var size = 100;
function zoom(n) {
	var content = document.getElementById('cont_area');
	size = n == 100 ? 100 : size + n;
	content.style.fontSize = size + '%';
}

/* 정규식 검사 */
function regChk(obj) {
	var reg = null;
	var msg = 'true';
	switch(obj.name) {
		case 'id' :
			reg = new RegExp(/^[a-zA-Z0-9]{4,16}$/);
			if(reg.test(obj.value) === false) msg = '아이디는 4~16글자 사이의 영문과 숫자의 조합으로 입력해주세요.';
		break;
		case 'key' :
			var member = document.getElementById('member_lv');
			if(member.value) {
				if(obj.value.length == 0) msg = '검색어를 입력해주세요.';
			}
		break;
		case 'pw' :
			if(obj.value.length < 4) msg = '비밀번호는 최소 4자 이상입니다.';
		break;
		case 'name' :
			reg = new RegExp(/^[가-힣]{1,}$/);
			if(reg.test(obj.value) === false) msg = '이름은 순한글로 입력해주세요.';
		break;
		case 'email' :
			reg = new RegExp(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{1,}$/);
			if(reg.test(obj.value) === false) msg = '이메일 양식에 맞게 입력해주세요.';
		break;
		default :
			if(obj.value.length == 0) msg = obj.title + '을(를) 입력해주세요.';
		break;
	}
	return msg;
}

/* 폼 값 검사 */
function frmChk(frm) {
	var arg = null;
	var argLen = arguments.length - 1;
	isOk = new Array();
	for(var i = argLen; i >= 1; i--) {
		arg = arguments[i];
		isOk[arg] = regChk(frm[arg]);
		if(isOk[arg] != 'true') {
			frm[arg].focus();
			frm[arg].style.backgroundColor = '#fee';
		} else {
			frm[arg].style.backgroundColor = '';
		}
	}
	for(var i = 1; i <= argLen; i++) {
		arg = arguments[i];
		if(isOk[arg] != 'true') {
			alert(isOk[arg]);
			return false;
		}
	}
}

/* 폼 전송 */
function frmSubmit(frm,idx,config) {

	var frm = document.forms[frm];

	if(config) {

		frm.idx.value = idx;
		frm.submit();

	} else if(confirm('정말로 실행하시겠습니까?')) {

		frm.idx.value = idx;
		frm.submit();

	}

}