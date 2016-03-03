        <div id="search">
           <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>transport/accounting/index/">Come Back</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <h1 class="tit">Process To Approval</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>TR-Code</th>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Accounting Approval</th>
              <th>Manager In Charge</th>
              <th>HRD Approval</th>
              <th>Sex</th>
              <th>Position</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($recordprocess as $rec):?>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo $rec['no'];?></td>
               <td><?php echo $rec['name'];?></td>
               
			<td>              
				<?php echo $rec['status_acc'];?>

              </td>
                
               <td>
                    <?php echo $rec['status_manager'];?>
               </td>
               <td>
                    <?php echo $rec['status_hrd'];?>
               </td>
               <td><?php echo $rec['sex'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <a href="<?php echo base_url();?>transport/admin/view/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>transport/admin/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        <br />
        
        <h1 class="tit">Approval By Manager In Charge</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>TR-Code</th>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Accounting Approval</th>
              <th>Manager In Charge</th>
              <th>HRD Approval</th>
              <th>Sex</th>
              <th>Position</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($recordapprov as $rec):?>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo $rec['no'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td>
                    <?php if ($rec['status_acc']=='approval'){ ?>
                    <a class="green" href="<?php echo base_url();?>transport/accounting/status_acc/<?php echo $rec['tr_code'];?>/">Approval</a>
                    <?php } elseif ($rec['status_acc']=='process'){ ?>
                         Process
                    <?php } ?>
               </td>
               <td>
                    <?php echo $rec['status_manager'];?>
               </td>
               <td>
                    <?php echo $rec['status_hrd'];?>
               </td>
               <td><?php echo $rec['sex'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <a href="<?php echo base_url();?>transport/accounting/view/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>transport/accounting/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        