        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
          <!--
            <a class="button" href="<?php echo base_url();?>group/hrd/add">Add New Record</a>
         -->
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
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>