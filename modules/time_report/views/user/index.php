        <div id="search">
           <label for="filter">Search</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/user/add">Add New Report</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Code</th>	
              <th>Periode End</th>
              <th>Position</th>
              <th>Manager Approval</th>
              <th>HRD Approval</th>
              <th width="10%" align="center">TR</th>
			  <th width="5%" align="center">OVR</th>
              <th width="5%" align="center">TRP</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $rec):?>
               <tr>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo indo_tgl($rec['periode']);?></td>
               <td><?php echo $rec['pos_name'];?></td>
               <td align="center" >
			    <?php if($rec['status']==1):?>
					Block By HRD
                <?php else:?>  				
                    <?php if ($rec['status_manager']=='pending'){ ?>
                    <a class="red" href="<?php echo base_url();?>time_report/user/status_manager/<?php echo $rec['tr_code'];?>/">Draft</a>
                    <?php } elseif ($rec['status_manager']=='process'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/user/status_manager/<?php echo $rec['tr_code'];?>/">In Process</a>
                    <?php } elseif ($rec['status_manager']=='approval'){ ?>
                    Approval
                    <?php } ?>
				<?php endif;?>	
               </td>
			   
               <td align="center">
			   <?php if($rec['status']==1):?>
					Block By HRD
               <?php else:?>
                    <?php if ($rec['status_hrd']=='pending'){ ?>
                    <a class="red" href="<?php echo base_url();?>time_report/user/status_hrd/<?php echo $rec['tr_code'];?>/">Draft</a>
                    <?php } elseif ($rec['status_hrd']=='process'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/user/status_hrd/<?php echo $rec['tr_code'];?>/">In Process</a>
                    <?php } elseif ($rec['status_hrd']=='approval'){ ?>
                    Approval
                    <?php } ?>
			   <?php endif;?>		
               </td>
               <td>

<?php if($rec['status']==1):?>
					Block
<?php else:?>			   
<a href="<?=base_url();?>time_report/user/view/<?=$rec['tr_code'];?>/"><img src="<?=base_url();?>assets/images/view.gif" /></a>
<?php endif;?>
                    <a onclick="return confirm('Are you sure you want to Preview !');" href="<?php echo base_url();?>time_report/user/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
                    <?php if($rec['status']==1):?>
					Block
					<?php else:?>
					<a onclick="return confirm('Are you sure you want to Remove !');" href="<?php echo base_url().'time_report/user/delete_report/'.$rec['staff_no'].'/'.$rec['tr_code']; ?>" onclick =" return confirm('Are you sure you want to delete?')" ><img src="<?php echo base_url();?>assets/images/drop.png" /></a>   
				    <?php endif;?>	
			   </td>
			   <td>
					<a onclick="return confirm('Are you sure you want to View Overtime !');" href="<?php echo base_url();?>time_report/user/print_ov/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
			   </td>
			   <td>
					<a onclick="return confirm('Are you sure you want to View Transport !');" href="<?php echo base_url();?>time_report/user/print_transport/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
			   </td>
               </tr>
            <?php endforeach;?>
          </tbody>
        </table>
