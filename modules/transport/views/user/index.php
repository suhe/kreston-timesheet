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
              <th>Code</th>	
              <th>Periode End</th>
              <th>Manager & HRD Approval</th>
              <!--<th>HRD Manager Approval</th>-->
              <th>Position</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $rec):?>
               <tr>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo $rec['periode'];?></td>
               <td align="center" >
                    <?php if ($rec['status_manager']=='pending'){ ?>
                    <a class="red" href="#">Draft</a>
                    <?php } elseif ($rec['status_manager']=='process'){ ?>
                    <a class="green" href="#">In Process</a>
                    <?php } elseif ($rec['status_manager']=='approval'){ ?>
                    Approval
                    <?php } ?>
               </td>
               <!--<td align="center">
                    <?php if ($rec['status_hrd']=='pending'){ ?>
                    <a class="red" href="#">Draft</a>
                    <?php } elseif ($rec['status_hrd']=='process'){ ?>
                    <a class="green" href="#">In Process</a>
                    <?php } elseif ($rec['status_hrd']=='approval'){ ?>
                    Approval
                    <?php } ?>
               </td>-->
               
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <a href="<?php echo base_url();?>transport/user/listing/<?php echo $rec['tr_code'];?>/"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>transport/user/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
          </tbody>
        </table>