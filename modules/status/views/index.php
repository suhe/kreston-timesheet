        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>manager/admin/add">Add New Record</a>-->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>No</th>	
              <th>Name</th>
              <th>Modules</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach($records as $rec):?>
            <tr>
               <td><?php echo $rec['order'];?></td>
               <td><?php echo $rec['name_p'];?></td>
               <td><?php echo $rec['menu'];?></td>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>