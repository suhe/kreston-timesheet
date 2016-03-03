                <div id="search">
                 <label for="filter">Search :
                 </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>salary/accounting/add">Add New Record</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Periode</th>	
              <th width="10%" align="center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               
               <td><?php echo $rec['per_salary'];?></td>
               <td>
			        <!--<a href="<?php echo base_url();?>salary/accounting/print_basic/<?php echo $rec['per_salary'];?>"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>-->
                    <a href="<?php echo base_url();?>salary/accounting/view/<?php echo $rec['per_salary'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>salary/accounting/drop/<?php echo $rec['per_salary'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
 