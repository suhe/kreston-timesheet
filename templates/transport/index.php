<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/transport/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1></h1></div>
                <div class="titleLap"><h2><br /><br /><br />TRANSPORT FORMULIR</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name">NAME : <?php echo $name; ?></div>
                <div class="no">STAFF NUMBER : <?php echo $no; ?></div>
                <div class="periode">PERIODE END : <?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
                <div class="codePro">DATE</div>
                <div class="namePro">CLIENT NAME / PROJECT NAME</div>
                <div class="codePro">Job Code</div>
                <div class="namePro">Location</div>
                <div class="transp">Transport (Rp.)</div>
				<div class="transp">Approval (Rp.)</div>
                <div class="clear"></div>
        </div>
        
    <!-- Start TRANSPORT -->
   <?php
        $transport=0;
		$app=0;
   ?>    
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="codePro"><?php echo indo_tgl($rec['date']); ?></div>
                <div class="namePro"><?php echo $rec['name']; ?></div>
                <div class="codePro"><?php echo $rec['job_code']; ?></div>
                <div class="namePro"><?php echo $rec['location']; ?></div>
                <div class="transp" align="right"><?php echo number_format($rec['transport_chf'],2); $transport=$transport + $rec['transport_chf'] ?></div>
				<div class="transp" align="right">
				<?php
					$this->db->where('tr_code',$rec['tr_code']);
					$Q=$this->db->get('josh_details_tr');
					$row=$Q->row_array();
				?>
				<?php if(($row['staff_approval']=='yes') || ($row['staff_approval2']=='yes')  ): ?> 
				<?php echo number_format($rec['transport_chf'],2); $app=$app + $rec['transport_chf']; ?>
				<?php else:?>
				<?php echo number_format($rec['transport_chf'],2); $app=$app + 0; ?>
				<?php endif;?>
				</div>
                <div class="clear"></div>
        </div>     
   <?php endforeach; ?>  
        <!-- Finish -->
        
        <div class="content total2">
                <div class="codePro"></div>
                <div class="namePro">GRAND TOTAL</div>
                <div class="codePro" align="center"><?php // echo $totaltime;?></div>
                <div class="namePro"></div>
                <div class="transp" align="right"><?php echo number_format($transport,2);?></div>
				<div class="transp" align="right">
				<?php echo number_format($app,2);?>
				</div>
                <div class="clear"></div>
        </div>
        
        
        
        </div>
       
       
       
                       
    
</body>
</html>