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
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
<?php foreach($records as $rec):?>
<?php $trans=$trans+$rec['transport_chf']; ?>       
               <tr>
               <td><?php echo $no;?></td>
               <td><?php echo indo_tgl($rec['date']);?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td align="justify">
                 <?=$rec['location']?>
               </td>
               <td align="right">
				  <form style="padding:0;margin:0;width:130px" name="form1"  action="<?php echo base_url();?>time_report/hrd/save_transport/" method="POST">
					<input name="code" id="code" type="hidden" name="code" value="<?php echo $rec['code']?>" />
					<input name="date" id="date" type="hidden" name="date" value="<?php echo $rec['date']?>" />
					<input name="tr_code" id="tr_code" type="hidden" name="tr_code" value="<?php echo $rec['tr_code']?>" />	
					<input style="margin:0;padding:0;text-align: right;" name="transport" type="text" value="<?php echo $rec['transport_chf']?>" />
					<input type="submit" value="Update" style="width:60px;height:20px;padding-top:2px;padding-bottom:5px;cursor:pointer"/> 
				  </form> 
			   </td>
               
               </tr>
               
 <?php $no++;?>  
 <?php endforeach;?>
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td><b>Total TRP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<?php echo number_format($trans,0);?></td>
               
              </tr>
          </tbody>
        </table>
		