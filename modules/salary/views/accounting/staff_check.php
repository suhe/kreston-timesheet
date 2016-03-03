                <div id="search">
                 <label for="filter">Search :
                 </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        
        
        <div class="clear"></div>
        
     
        <?php echo form_open('salary/accounting/staff_check'); ?>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Periode</th>	
              <th width="10%" align="center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            
               
               
               <td>
			   <select name="day">
			   <?php for($i=1;$i<=31;$i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
               <?php endfor;?> 
               </select> 
			  
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
			  <select name="year">
                    <option value="2011">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
             </select>
			 
			 -
			 <select name="day2">
			   <?php for($i=1;$i<=31;$i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
               <?php endfor;?> 
               </select> 
			  
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
			  <select name="year2">
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
             </select>
			 <input type="submit" name="export" style="width:120px" value="Ekspor Ke Excel">
			   </td>
			   
			   <td> 
			   </td>
			   
               </tr>
            
          </tbody>
        </table>
		<?php echo form_close(); ?>
        
 
