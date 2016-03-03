<?php 
/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+11,$row,$xx=$x1+$x2+$x3+$x4);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+11,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+12,$row,$salary_meal=$rec['over_meal'] * $rec['meal']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+12,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$xx1=$x1 * 1.5;
        $xx2=$x2 * 2;
        $xx3=$x3 * 3;
        $xx4=$x4 * 4;
        $xtot=($rec['hour_salary'] * $xx1) + ($rec['hour_salary'] * $xx2) + ($rec['hour_salary'] * $xx3) + ($rec['hour_salary'] * $xx4);  
        $salary_overtime=$xtot;
			  
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+13,$row,$salary_overtime + $salary_meal);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+13,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$sql="SELECT COUNT(DISTINCT(jddt.date)) as acc FROM josh_details_day_tr jddt,josh_details_tr jdt WHERE jddt.code=jdt.day_code AND jdt.tr_code='".$rec['tr_code']."'   ";
        $q=$this->db->query($sql);
        $row=$q->row_array();
        $day=$row['acc'];
        //$tday=$tday+$day;
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+14,$row,$day);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+14,$row)->applyFromArray($styleArray);
        
		/* Cust Name */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+15,$row,$rec['transport']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+15,$row)->applyFromArray($styleArray);
        
		
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+16,$row,$salary_transp=$rec['transport'] * $day);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+16,$row)->applyFromArray($styleArray);
        
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+17,$row,$salary_alow_transp=$rec['transport2']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+17,$row)->applyFromArray($styleArray);
       
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+18,$row,$ad=$rec['adjust']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+18,$row)->applyFromArray($styleArray);
        
		/* Reimbust */
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+19,$row,$debt=$rec['debt']);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+19,$row)->applyFromArray($styleArray);
        
		/* Reimbust */
		$this_periode=($salary_half +  $allow + $allow_2 + $salary_overtime + $salary_meal + $salary_transp + $salary_alow_transp + $ad)- $debt;  
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col+20,$row,$this_periode);
        $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col+20,$row)->applyFromArray($styleArray);
        