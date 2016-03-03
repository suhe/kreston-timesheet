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
              <!--<th>Accounting Approval</th>-->
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
               <!--
               <td>
                    <?php if ($rec['status_acc']=='pending'){ ?>
                    <a class="red" href="<?php echo base_url();?>transport/user/status_acc/<?php echo $rec['tr_code'];?>/">Pending</a>
                    <?php } elseif ($rec['status_acc']=='process'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/user/status_acc/<?php echo $rec['tr_code'];?>/">Process</a>
                    <?php } elseif ($rec['status_acc']=='approval'){ ?>
                    Approval (Ready For Print)
                    <?php } ?>
               </td>
               -->
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
                    <a href="<?php echo base_url();?>overtime/user/listing/<?php echo $rec['tr_code'];?>/"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>overtime/user/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
          </tbody>
        </table>