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
              <th width="5%" style="text-align:center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['periode'];?></td>
               <td style="text-align:center">
                    <a href="<?php echo base_url();?>time_report/hrd/periode/<?php echo $rec['periode'];?>/"><img src="<?php echo base_url();?>assets/images/view.gif" /></a> 
                    <?php // echo substr($rec['periode'],8,10);?>
					<?php //if(substr($rec['periode'],8,10)=='20'): ?>
					<!---
					<a href="<?php echo base_url();?>time_report/hrd/nch/<?php echo $rec['periode'];?>/">NCH</a>   |  
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1001/<?php echo $rec['periode'];?>/">NC1001</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1002/<?php echo $rec['periode'];?>/">NC1002</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1003/<?php echo $rec['periode'];?>/">NC1003</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1004/<?php echo $rec['periode'];?>/">NC1004</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1005/<?php echo $rec['periode'];?>/">NC1005</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1006/<?php echo $rec['periode'];?>/">NC1006</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1007/<?php echo $rec['periode'];?>/">NC1007</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1008/<?php echo $rec['periode'];?>/">NC1008</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1009/<?php echo $rec['periode'];?>/">NC1009</a>|
					<a href="<?php echo base_url();?>time_report/hrd/NCH_type/NC1010/<?php echo $rec['periode'];?>/">NC1010</a>
					-->
                    <?php // endif;?> 					
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>