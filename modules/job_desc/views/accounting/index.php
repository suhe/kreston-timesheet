        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <?php if ($_SESSION['level'] == 'HRD'): ?>
            <a class="button" href="<?php echo base_url();?>job_desc/accounting/add">Add New Record</a>
           <?php endif;?>
			<a class="button" href="<?php echo base_url();?>job_desc/user/export_excel">Export To Excel</a> 
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Active</th>		
              <th>Job Name</th>
              <th>Status</th>
              <th>Partner</th>
              <th>Manager</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td align="center" >
                    <?php if ($rec['status_job']=='active'){ ?>
                    <a class="red" href="<?php echo base_url();?>job_desc/accounting/status_deactive/<?php echo $rec['code'];?>/">Yes</a>
                    <?php } elseif ($rec['status_job']=='deactive'){ ?>
                    <a class="green" href="<?php echo base_url();?>job_desc/accounting/status_active/<?php echo $rec['code'];?>/">No</a>
                    <?php } ?>
               </td>
               <td><a style="color:red ;" href="<?php echo base_url().'job_desc/accounting/view/'.$rec['code']; ?>"><?php echo $rec['name'];?></a>  </td>
               <td><?php echo $rec['check'];?></td>
               <td><?php echo $rec['Partner_name'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
               <td>
                    <a onclick="return confirm('Are you sure you want to View !');" href="<?php echo base_url();?>job_desc/accounting/view/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a onclick="return confirm('Are you sure you want to Remove !');" href="<?php echo base_url();?>job_desc/accounting/drop/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
