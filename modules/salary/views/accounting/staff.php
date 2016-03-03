<script src="<?php echo base_url();?>assets/js/main.js" type="text/javascript"></script>
<style>

a{
	text-decoration:none;
	color:red;	
}
p{
	clear:both;
	margin:0;
	padding:.5em 0;
}
pre{
	display:block;
	font:100% "Courier New", Courier, monospace;
	padding:10px;
	border:1px solid #bae2f0;
	background:#e3f4f9;	
	margin:.5em 0;
	overflow:auto;
	width:800px;
}

img{border:none;}

/*  */

#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}

/*  */
</style>

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>salary/accounting/update">
        
        <div id="search">
           <label for="filter">Periode</label>
		   <?php echo $title;?>
           <input name='periode' type='hidden' value="<?php echo $title;?>"/>		   
        </div>
        
        <div id="navigation">
		     <!--<input type='submit' name='button' value="Save All" style="width:100px;cursor:pointer" />-->
			 <a target="_blank" class="button" href="<?php echo base_url();?>salary/accounting/print_out/<?php echo $_SESSION['periode'];?>">Print Preview</a>
        </div
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>	
              <th>No</th>	
              <th>No</th>
			  <th>Name</th>
              <th>Salary</th>
              <th>Salary(Half)</th>
              <th>Salary(Hour)</th>
              <th>Trnsport</th>
              <th>Action</th>
			  
            </tr>
          </thead>
          <tbody>
          <?php 
          $no=1;
          foreach($records as $rec):?>
            <tr>
               <td><?php echo $no;?></td>
               <td><?php echo $rec['staff_no'];?></td>
               <td><?php echo $rec['staff_name'];?></td>
			   <td align="right"><?php echo number_format($rec['basic_salary'],2);?></td>
               <td align="right"><?php echo number_format($rec['bas_salary'],2);?></td>
               <td align="right"><?php echo number_format($rec['hour_salary'],2);?></td>
               <td align="right"><?php echo number_format($rec['transport'],2);?></td>
               <td>
			    <?php if($printer1=='Y'):?> 
                    <a href="<?php echo base_url();?>salary/accounting/print_user/<?php echo $rec['periode'].'/'.$rec['staff_no'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
                <?php endif;?>
			   </td>
            </tr>
             <?php
             $no++; 
             endforeach;
             ?>
          </tbody>
        </table>
</form>		
        
 