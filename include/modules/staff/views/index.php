        <div id="search">
           <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>staff/add">Add New Record</a>
        </div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Birthday</th>
              <th>Sex</th>
              <th>City</th>
              <th>Position</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['no'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['birrthday'];?></td>
               <td><?php echo $rec['sex'];?></td>
               <td><?php echo $rec['city'];?></td>
               <td><?php echo $rec['job_position'];?></td>
               <td>
                    <a href=""><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href=""><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>