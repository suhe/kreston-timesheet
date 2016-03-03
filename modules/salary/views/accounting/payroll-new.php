        <div id="search" style="width:1000px">
		<?=form_open('salary/accounting/bulk_payroll','style="margin:0"')?>
		   <?=form_dropdown('month',config_item('month'),!$this->session->userdata('payroll.periode')?'':substr($this->session->userdata('payroll.periode'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year',config_item('year'),!$this->session->userdata('payroll.periode')?'':substr($this->session->userdata('payroll.periode'),0,4),'style="padding:7px"');?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>salary/accounting/export_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
				<th rowspan="2">NIK</th>
				<th rowspan="2">Nama</th>
				<th colspan="3">Periode 05</th>
				<th colspan="3">Periode 20</th>
				<th rowspan="2">Total</th>
            </tr>
			<tr>
				<th>Salary</th>
				<th>Overtime</th>
				<th>Reimbust</th>
				
				<th>Salary</th>
				<th>Overtime</th>
				<th>Reimbust</th>
			</tr>
			
          </thead>
          <tbody>
				<?=$table?>
          </tbody>
        </table>
		
	