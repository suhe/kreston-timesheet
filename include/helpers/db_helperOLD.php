<?php
	function getTimeReport($daycode,$day){
		$CI =& get_instance();
		$sql = " SELECT time FROM josh_details_day_tr WHERE code='".$daycode."' and DAY(date)=".$day." " ;
		$Q = $CI->db->query($sql);
		$row = $Q->row_array();
		if($row)
		  $time = $row['time'];
		else
		  $time = '';
        return $time;		  
	}
	
	function getOverTimeReport($daycode,$day){
		$CI =& get_instance();
		$sql = " SELECT over_time FROM josh_details_day_tr WHERE code='".$daycode."' and DAY(date)=".$day." " ;
		$Q = $CI->db->query($sql);
		$row = $Q->row_array();
		if($row)
		  $time = $row['over_time'];
		else
		  $time = '';
        return $time;		  
	}
	
	function digitTwo($num) {
		if($num<=9)
			$num = '0'.$num;
		return $num;	
	}
	
	function overtime_counter($num){
		$data = array();
		for($i=$num;$i>=0;$i--){
			$data[$i] = $i;
		}
		return $data;
	}
	
	
	
	function weekdayovertime(){
		$data = array(
		);
		$data[] = '-';
		for($i=20;$i<=24;$i++){
			$data[$i.':00'.':00'] = $i.':00'.':00';
		}
		for($i=1;$i<=9;$i++){
			$data['0'.$i.':00'.':00'] = '0'.$i.':00'.':00';
		}
		return $data;
	}
	
	function weekendovertime(){
		$data = array(
		);
		$data[] = '-';
		for($i=10;$i<=24;$i++){
			$data[$i.':00'.':00'] = $i.':00'.':00';
		}
		return $data;
	}
	
	function checkholiday($year,$month,$day){
		/** check holiday **/
		$CI =& get_instance();
		$tanggal = $year.'-'.$month.'-'.$day;
		$sql = "SELECT date_h as day FROM josh_holiday WHERE date_h='$tanggal'";	
		$Q =$CI->db->query($sql);
		$checkholiday = $Q->row_array();
		
		/** check weekend **/
		$query = "SELECT datediff('$tanggal', CURDATE()) as day ";
		$Q=$CI->db->query($query);
		$row=$Q->row_array();
		$weekend  = mktime(0, 0, 0, date("m"), date("d")+$row['day'],date("Y"));
		$dayname = date("l", $weekend);
		//echo $dayname;
		if(($dayname == 'Saturday') || ($dayname == 'Sunday') || (count($checkholiday)>0))
			$data = 'Weekend';
		else
			$data = 'Weekday';
		return $data;	
	}