<?php //echo number_format(substr('2010-05-06',5,2));?>
<div id="search">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
</div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>transport/user/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>transport/user/index">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
<?php echo $this->session->flashdata('message'); ?>

<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Date</th>	
              <th>Job Code</th>
              <th>Client</th>
              <th>Location</th>
              <th >Transport (Rp.) </th>
              <th >App (Charge)</th>
              <th >App (Manager)</th>
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
<?php foreach($records as $rec):?>
<form name="form1"  action="<?php echo base_url();?>transport/user/save/" method="POST">
<input name="date" id="date" type="hidden" name="date" value="<?php echo $rec['date']?>" />              
<input name="code" id="code" type="hidden" name="code" value="<?php echo $rec['code']?>" />
<input name="tr_code" id="tr_code" type="hidden" name="tr_code" value="<?php echo $rec['tr_code']?>" />
               <tr>
               <td><?php echo $no;?></td>
               <td><?php echo $rec['date'];?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td align="justify">
                 <?php // $trans=$trans+$rec['transport_chf'];?>
                 <input style="margin:0;padding:0;text-align: left;width:200px ;" name="location" type="text" value="<?php echo $rec['location']?>" />
                 <input type="submit" style="display: none;" /> 
               </td>
               <td align="right">
                 <?php $trans=$trans+$rec['transport_chf'];?>
                 <input style="margin:0;padding:0;text-align: right;" name="transport" type="text" value="<?php echo $rec['transport_chf']?>" />
                 <input type="submit" style="display: none;" /> 
               </td>
               <td align="center">
                   <?php if($rec['app_charge']=="yes") {?>
                        <img src="<?php echo base_url().$rec['signature_charge'];?>" class="sign left" width="80" height="20" />
                    <?php } else { ?>
                        -
                    <?php } ?> 
               </td>
               <td align="center">
                 <?php if($rec['app_manager']=="yes") {?>
                        <img src="<?php echo base_url().$rec['signature_manager'];?>" class="sign left" width="80" height="20" />
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
               <td>Total</td>
               <td align="right"><?php echo number_format($trans,2);?></td>
               <td></td>
               <td></td>
              </tr>
          </tbody>
        </table>
       
       
        
        


   				