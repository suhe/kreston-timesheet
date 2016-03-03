<?php //echo number_format(substr('2010-05-06',5,2));?>

<div id="search">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
</div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>overtime/admin/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>overtime/admin/index">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
          <?php echo $this->session->flashdata('message'); ?>

<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="5%">#</th>
              <th>Date</th>	
              <th>Job Desc</th>
              <th>Client Name</th>
              <!--<th>Time</th>-->
              <th>Time (From - To )</th>
              <th>Overtime</th>
              <th>Overtime App</th>
              <th >App (Charge)</th>
              <th >App (Manager)</th>
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
            <?php foreach($records as $rec):?>
              <form name="form1"  action="<?php echo base_url();?>overtime/admin/aproval/" method="POST">
               <tr>
               <td><?php echo $no;?></td>
               <td>
                 <input type="checkbox" name="code" id="code" value="<?php echo $rec['code'];?>" checked="checked" />
                 <input type="hidden" name="date" id="date" value="<?php echo $rec['date'];?>" />
               </td>
               <td><?php echo indo_tgl($rec['date']);?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td align="center"><?php echo $rec['time_1'].'-'.$rec['time_2'];?></td>
               <td align="right"><?php echo $rec['over_time'];?></td>
               <td align="right"><?php echo $rec['over_time_app'];?></td>
               <td align="center">
                   <?php if($rec['over_charge']=="yes") {?>
                        <select name="ov_charge" id="ov_charge">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    
                    <?php } else { ?>
                        <select name="ov_charge" id="ov_charge">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    <?php } ?> 
                    <br />
                    <input type="submit" value="GO" style="cursor: pointer;"  />
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
               <td>Total</td>
               <td align="right"><?php echo number_format($trans,2);?></td>
               <td></td>
               <td></td>
              </tr>
          </tbody>
        </table>
    
       
 <br />      
        
        


   				