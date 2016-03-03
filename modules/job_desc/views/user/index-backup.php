        <div id="search">
		  <?php //form_open('job_desc/searchjob')?>
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
		   <?php // form_dropdown('year_start',config_item('year'))?> 
		   <?php //form_dropdown('year_end',config_item('year'))?>
		   <?php //form_close()?>
        </div>
        
        <div id="navigation">
           <!-- <a class="button" href="<?php echo base_url();?>job_desc/accounting/add">Add New Record</a>-->
		   <?php if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='M') ):?>
           <a class="button" href="<?php echo base_url();?>job_desc/user/export_excel">Export To Excel</a> 
		   <?php endif; ?>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>
              <th>Periode</th>	
              <th>Job Name</th>
             <!-- <th>Remarks</th>-->
			 <?php if($_SESSION['level']<>'M'):?>
              <th>Check</th>
              <th>Manager</th>
			 <?php endif;?>
			  <?php if($_SESSION['level']<>'M'):?>
              <th>Ass.Manager</th>
			  <th>Senior</th>
			  <?php else:?>
			  <th>Budget</th>
			  <!--<th>Hour</th>-->
			  <th>SM</th>
			  <th>SM Budget</th>
			  <th>M</th>
			  <th>M Budget</th>
			  <th>AM</th>
			  <th>AM Budget</th>
			  <th>S2</th>
			  <th>S2 Budget</th>
			  <th>S1</th>
			  <th>S1 Budget</th>
			  <th>AS</th>
			  <th>AS Budget</th>
			  <th>TA</th>
			  <th>TA Budget</th>
			  <!--<th>MG</th>-->
			  <th>Total Budget</th>
			  <?php endif;?>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
			<?php //if($_SESSION['no']==$rec['Manager']):?>
               <td><?php echo $rec['code'];?></td>
               <td><?php echo $rec['periode'];?></td>
               <td><?php echo $rec['name'];?></td>
               <!--<td><?php echo $rec['remarks'];?></td>-->
			   <?php if($_SESSION['level']<>'M'):?>
               <td><?php echo $rec['check'];?></td>
               <td><?php echo $rec['Manager_name'];?></td>
			   <?php endif;?>
			   <?php if($_SESSION['level']<>'M'):?>
			   <td><?php echo $rec['Ass_Manager_name'];?></td>
			   <td><?php echo $rec['Senior_name'];?></td>
			   <?php else:?>
			   <td style="text-align:right"><?php echo number_format($rec['approve_charge'],0);?></td>
               <!--<td>
				<?php
					/*$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($m=$row['total'],0);
					else:
						$m=0;
					endif;		*/		
				?> 
				
				</td>-->
				
				<!--<td>
				<?=$rec['SM_hour']?> 
				<?php /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code');
					$this->db->where('jht.pos_code','SM');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($sm=$row['total'],0);
					else:
						$sm=0;
					endif;	*/			
				?> 
				</td>
				-->
				<td><?=number_format($sm=$rec['SM_hour']*$rec['SM'])?></td>
				
				
				<td>
				<?=$rec['M_hour']?> 
				<?php 
				/*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','M');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($m=$row['total'],0);
					else:
						$m=0;
					endif;		*/		
				?> 
			 </td>
			 
			 <td><?=number_format($m=$rec['M_hour']*$rec['M'])?></td>
			 
				<td>
				<?=$rec['AM_hour']?> 
				<?php /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','AM');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($am=$row['total'],0);
					else:
						$am=0;
					endif;			*/	
				?> 
				</td>	
				
				<td><?=number_format($am=$rec['AM_hour']*$rec['AM'])?></td>
				
				<td>
				<?=$rec['S2_hour']?> 
				<?php 
				  /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','S2');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($s2=$row['total'],0);
					else:
						$s2=0;
					endif;	*/			
				?> 
				</td>	
				
				<td><?=number_format($s2=$rec['S2_hour']*$rec['S2'])?></td>
				
				<td>
				<?=$rec['S1_hour']?> 
				<?php
				 /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','S1');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($s1=$row['total'],0);
					else:
						$s1=0;
					endif;	
                 */   					
				?> 
				</td>

				<td><?=number_format($s1=$rec['S1_hour']*$rec['S1'])?></td>
				
				<td>
				<?=$rec['AS_hour']?> 
				<?php
				  /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','AS');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($as=$row['total'],0);
					else:
						$as=0;
					endif;	
                 */					
				?> 
				</td>

                <td><?=number_format($as=$rec['AS_hour']*$rec['AS'])?></td>
				
				<td>
				<?=$rec['TA_hour']?> 
				<?php
				 /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','TA');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($ta=$row['total'],0);
					else:
						$ta=0;
					endif;		
                 */					
				?> 
				</td>
				<td><?=number_format($ta=$rec['TA_hour']*$rec['TA'])?></td>
				<td><?=number_format($sm+$m+$am+$s2+$s1+$as+$ta,0)?></td>
				<!--<td>
				<?php
				  /*
					$sql =" SUM(jddt.time) + SUM(jddt.over_time_app) as total ";
					$this->db->select($sql);
					$this->db->join('josh_head_tr jht','jht.tr_code=jddt.tr_code','INNER');
					$this->db->where('jht.pos_code','MG');
					$this->db->like('jddt.code',$rec['code']);
					$query=$this->db->get('josh_details_day_tr jddt');
					$row=$query->row_array();
					$query->free_result();
					if(COUNT($row['total'])):
						echo number_format($mg=$row['total'],0);
					else:
						$mg=0;
					endif;	*/			
				?> 
				</td>-->		
				<td>
				<?php 
					/*$smb=$rec['SM'] * $sm;
					$mb =$rec['M'] * $m;
					$amb=$rec['AM'] * $am;
					$s2b=$rec['S2'] * $s2;
					$s1b=$rec['S1'] * $s1;
					$asb=$rec['AS'] * $as;
					$tab=$rec['TA'] * $ta;
					$tmg=50000 * $mg;
					$total=$smb+$mb+$amb+$s2b+$s2b+$s1b+$asb+$tab+$tmg;*/
				?>
				<?php //if($total>$rec['approve_charge']):?>
				<b style="color:red"><?php // number_format($total,2);?></b>
				<?php //else: ?>
				<?php // number_format($total,2);?>
				<?php //endif;?>
				
				</td>
			   <?php endif;?>
            </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
