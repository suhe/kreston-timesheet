        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>group/hrd/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">ID</th>	
              <th>Group Name</th>
              <th>Partner</th>
              <th>Manager</th>
              <th>Senior</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['group_id'];?></td>
               <td><?php echo $rec['group_name'];?></td>
               <td align="center"><?php echo $rec['partner'];?></td>
               <td align="center"><?php echo $rec['manager'];?></td>
               <td align="center"><?php echo $rec['senior'];?></td>
               <td>
                    <a href="<?php echo base_url();?>group/hrd/view/<?php echo $rec['group_id'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>group/hrd/drop/<?php echo $rec['group_id'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>