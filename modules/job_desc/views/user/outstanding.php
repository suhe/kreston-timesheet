        <div id="search" style="width:600px" >
		   <?=form_open('job_desc/user/outstanding_query','style="margin:0"')?>
		   <?=form_dropdown('year_from',config_item('year'),$this->session->userdata('outstanding.periode_from')?$this->session->userdata('outstanding.periode_from'):(date('Y') - 1),'style="padding:7px"');?>
		   -
		   <?=form_dropdown('year_to',config_item('year'),$this->session->userdata('outstanding.periode_to')?$this->session->userdata('outstanding.periode_to'):(date('Y') - 1),'style="padding:7px"');?>
		   <?=form_input(array('name' => 'query','value' => $this->session->userdata('outstanding.name'),'placeholder'=>'Search By Client Name','style'=>'padding:7px;widht:200px;border:1px solid #CCC'));?>
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?> 
        </div>
        
        <div id="navigation">
		   <a class="button" href="<?php echo base_url();?>job_desc/user/refreshjob">Refresh</a>   
           <a class="button" href="<?php echo base_url();?>job_desc/user/outstanding_excel">Export To Excel</a> 
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th rowspan=2 style="width:10px">No</th>
              <th colspan="3">Client Name</th>
			  <th colspan="7">Contact Name</th>
              <th colspan="7">Location</th>
			  <th>Transport</th>
			  <th rowspan="2">Rec.Rate</th>
            </tr>
			
			<tr>
              <th style="width: 80px">Job Code</th>
			  <th style="width: 50px">Periode</th>
			  <th style="width: 150px">Manager</th>
			  <th>Total Budget</th>
              
			  <th>MRH</th>
			  <th>MRC</th>
			  
			  <th>AMRH</th>
			  <th>AMRC</th>
			  
			  <th>S2RH</th>
			  <th>S2RC</th>
			  
			  <th>S1RH</th>
			  <th>S1RC</th>
			  
			  <th>ASRH</th>
			  <th>ASRC</th> 
			   
			  <th>TARH</th>
			  <th>TARC</th>
			  
			  <th colspan="2">Total Cost</th>
            </tr>
			
			<tr>
              <th></th>
              <th style="width: 80px">Staff No</th>
			  <th colspan="2">Staff Name</th>
			  <th>Position</th>
			  
			  <th>MRH</th>
			  <th>MRC</th>
			  
			  <th>AMRH</th>
			  <th>AMRC</th>
			  
			  <th>S2RH</th>
			  <th>S2RC</th>
			  
			  <th>S1RH</th>
			  <th>S1RC</th>
			  
			  <th>ASRH</th>
			  <th>ASRC</th> 
			   
			  <th>TARH</th>
			  <th>TARC</th>
			  
			  <th colspan="2">Reimbust</th>
			  <th></th>
            </tr>
			
			
          </thead>
          <tbody>
            <?=$table?>
          </tbody>
        </table>
