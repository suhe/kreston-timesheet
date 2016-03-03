        <div id="search" style="width:1000px">
		<?=form_open('overtime/accounting/bulk_overtime','style="margin:0"')?>
		   <?=form_dropdown('client_name', $bind_client, $this->session->userdata('overtime.client_name'),'style="padding:7px" class="chosen-select"')?>
		   
		   <?=form_dropdown('day_from',config_item('daystart'),!$this->session->userdata('overtime.date_from')?'':substr($this->session->userdata('overtime.date_from'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_from',config_item('month'),!$this->session->userdata('overtime.date_from')?'':substr($this->session->userdata('overtime.date_from'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_from',config_item('year'),!$this->session->userdata('overtime.date_from')?'':substr($this->session->userdata('overtime.date_from'),0,4),'style="padding:7px"');?>
		   
		   To
		   
		   <?=form_dropdown('day_to',config_item('dayend'),!$this->session->userdata('overtime.date_to')?'':substr($this->session->userdata('overtime.date_to'),8,2),'style="padding:7px"');?>
		   <?=form_dropdown('month_to',config_item('month'),!$this->session->userdata('overtime.date_to')?'':substr($this->session->userdata('overtime.date_to'),5,2),'style="padding:7px"');?>
		   <?=form_dropdown('year_to',config_item('year'),!$this->session->userdata('overtime.date_to')?'':substr($this->session->userdata('overtime.date_to'),0,4),'style="padding:7px"');?>
		   
		  
		   <input type="submit" value="View" style="width:70px;padding:9px;margin:0;background:#64C1FF;cursor:pointer" />
		<?=form_close();?>   
		<?php //($_SESSION['bulk_periode'])?>
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>overtime/accounting/export_excel">Export Excel</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>NIK</th>
			  <th>Nama</th>
			  <th>Salary</th>
			  <th style="width:55px">Tanggal</th>
			  <th>Hour</th>
			  <th>X1</th>
			  <th>X2</th>
			  <th>X3</th>
			  <th>X4</th>
			  <th>Meal</th>
			  <th>OT+Meal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $v){ ?>
				<tr>
					<td><?=$v['no']?></td>
					<td><?=$v['name']?></td>
					<td style="text-align:right"><?=number_format($v['salary'],2)?></td>
					<td></td>
					<td style="text-align:right"><?=number_format($v['overtime'],0)?></td>
					<td style="text-align:right"><?=number_format($v['x1'],0)?></td>
					<td style="text-align:right"><?=number_format($v['x2'],0)?></td>
					<td style="text-align:right"><?=number_format($v['x3'],0)?></td>
					<td style="text-align:right"><?=number_format($v['x4'],0)?></td>
					<td style="text-align:right"><?=number_format($v['meal'],0)?></td>
					<td style="text-align:right"><?=number_format($v['totalov'],2)?></td>
				</tr>
				
				<?php  
					$ov = $this->Josh_time_report->selectUserOvertimeAcc($date_from,$date_to,$client_name,$v['no']);
					//if($ov){
					foreach($ov as $v2){
				?>
				<tr>
				   <td></td>
				   <td > &nbsp;&nbsp; - <?=$v2['name']?></td>
				   <td></td>
				   <td><?=$v2['date']?></td>
				   <td style="text-align:right"><?=number_format($v2['over_time_app'],0)?></td>
				   <td style="text-align:right"><?=number_format($v2['x1'],0)?></td>
				   <td style="text-align:right"><?=number_format($v2['x2'],0)?></td>
				   <td style="text-align:right"><?=number_format($v2['x3'],0)?></td>
				   <td style="text-align:right"><?=number_format($v2['x4'],0)?></td>
				   <td style="text-align:right"><?=number_format($v2['meal'],0)?></td>
				   <td style="text-align:right"></td>
				</tr>
				<?php } // }  ?>
				
			<?php } ?>
          </tbody>
        </table>
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
       <?php //echo '<script type="text/" src="'.base_url().APPPATH.'libraries/jquery/jquery.js"></script>'; ?>
	   <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/jquery.simplemodal.js"></script>'; ?>
       <?php //echo '<script type="text/javascript" src="'.base_url().APPPATH.'libraries/form_modal/js/confirm.js"></script>'; ?>
       <?php //echo '<link type="text/css" href="'.base_url().APPPATH.'libraries/form_modal/css/confirm.css" rel="stylesheet" media="screen" />'; ?>
	   <link rel="stylesheet" href="<?=base_url()?>/assets/css/chosen.css">
	   <script src="<?=base_url()?>/assets/js/chosen.jquery.js" type="text/javascript"></script>
  
	<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
   	