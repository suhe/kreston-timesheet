        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>job_desc/admin/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Periode</th>	
              <th>Job Name</th>
              <th>Remarks</th>
              <th>Check</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['periode'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['remarks'];?></td>
               <td><?php echo $rec['check'];?></td>
               <td>
                    <a href="<?php echo base_url();?>job_desc/admin/view/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>job_desc/admin/drop/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>