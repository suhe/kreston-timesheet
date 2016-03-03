<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/transp_summary/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1>TRANSPORT SUMMARY REPORT</h1></div>
                <div class="titleLap"><h2>Eddy Siddharta & Rekan</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">NAME : <?php // echo $name; ?></div>
                <div class="no">STAFF NUMBER : <?php // echo $no; ?></div>
                <div class="periode">PERIODE END : <?php // echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
                <div class="codePro">Job Code</div>
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="transp">M</div>
                <div class="transp">AM</div>
                <div class="transp">S2</div>
                <div class="transp">S1</div>
                <div class="transp">AS</div>
                <div class="transp">TA</div>
                <div class="transp">Total</div>
                <div class="clear"></div>
        </div>
        
       <!-- Start CHARGEABLE HOURS - FIELDWORK -->
   <?php
        $time=0;
        $transport=0;
        //$subtime=0;
        //$subtransport=0;
        $totalover=0;
        $totalover_app=0;
   ?>
   <?php
     $m=0;
     $am=0;
     $s2=0;
     $s1=0;
     $as=0;
     $ta=0;
   ?>    
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="namePro"><?php echo $rec['name']; ?></div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','M');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*
                     $this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $m = $row['transport'];
                     //$m=$time * $rec['M'];
                      
                   ?>
                </div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','AM');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*$this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $am = $row['transport'];
                     //$am=$time * $rec['AM']; 
                   ?>
                </div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','S2');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*$this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */
                     $Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $s2 = $row['transport'];
                     //$s2=$time * $rec['S2'];
                   ?>
                </div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','S1');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*$this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */$Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $s1 = $row['transport'];
                     //$s1=$time * $rec['S1'];
                   ?>
                </div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','AS');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*$this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */$Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $as = $row['transport'];
                     //$as=$time * $rec['AS']; 
                   ?>
                </div>
                <div class="transp">
                  <?php
                     $this->db->select('SUM(transport_chf) as transport');
                     $this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
                     $this->db->join('josh_details_tr jdt','jdt.day_code=jddt.code');                     
                     $this->db->where('jht.tr_code',$rec['tr_code']);
                     $this->db->where('jht.pos_code','TA');
                     $this->db->where('jdt.job_code',$rec['job_code']);
                     /*$this->db->where_not_in('jdt.job_code','NC1001');
                     $this->db->where_not_in('jdt.job_code','NC1002');
                     $this->db->where_not_in('jdt.job_code','NC1003');
                     $this->db->where_not_in('jdt.job_code','NC1004');
                     $this->db->where_not_in('jdt.job_code','NC1005'); 
                     */$Q=$this->db->get('josh_details_day_tr jddt');
                     $row=$Q->row_array();
                     echo $ta = $row['transport'];
                     //$ta=$time * $rec['TA'];
                   ?>
                </div>
                
                
                <div class="transp" align="right"><?php echo number_format($tot=$m + $am + $s2 + $s1 + $as + $ta,2); ?></div>
                
                <div class="clear"></div>
        </div>
        
       <?php endforeach; ?>  
        <!-- Finish -->
        
        <div class="content total2">
                <div class="namePro">GRAND TOTAL</div>
                <div class="codePro" align="center"></div>
                <div class="charge" align="center">
                  
                </div>
                <div class="charge" align="center">
                  
                </div>

                <div class="transp" align="right"> 
                     
                </div>
                
                <div class="transp" align="right"> 
                     <?php echo $totalover; ?>
                </div>
                <div class="transp" align="right"> 
                     <?php echo $totalover_app; ?>
                </div>
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