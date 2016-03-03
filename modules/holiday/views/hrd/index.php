        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>holiday/hrd/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Date</th>	
              <th>Description</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
          <?php foreach($records as $rec):?>
            <tr>
               <td><?php echo $rec['date_h'];?></td>
               <td><?php echo $rec['description_h'];?></td>
               <td>
                    <a href="<?php echo base_url();?>holiday/hrd/view/<?php echo $rec['date_h'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>holiday/hrd/drop/<?php echo $rec['date_h'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
              </tr> 
            <?php endforeach;?>
          </tbody>
        </table>