        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
           <!-- <a class="button" href="<?php echo base_url();?>job_desc/accounting/add">Add New Record</a>-->
           <a class="button" href="<?php echo base_url();?>job_desc/user/export_excel">Export To Excel</a> 
			
		</div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Job Name</th>
              <th>Manager</th>
              <th>Ass.Manager</th>
              <th>Senior</th>
			  <th>Transport AK</th>
			  <th>Transport EF</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
               <td><?php echo $rec['Ass_Manager_name'];?></td>
               <td><?php echo $rec['Senior_name'];?></td>
			   <td><?php echo number_format($rec['transport'],2);?></td>
               <td><?php echo number_format($rec['transport2'],2);?></td>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
