        <div id="search">
         <form method="POST" name="form" action="<?php echo base_url();?>rec_summary/hrd/print_time">
           <label for="filter">Periode:</label>
           <select name="day">
                <option value="05">05</option>
                <option value="20">20</option>
           </select>
           <select name="month">
                <?php for($i=1;$i<=12;$i++): ?>
                    <?php if($i <= 9): ?>
                    <option value="<?php echo '0'.$i ?>"><?php echo '0'.$i ?></option>
                    <?php else: ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endif; ?>
                <?php endfor;?>
           </select>
           <select name="year">
                <?php for($i=2010;$i<=2012;$i++): ?>
                    <?php if($i <= 9): ?>
                    <option value="<?php echo '0'.$i ?>"><?php echo '0'.$i ?></option>
                    <?php else: ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endif; ?>
                <?php endfor;?>
           </select>
           To
           <select name="day2">
                <option value="05">05</option>
                <option value="20">20</option>
           </select>
           <select name="month2">
                <?php for($i=1;$i<=12;$i++): ?>
                    <?php if($i <= 9): ?>
                    <option value="<?php echo '0'.$i ?>"><?php echo '0'.$i ?></option>
                    <?php else: ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endif; ?>
                <?php endfor;?>
           </select>
           <select name="year2">
                <?php for($i=2010;$i<=2012;$i++): ?>
                    <?php if($i <= 9): ?>
                    <option value="<?php echo '0'.$i ?>"><?php echo '0'.$i ?></option>
                    <?php else: ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php endif; ?>
                <?php endfor;?>
           </select>
           
           <label for="type">Output:</label>
           <select name="type">
                <option value="excel">Excel</option>
                <option value="paper">Paper</option>
           </select>
           
           <input type="submit" name="submit" value="Preview" style="float:right;width:80px;height:20px;padding-top:2px;cursor: pointer;" />
           </form>
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
              <th width="6%" align="center">Print</th>
              <!--<th width="6%" align="center">Group</th>-->
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['periode'];?></td>
               <td>         
                    <a href="<?php echo base_url();?>rec_summary/hrd/print_out/<?php echo $rec['periode'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
					<a href="<?php echo base_url();?>rec_summary/hrd/excel/<?php echo $rec['periode'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/excel.gif" /></a>
               </td>
               <!--<td>         
                    <a href="<?php echo base_url();?>rec_summary/hrd/print_group/<?php echo $rec['periode'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               -->
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>