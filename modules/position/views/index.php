        <div id="search">
           <label for="filter">Search</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>position/admin/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Position Code</th>	
              <th>Position Name</th>
              <th>Decription</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['description'];?></td>
               <td>
                    <a href="<?php base_url();?>view/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php base_url();?>drop/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>