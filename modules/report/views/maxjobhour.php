         <h3 style="padding:10px 20px;border-bottom:1px solid #CCC ">Over Budget Job Setup</h3>
		 
		<div id="search" style="width:1000px">
		<?=form_open('report/user/maxjobhour_query','style="margin:0"')?>
		   <?=form_dropdown('periode',array(''=>'All Periode','11'=>'2011','12'=>'2012','13'=>'2013','14'=>'2014','15'=>'2015','16'=>'2016'),!$this->session->userdata('maxjobhour.periode')?'':$this->session->userdata('maxjobhour.periode'),'style="padding:5px;border:1px solid #CCC"');?>
		   <?=form_input(array('name' => 'query','value' => $this->session->userdata('maxjobhour.client_name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC'));?>
		   <input type="submit" value="View" style="width:70px;padding:7px;margin:0;background:#64C1FF;cursor:pointer" />
		   <a class="button" href="<?php echo base_url();?>report/user/jobAutoCorrect">Auto Correct</a>
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
		<!--
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>report/user/jobAutoCorrect">Auto Correct</a>
        </div>-->
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
    
		<div class="table-outter wrapper">
		 <table cellpadding="1" cellspacing="1" class="table header-fixed" id="resultTable">
			<thead class="fixed_headers">
			<tr class='tblTitle'>
				<th rowspan="2" style="width:20px">No</th>
				<th rowspan="2" style="width:100px">Job Code</th>
				<th rowspan="2" style="width:250px">Job Name</th>
				<th colspan="3" style="width:90px">SP</th>
				<th colspan="3" style="width:90px">PC</th>
				<th colspan="3" style="width:90px">SM</th>
				<th colspan="3" style="width:90px">M</th>
				<th colspan="3" style="width:90px">AM</th>
				<th colspan="3" style="width:90px">S2</th>
				<th colspan="3" style="width:90px">S1</th>
				<th colspan="3" style="width:90px">AS</th>
				<th colspan="3" style="width:90px">TA</th>
				<th colspan="3" style="width:90px">SUM</th>
			</tr>
			
			<tr>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
				<th style="width:30px">B</th>
				<th style="width:30px">R</th>
				<th style="width:30px">PL</th>
				
			</tr>
			
			 </thead>
			  <tbody>
				<?=$table?>
			  </tbody>
		</table>
		</div>
		
<style>

</style>		
	