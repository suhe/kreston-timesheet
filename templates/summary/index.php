<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/summary/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1>SUMMARY REPORT</h1></div>
                <div class="titleLap"><h2>Eddy Siddharta & Rekan</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name"><?php // echo $name; ?></div>
                <div class="no"><?php // echo $no; ?></div>
                <div class="periode">PERIODE: <?php  echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
                <div class="codePro">Job Code</div>
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="pos">P</div>
				<div class="pos">SM</div>
				<div class="pos">M</div>
                <div class="pos">AM</div>
                <div class="pos">S2</div>
                <div class="pos">S1</div>
                <div class="pos">AS</div>
                <div class="pos">TA</div>
                <div class="pos">Total</div>
                <div class="transp">Total In Rupiah</div>
                <div class="clear"></div>
        </div>
        
        <?php
            $grandtime=0;
            $grandmoney=0;
            $grandp=0;
            $grandsm=0;
            $grandm=0;
            $grandam=0;
            $grands2=0;
            $grands1=0;
            $grandas=0;
            $grandta=0;
        ?>
        <?php foreach($group as $row): ?>
        <div class="content contol">
                <div class="codePro"></div>
                <div class="namePro"><b><?php echo $row['group_name']; ?></b></div>
                <div class="pos"></div>
				<div class="pos"></div>
				<div class="pos"></div>
                <div class="pos"></div>
                <div class="pos"></div>
                <div class="pos"></div>
                <div class="pos"></div>
                <div class="pos"></div>
                <div class="pos"></div>
                <div class="transp"></div>
                <div class="clear"></div>
        </div>
   <?php
        $data=array();
        $this->db->select('jht.tr_code,jht.periode,jjb.name,jdt.job_code,SUM(jddt.time) as time,SUM(jddt.over_time_app) as over_time,jjb.SP as P,jjb.SM,jjb.SM,jjb.M,jjb.AM,jjb.S2,jjb.S1,jjb.AS,jjb.TA,jjb.SP_time as P_time,jjb.SM_time,jjb.SM_time,jjb.M_time,jjb.AM_time,jjb.S2_time,jjb.S1_time,jjb.AS_time,jjb.TA_time');
        $this->db->join('josh_details_tr jdt','jdt.tr_code=jht.tr_code');
        $this->db->join('josh_job jjb','jjb.code=jdt.job_code');
        $this->db->join('josh_details_day_tr jddt','jddt.code=jdt.day_code');
        $this->db->groupby('jdt.job_code');
        $this->db->where('jht.periode',$id);
        $this->db->where('jjb.gr_id',$row['group_id']);
        $this->db->where_not_in('jdt.job_code','NC1001');
        $this->db->where_not_in('jdt.job_code','NC1002');
        $this->db->where_not_in('jdt.job_code','NC1003');
        $this->db->where_not_in('jdt.job_code','NC1004');
        $this->db->where_not_in('jdt.job_code','NC1005'); 
		$this->db->where_not_in('jdt.job_code','NC1006');
        $this->db->where_not_in('jdt.job_code','NC1007');
        $this->db->where_not_in('jdt.job_code','NC1008');
		$this->db->where_not_in('jdt.job_code','NC1009');
        $this->db->where_not_in('jdt.job_code','NC1010');
		$Q=$this->db->get('josh_head_tr jht');
        $records=$Q->result_array();
   ?>     
       
   <?php
        $time=0;
        $transport=0;
        //$subtime=0;
        //$subtransport=0;
        $totalover=0;
        $totalover_app=0;
   ?>
   <?php
     $p=0;
     $sm=0;
     $m=0;
     $am=0;
     $s2=0;
     $s1=0;
     $as=0;
     $ta=0;
     
     $subtime=0;
     $subp=0;
     $subsm=0;
     $subm=0;
     $subam=0;
     $subs2=0;
     $subs1=0;
     $subas=0;
     $subta=0;
     
     $submoney=0;
   ?>    
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="namePro"><?php echo $rec['name']; ?></div>
                
				<div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.pos_code','P');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010');
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timep = $row['time'] + $row['over_time'];
					 echo '('.$rec['P_time'].')';
                     $subp=$subp + $timep;
                     $p=$timep * $rec['P'];
                      
                   ?>
                </div>
				
				<div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.pos_code','SM');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005');
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010'); 
                     
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timesm = $row['time'] + $row['over_time'];
					 echo '('.$rec['SM_time'].')';
                     $sm=$timesm * $rec['SM'];
                     $subsm=$subsm + $timesm;
                     $sm=$timesm * $rec['SM'];
                      
                   ?>
                </div>
				
				<div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.pos_code','M');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010'); 
                     
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timem = $row['time'] + $row['over_time'];
					 echo '('.$rec['M_time'].')';
                     $m=$timem * $rec['M'];
                     $subm=$subm + $timem;
                     $m=$timem * $rec['M'];
                      
                   ?>
                </div>
                <div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.pos_code','AM');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010'); 
                     
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timeam = $row['time'] + $row['over_time'];
					 echo '('.$rec['AM_time'].')';
                     $am=$timeam * $rec['AM'];
                     $subam=$subam + $timeam; 
                   ?>
                </div>
                <div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.pos_code','S2');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010'); 
                     
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $times2 = $row['time'] + $row['over_time'];
					 echo '('.$rec['S2_time'].')';
                     $s2=$times2 * $rec['S2'];
                     $subs2=$subs2 + $times2;
                   ?>
                </div>
                <div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.pos_code','S1');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005');
					 $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010'); 					 
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $times1 = $row['time'] + $row['over_time'];
					 echo '('.$rec['S1_time'].')';
                     $s1=$times1 * $rec['S1'];
                     $subs1=$subs1 + $times1;
                   ?>
                </div>
                <div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.pos_code','AS');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005');
				     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010');					 
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timeas = $row['time'] + $row['over_time'];
					 echo '('.$rec['AS_time'].')';
                     $as=$timeas * $rec['AS']; 
                     $subas=$subas + $timeas;
                   ?>
                </div>
                <div class="pos">
                  <?php
                     $this->db->select('SUM(time) as time , SUM(over_time_app) as over_time');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                    
                     $this->db->where('jht.pos_code','TA');
                     $this->db->where('jht.periode',$id);
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005');
                     $this->db->where_not_in('jdt.job_code','NC1006');
                     $this->db->where_not_in('jdt.job_code','NC1007');
                     $this->db->where_not_in('jdt.job_code','NC1008');
                     $this->db->where_not_in('jdt.job_code','NC1009');
                     $this->db->where_not_in('jdt.job_code','NC1010');  
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $timeta = $row['time'] + $row['over_time'];
					 echo '('.$rec['TA_time'].')';
                     $ta=$timeta * $rec['TA'];
                     $subta=$subta + $timeta;
                   ?>
                </div>
                
                <div class="pos">
                  <?php echo $tottime=$rec['time'] + $rec['over_time']; ?>
                  <?php $subtime=$subtime + $tottime;?>
                </div>
                
                <div class="transp" align="right">
                <?php echo number_format($tot=$p+ $sm + $m + $am + $s2 + $s1 + $as + $ta,2); ?>
                <?php $submoney=$submoney+$tot; ?>
                </div>
                
                <div class="clear"></div>
        </div>
        
       <?php endforeach; ?>  
        <!-- Finish -->
        
        <div class="content contol">
                <div class="codePro"></div>
                <div class="namePro"><b>SUB TOTAL</b></div>
                <div class="pos"><?php echo $subp; $grandp=$grandp+$subp; ?></div>
				<div class="pos"><?php echo $subsm;$grandsm=$grandsm+$subsm; ?></div>
				<div class="pos"><?php echo $subm; $grandm=$grandm+$subm;?></div>
                <div class="pos"><?php echo $subam;$grandam=$grandam+$subam; ?></div>
                <div class="pos"><?php echo $subs2;$grands2=$grands2+$subs2;?></div>
                <div class="pos"><?php echo $subs1;$grands1=$grands1+$subs1; ?></div>
                <div class="pos"><?php echo $subas;$grandas=$grandas+$subas; ?></div>
                <div class="pos"><?php echo $subta;$grandta=$grandta+$subta; ?></div>
                <div class="pos"><?php echo $subtime;$grandtime=$grandtime+$subtime;?></div>
                <div class="transp" align="right"><?php echo number_format($submoney,2);$grandmoney=$grandmoney+$submoney; ?></div>
                <div class="clear"></div>
        </div>
        
        <?php endforeach; ?>
        
        <div class="content contol">
                <div class="codePro"></div>
                <div class="namePro"><b>GRAND TOTAL</b></div>
                <div class="pos"><?php echo $grandp; ?></div>
				<div class="pos"><?php echo $grandsm; ?></div>
				<div class="pos"><?php echo $grandm; ?></div>
                <div class="pos"><?php echo $grandam; ?></div>
                <div class="pos"><?php echo $grands2; ?></div>
                <div class="pos"><?php echo $grands1; ?></div>
                <div class="pos"><?php echo $grandas; ?></div>
                <div class="pos"><?php echo $grandta; ?></div>
                <div class="pos"><?php echo $grandtime; ?></div>
                <div class="transp" align="right"><?php echo number_format($grandmoney,2); ?></div>
                <div class="clear"></div>
        </div>
        
        <!---
        <div id="keterangan">
            <div class="chargeb">
                
                <div class="ch1">
                     <br />
                     <center>Manager In Charge</center><br/>
                     <center><?php if($manager_signature<>""){ ?><img src="<?php echo base_url().$manager_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /> <?php } ?></center>
                     <center><span class="names"><?php echo $manager_name; ?></span></center>
                     <center class="names">(Manager In Charge)</center>
                </div>
                
                <div class="ch1">
                    <br />
                    <center>HR And GA Manager</center><br/>
                    <center><?php if($hrd_signature<>""){ ?><img src="<?php echo base_url().$hrd_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    <center class="names">(<?php echo $hrd_name;?>)</center>
                </div>
                
                
                <div class="ch1">
                    <br />
                    <center>Accounting</center><br/>
                    <center><?php if($acc_signature<>""){ ?><img src="<?php echo base_url().$acc_signature; ?>" class="sign2" /><?php } else { ?> <br /><br /><br /> <?php } ?></center>
                    
                    <center class="names">(<?php echo $acc_name;?>)</center>
                </div>
                
            </div>
        </div>
        -->
       
       
        </div>
                       
    
</body>
</html>
