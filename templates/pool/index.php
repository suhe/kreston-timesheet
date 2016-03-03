<html>
<head>
<title><?php echo $title;?></title>
<link  rel="stylesheet" href="<?php echo base_url();?>templates/pool/style.css"  type="text/css"/>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="title">
                <div class="titleLap"><h1></h1></div>
                <div class="titleLap"><h2><br /><br /><br />POOL SUMMARY</h2></div>
                <div class="clear"></div>
            </div>
            
            <div class="title">
                <div class="name"><!--NAME : <?php echo $name; ?>--></div>
                <div class="no"><!--NAMESTAFF NUMBER : <?php echo $no; ?>--></div>
                <div class="periode"><?php echo $periode; ?></div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="menu total2">
                <div class="codeStaff">Staff No</div>
                <div class="codePro">Activity</div>
				<div class="total">Hours</div>
				<div class="transp" align="right">Transportation</div>
				<div class="clientPro">Client Name</div>
				<div class="namePro">Staff Name</div>
				<div class="codePro">Nickname</div>
                <div class="total">Pos</div>
				<div class="periode2">Periode</div>
                
                
                <div class="clear"></div>
        </div>
        
    <!-- Start TRANSPORT -->
    
   <?php foreach($records as $rec): ?>     
         <div class="content contol">
                <div class="codeStaff"><?php echo $rec['staff_no']; ?></div>
				<div class="codePro"><?php echo $rec['code']; ?></div>
				<div class="total" align="right"><?php echo $rec['time']; ?></div>
				<div class="transp" align="right"><?php  echo number_format($rec['transp'],2); ?></div>
				<div class="clientPro"><?php echo $rec['name']; ?></div>
				<div class="namePro"><?php echo $rec['staff_name']; ?></div>
				<div class="codePro"><?php echo $rec['nickname']; ?></div>
                <div class="total"><?php echo $rec['pos_code']; ?></div>
				
				<div class="periode2" ><?php echo $rec['tr_periode']; ?></div>
				
                
                <div class="clear"></div>
        </div>
   <?php endforeach;?>		
		
           
		        
        
				
       </div>
        
		
                       
    
</body>
</html>