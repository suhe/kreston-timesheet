        <div id="search">
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/add">Add New Report</a>-->
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Periode End</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['periode'];?></td>
               <td>
                    <a href="<?php echo base_url();?>overtime/admin/periode/<?php echo $rec['periode'];?>/"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>         
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>