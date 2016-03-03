   <div id="search">
   <!--
     <form method="POST" name="form" action="<?php echo base_url().'salary/accounting/print_month/' ?>">
           <label for="filter">Periode : </label>
            <select name="month">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
            </select>
            
            <b>-</b>
            <select name="month2">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
            </select>
            
            <select name="year">
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
		      <option value="2013">2013</option>
		      <option value="2014">2014</option>

            </select>
            <input type="submit" value="process" style="float: right;width:80px;cursor: pointer;height:20px;padding:5px;margin-bottom:10px ;; ;" />
        </form>
		-->
        </div>
        
         <!--<div id="navigation">
            <a class="button" href="<?php echo base_url();?>salary/accounting/month/2011-06-20/">Salary This Month</a>
        </div>-->
        
        <div class="clear"></div>
     
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th align="left">Periode</th>	
              <th style="width: 10%;" align="left">Auditor</th>	
              <th style="width: 5%;" align="center" width="10%">Export</th>
            </tr>
          </thead>
          <tbody>
		  <?php foreach($records as $rec):?>
		  <?php if(substr($rec['per_salary'],8,2)==20): ?>
            <tr>
               <td><?php echo $rec['per_salary'];?></td>
               <td><?php echo $rec['people'];?> <i>People</i></td>
               <td>
					<a href="<?=base_url();?>salary/accounting/month/<?=$rec['per_salary'];?>"><img src="<?php echo base_url();?>assets/images/excel.gif" /></a> 
			   </td>
               </tr>
			   <?php endif;?>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
 
