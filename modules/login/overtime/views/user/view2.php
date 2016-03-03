<?php //echo number_format(substr('2010-05-06',5,2));?>
<div id="search">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
</div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>overtime/user/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>overtime/user/index">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
<?php echo $this->session->flashdata('message'); ?>

<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Date</th>	
              <th>Job Desc</th>
              <th>Client Name</th>
              <!--<th>Time</th>-->
              <th>From - To </th>
              <th>Time</th>
              <th>Approval</th>
			  <th>A</th>
			  <th>B</th>
			  <th>C</th>
			  <th>D</th>
              <th >App (Charge)</th>
              <th >App (Manager)</th>
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
            <?php foreach($records as $rec):?>
<form name="form1"  action="<?php echo base_url();?>overtime/user/saveOvertime/" method="POST">              
               <tr>
               <td><?php echo $no;?></td>
               <td><?php echo $rec['date'];?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td align="center"><?php echo $rec['time_1'].'-'.$rec['time_2'];?></td>
               <td align="right">
                 <input type="text" name="over" style="width:20px;margin:0;padding:2;text-align: right;" value="<?php echo $rec['over_time'];?>" />
                 <input type="hidden" name="code"  value="<?php echo $rec['id'];?>" />
                 <input type="hidden" name="date"  value="<?php echo $rec['date'];?>" />
                 <input type="hidden" name="time1"  value="<?php echo $rec['time_1'];?>" />
                 <input type="hidden" name="time2"  value="<?php echo $rec['time_2'];?>" />
                 <input type="submit" name="submit" style="display: none;" />
               </td>
                <td align="right"><?php echo $rec['over_time_app'];?></td>
				<td align="right"><?php echo $rec['x1'];?></td>
			   <td align="right"><?php echo $rec['x2'];?></td>
			   <td align="right"><?php echo $rec['x3'];?></td>
			   <td align="right"><?php echo $rec['x4'];?></td>
               <td align="center">
                   <?php if($rec['over_charge']=="yes") {?>
                        <img src="<?php echo base_url().$rec['over_charge_sign'];?>" class="sign left" width="80" height="20" />
                    <?php } else { ?>
                        -
                    <?php } ?> 
               </td>
               <td align="center">
                 <?php if($rec['over_manager']=="yes") {?>
                        <img src="<?php echo base_url().$rec['over_manager_sign'];?>" class="sign left" width="80" height="20" />
                    <?php } else { ?>
                        -
                    <?php } ?>
               </td>
               </tr>
                </form> 
               
             <?php $no++;?>  
            <?php endforeach;?>
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
			   <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
			   <td></td>
               <td></td>
               <td></td>
               <td></td>
              </tr>
          </tbody>
        </table>
       
       
        
        


   				