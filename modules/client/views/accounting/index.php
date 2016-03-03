        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>client/accounting/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Code</th>	
              <th>Name</th>
              <th>Address</th>
              <th>Location</th>
			  <th>Transport</th>
              <th width="6%" align="center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td><?php echo $rec['address'];?></td>
               <td><?php echo $rec['city'].','.$rec['country'];?></td>
			   <td><?php echo number_format($rec['transport'],0);?></td>
               <td>
                    <a onclick="return confirm('Are you sure you want to View !');" href="<?php echo base_url();?>client/accounting/view/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a onclick="return confirm('Are you sure you want to Remove !');" href="<?php echo base_url();?>client/accounting/drop/<?php echo $rec['code'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
			  
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>