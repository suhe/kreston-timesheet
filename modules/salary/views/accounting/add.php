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

<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>salary/accounting/save">
        
        <div id="search">
           <label for="filter">Periode</label>
		   <select name="day">
			  <option value="05">05</option>
			  <option value="20">20</option>
		   </select>
		   <select name="month">
		     <?php for($i=1;$i<=12;$i++){ ?>
			  <?php if($i<=9){ ?>
			  <option value="0<?php echo $i;?>">0<?php echo $i;?></option>
			  <?php } else { ?>
			  <option value="<?php echo $i;?>"><?php echo $i;?></option>
			  <?php } ?>
			  <?php } ?>
		   </select>
		   <select name="year">
			  <?php for($i=2009;$i<=2025;$i++){ ?>
			  <option value="<?php echo $i;?>"><?php echo $i;?></option>
			  <?php } ?>
		   </select>
        </div>
        
        <div id="navigation">
		     <input type='submit' name='button' value="Save All" style="width:100px;cursor:pointer" />
        </div
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
			  <th>#</th>	
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Position</th>
			  <th>Salary/Month</th>
              <th>Meal/OT( > 3 Hour)</th>
              <th>Transport</th>
			  <th>Allowence I</th>
                          <th>Allowence II</th>
              <th>Debt</th>
              <th>Adjust</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
			   <td><input name='no1[]' type='checkbox' value="<?php echo $rec['no'];?>" checked="checked" /></td>
               <td><?php echo $rec['no'];?><input name='no[]' type='hidden' value="<?php echo $rec['no'];?>"/></td>
               <td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <!--<td><?php echo $rec['email'];?></td>-->
               <!--<td><?php echo $rec['city'];?></td>-->
               <td><?php echo $rec['name_p'];?></td>
               
			   <td align="right"><input name='salary[]'  type='text' style="width:65px;text-align:right" value="<?php echo $rec['sal_bas'];?>" /></td>
               <td align="right"><input name='salary2[]' type='text' style="width:65px;text-align:right" value="<?php echo $rec['staff_outmeal'];?>" /></td>
               <td align="right"><input name='salary3[]' type='text' style="width:40px;text-align:right" value="<?php echo $rec['staff_transport'];?>" /></td>
			   <td align="right"><input name='salary4[]' type='text' style="width:60px;text-align:right" value="<?php echo $rec['allow_1'];?>" /></td>
               <td align="right"><input name='salary4_2[]' type='text' style="width:50px;text-align:right" value="<?php echo $rec['allow_2'];?>" /></td>
               <td align="right"><input name='salary5[]' type='text' style="width:60px;text-align:right" value="<?php echo '0';?>" /></td>

<td align="right"><input name='salary6[]' type='text' style="width:60px;text-align:right" value="<?php echo '0';?>" /></td>
               
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
</form>		
        
 
