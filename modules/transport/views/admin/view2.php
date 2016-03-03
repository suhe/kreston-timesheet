<?php //echo number_format(substr('2010-05-06',5,2));?>
<div id="search">
           <label for="filter">Periode : </label> <b><?php echo $_SESSION['tr_code']; ?></b>
</div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>transport/admin/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>transport/admin/index">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
<?php echo $this->session->flashdata('message'); ?>

<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
			  <th width="2%">#</th>
              <th>Date</th>	
              <th>Job Desc</th>
              <th>Client</th>
              <th>Location</th>
              <th >Transport(Rp.)</th>
              <th >App (Charge)</th>
              <th >App (Manager)</th>
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
            <?php foreach($records as $rec):?>
              <form name="form1"  action="<?php echo base_url();?>transport/admin/aproval/" method="POST">
               <tr>
               <td><?php echo $no;?></td>
			   <td><input type="checkbox" name="date" value="<?php echo $rec['date']; ?>" checked="checked" /></td>
               <td><?php echo indo_tgl($rec['date']);?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['location'];?></td>
               <td align="right"><?php echo number_format($rec['transport'],2);$trans=$trans+$rec['transport'];?></td>
               <td align="center">
                   <?php if($rec['app_charge']=="yes") {?>
                        <select name="approval" id="approval"  class="left"  >
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                    <?php } else { ?>
                        <input type="hidden" name="code" value="<?php echo $rec['id'];?>" />
                        <select name="approval" id="approval"  class="left"  >
                          <option value="no">No</option>
						  <option value="yes">Yes</option>
                        </select>    
                    <?php } ?>
                    <br />
                    <input type="submit" value="GO" name="go" style="float: left;cursor: pointer;" /> 
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
               <td></td>
               <td>Total</td>
               <td align="right"><?php echo number_format($trans,2);?></td>
               <td></td>
               <td></td>
              </tr>
          </tbody>
        </table>
		
    
   
<br />  <br /> 		
      
   				