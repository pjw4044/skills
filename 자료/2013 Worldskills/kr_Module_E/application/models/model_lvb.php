<?php
class Model_lvb extends CI_Model{
	public $line_id;
	function login_chk(){
		if(U2 == '' ){
			if($this->user_id == 'logout'){
				$this->re(HOME.'line');
			}
		}else if(U2 != ''){
			if($this->user_id == 'login'){
				$this->re(HOME);
			}
		}
	}

	function a($name,$url){
		return '<li><a href="'.HOME.$url.'">'.$name.'</a></li>';
	}

	function submenu(){
		$data = '';
		switch(U2){
			case "line":
				$data .= $this->a('create line',U2.'/create');
				$data .= $this->a('manage line',U2.'/manage');
				$data .= $this->a('List line',U2.'/list');
			break;
			case "vehicle":
				$data .= $this->a('create vehicle',U2.'/create');
				$data .= $this->a('manage vehicle',U2.'/manage');
			break;
			case "station":
				$data .= $this->a('create station',U2.'/create');
				$data .= $this->a('manage station',U2.'/manage');
			break;
			case "driver":
				$data .= $this->a('create driver',U2.'/create');
				$data .= $this->a('manage driver',U2.'/manage');
			break;
			case "line_vehicle":
				$data .= $this->a('add vehicle',U2.'/create/'.U4);
			break;
			case "line_station":
				$data .= $this->a('add station',U2.'/create/'.U4);
			break;
		}
		return $data;
	}

	function re($url=FORM){
		redirect($url);
	}

	function back($name){
		$_SESSION["$name"] = true;
		$this->re();
		exit;
	}

	function data(){
		$line_list = $this->line_list();
		$data ="Line Name\n";
		foreach($line_list as $val){
			$data .= $val['code']."\n";
		}
		return $data;
	}

	function login_ok(){
		$res = $this->query('select * from `user` where login=? and password=?',array($_POST['login'],md5($_POST['password'])));
		$row = $res->row_array();
		if($res->num_rows() > 0){
			$_SESSION['user_id'] = $this->user_id;
			$this->re(HOME.'line/manage');
		}else{
			$this->re();
		}
	}

	function query($sql=false,$arr=false){
		return $this->db->query($sql,$arr);
	}

	function rowlist($res){
		$rowlist = array();
		foreach($res->result_array() as $row){
			$rowlist[] = $row;

		}
		return $rowlist;
	}

	function line_list($id=false){
		$rowlist = $arr = array();
		$sql = " select *,date_format('%H:%i',start_time_operation) as start_time,date_format('%H:%i',end_time_operation) as end_time from `line` ";
		if($id){
			$sql .= " where id=? ";
			$arr[] = $id;
		}
		$res = $this->query($sql,$arr);
		if($id){
			$rowlist = $res->row_array();
		}else{
			foreach($res->result_array() as $row){
				$row['vehicle_list'] = $this->vehicle_list(false,$row['id']);
				$row['station_list'] = $this->station_list(false,$row['id']);
				$row['start_station'] = $this->station_list($row['start_time_operation']);
				$row['end_station'] = $this->station_list($row['end_time_operation']);
				$rowlist[] = $row;
			}
		}
		return $rowlist;
	}

	function vehicle_list($unit_id=false,$id=false,$type=false){
		$rowlist = $arr = array();
		$sql = ' select * from `vehicle` ';
		if($type){
			$row = $this->line_list($id);
			$sql .= ' where line_id="" and type=? ';
			$arr[] = $row['type'];
		}else if($id){
			$sql .= ' where line_id=? ';
			$arr[] = $id;
		}else if($unit_id){
			$sql .= ' where id=? ';
			$arr[] = $unit_id;
		}
		$res = $this->query($sql,$arr);
		if($unit_id){
			$rowlist = $res->row_array();
		}else{
			$rowlist = $this->rowlist($res);
		}
		return $rowlist;
	}

	function station_list($unit_id=false,$id=false,$type=false){
		$rowlist = $arr = array();
		$sql = ' select * from `station` ';
		if($type){
			$sql .= ' where line_id="" ';
			$arr[] = $id;
		}else if($id){
			$sql .= ' where line_id=? ';
			$arr[] = $id;
		}else if($unit_id){
			$sql .= ' where id=? ';
			$arr[] = $unit_id;
		}
		$res = $this->query($sql,$arr);
		if($unit_id){
			$rowlist = $res->row_array();
		}else{
			$rowlist = $this->rowlist($res);
		}
		return $rowlist;
	}

	function driver_list($unit_id=false,$id=false,$type=false){
		$rowlist = $arr = array();
		$sql = ' select * from `driver` ';
		if($type){
			$sql .= ' where vehicle_id!=? ';
			$arr[] = $id;
		}else if($id){
			$sql .= ' where vehicle_id=? ';
			$arr[] = $id;
		}else if($unit_id){
			$sql .= ' where id=? ';
			$arr[] = $unit_id;
		}
		$res = $this->query($sql,$arr);
		if($unit_id){
			$rowlist = $res->row_array();
		}else{
			$rowlist = $this->rowlist($res);
		}
		return $rowlist;
	}

	function line_type(){
		$arr = array('Tram'=>'Tram','Bus'=>'Bus','Nightliner'=>'Nightliner','Regionalbus'=>'Regionalbus');
		return $arr;
	}
	function line_unit_action($id=false,$unit_id=false){
		$where =array('line_id'=>$id);
		$data ='';
		$name = str_replace('line_','',U2);
		$name = str_replace('vehicle_','',$name);
		switch(U3){
			case "create":
				if($name == 'vehicle'){
					$row = $this->vehicle_list(false,$id);
					if(sizeof($row) == 10){
						$this->re(HOME.U2.'/manage/'.$id);
						exit;
					}
					$this->db->update('vehicle',array('line_id'=>$id),array('id'=>$_POST['vehicle_id']));
				}else if($name == 'station'){
					$this->db->update('station',array('line_id'=>$id),array('id'=>$_POST['station_id']));

				}else if($name == 'driver'){
				}
			break;
			case "delete":
				if($name == 'vehicle'){
					$this->db->update('vehicle',array('line_id'=>''),array('id'=>$unit_id));
				}else if($name == 'station'){
					$this->db->update('station',array('line_id'=>''),array('id'=>$unit_id));
				}else if($name == 'driver'){
				}
			break;
		}
		$this->re(HOME.U2.'/manage/'.$id);
		exit;
	}

	function unit_action($id=false){
		$where =array('id'=>$id);
		$data = '';
		$name = str_replace('line_','',U2);
		$name = str_replace('vehicle_','',$name);
		switch(U3){
			case "modify":
				if($name == 'line'){
					$row = $this->line_list($id);
					if($row['type'] != $_POST['type']){
						$this->db->update('vehicle',array('line_id'=>''),array('line_id'=>$id));
					}
				}
			case "create":
				switch($name){
					case "line":
						$data = $this->get_data('code,start_time_operation,end_time_operation,type');
						if($_FILES['img']['tmp_name'] != ''){
							$tmp_name = $_FILES['img']['tmp_name'];
							$file_name = $_FILES['img']['name'];
							move_uploaded_file($tmp_name,'uploaded_files/'.$file_name);
							$data['map'] = $file_name;
						}
					break;
					case "vehicle":
						$data = $this->get_data('name,capacity,type');
					break;
					case "station":
						$data = $this->get_data('name');
					break;
					case "driver":
						$data = $this->get_data('name,birth_date,email,phone,avatar,type');

						if($_FILES['img']['tmp_name'] != ''){
							$tmp_name = $_FILES['img']['tmp_name'];
							$file_name = $_FILES['img']['name'];
							move_uploaded_file($tmp_name,'uploaded_files/'.$file_name);
							$data['avatar'] = $file_name;
						}
					break;
				}
			break;
			case "delete":
			break;
		}

		$this->action($data,$where);
		$this->re(HOME.U2.'/manage');
		exit;
	}

	function action($data=false,$where=false){
		switch(U3){
			case "create": $this->db->insert(U2,$data); break;
			case "modify": $this->db->update(U2,$data,$where); break;
			case "delete": $this->db->delete(U2,$where); break;
		}
	}

	function get_data($name){
		$arr_name = explode(',',$name);
		$data = array();
		foreach($arr_name as $val){
			$data["$val"] = $_POST["$val"];
		}
		return $data;
	}
}
?>