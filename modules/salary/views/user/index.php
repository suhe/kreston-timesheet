        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/user/add">Add New Report</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>	
              <th>Periode End</th>
              <th>Salary</th>
              <th>Half Salary</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $rec):?>
               <tr>
               <td><?php echo $rec['periode'];?></td>
               <td align="right"><?php echo number_format($rec['basic_salary'],2);?></td>
               <td align="right"><?php echo number_format($rec['basic_salary'] * 0.5 ,2);?></td>
               <td>
                   
                    <a href="<?php echo base_url();?>salary/user/print_out/<?php echo $rec['tr_code'];?>/<?php echo $rec['periode'];?>" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
          </tbody>
        </table>
