<script src="<?=base_url();?>assets/js/main.js" type="text/javascript"></script>
<style>

a{
	text-decoration:none;
	color:red;	
}
p{
	clear:both;
	margin:0;
	padding:.5em 0;
}
pre{
	display:block;
	font:100% "Courier New", Courier, monospace;
	padding:10px;
	border:1px solid #bae2f0;
	background:#e3f4f9;	
	margin:.5em 0;
	overflow:auto;
	width:800px;
}

img{border:none;}

/*  */

#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}

/*  */
</style>
        
        <div id="search">
           <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/hrd/index/">Back</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <h1 class="tit">No Assign Report</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
			  <th>No</th>	
              <th>Staff No</th>
			  <th>Date In</th>		
              <th>Staff Name</th>
              <th>Sex</th>
              <th>Pos</th>
            </tr>
          </thead>
          <tbody>
          <?php
             $sql=" SELECT * FROM josh_staff WHERE status='active' AND no<>'10188' AND no<'11000' AND pos_code<>'HRD' AND division='".$_SESSION['division']."' GROUP BY no ";
             $Q=$this->db->query($sql);
             $rows=$Q->result_array();
			 $ione = 1;
             foreach($rows as $row):
          ?>
          <?php
            $sql="SELECT * FROM josh_head_tr jht JOIN josh_staff js ON js.no=jht.staff_no WHERE division='".$_SESSION['division']."' AND jht.staff_no='".$row['no']."' AND jht.periode='".$_SESSION['periode']."'";
            $Q=$this->db->query($sql);
            $rowy=$Q->row_array();
            if(COUNT($rowy)):
                $rowy=$rowy['no'];
            else:
                $rowy='';
            endif;         
            
          ?>
          <?php if($rowy==''): ?>
            <tr>
			   <td><?=$ione;?></td>
               <td><?php echo $row['no'];?></td>
               <td><?php echo indo_tgl($row['staff_date']);?></td>
			   <td><a style="width:100px;height:50px" href="<?php echo base_url();?><?php echo $row['photo'];?>" class="preview" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></td>
               <td><?php echo $row['sex'];?></td>
               <td><?php echo $row['pos_code'];?></td>
            </tr>
            <?php
                  $ione++; 			
            endif;
            endforeach;
            ?>
            
          </tbody>
        </table>
        
		<br />
        
        <h1 class="tit">Draft Timereport (<?=COUNT($recorddraft);?> <i>People</i>)</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
			  <th>No</th>
              <th>NIK</th>	
              <th>TR</th>
              <th>Name</th>
              <th>Sex</th>
              <th>Pos</th>
              <th width="8%" align="center">TimeReport</th>
			  <th width="8%" align="center">Transport</th>
              <th width="8%" align="center">Overtime</th>
              <th width="5%" align="center">Block</th>
            </tr>
          </thead>
          <tbody>
            <tr>
			<?php $itwo=1;?> 
            <?php foreach($recorddraft as $rec):?>
			   <td><?=$itwo;?></td>
               <td><?=$rec['no'];?></td>
               <td><?=$rec['tr_code'];?></td>
               <td><a href="<?=base_url();?><?=$rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <td><?=$rec['sex'];?></td>
               <td><?=$rec['pos_code'];?></td>
               <td>
                    <a href="<?=base_url();?>time_report/hrd/timeuser/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?=base_url();?>time_report/hrd/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
			   <td>
                    <a href="<?=base_url();?>time_report/hrd/view_transport/<?=$rec['tr_code'];?>"><img src="<?=base_url();?>assets/images/view.gif" /></a>
                    <a href="<?=base_url();?>time_report/hrd/print_transport/<?=$rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
			   </td>
               <td>
                    <a href="<?=base_url();?>overtime/manage/listing/<?=$rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?=base_url();?>time_report/hrd/print_ov/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
                <td>
    			   <?php if($rec['status']==0):?>
    			   <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'No');?>
    			   <?php else:?>
    			   <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'Yes');?>
    			   <?php endif;?>
			   </td>
               </tr>
			<?php $itwo++;?>   
            <?php endforeach;?>
            
          </tbody>
        </table>
		
        <br />
        
        <h1 class="tit">Process To Approval ( <?=COUNT($recordprocess);?> <i>People</i>)</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
			  <th>No</th>
              <th>NIK</th>	
              <th>TR-Code</th>
              <th>Name</th>
              <th>Sex</th>
              <th>Pos</th>
              <th width="8%" align="center">TimeReport</th>
			  <th width="8%" align="center">Transport</th>
              <th width="8%" align="center">Overtime</th>
              <th>Approval</th>
              <th width="5%" align="center">Block</th>
            </tr>
          </thead>
          <tbody>
            <tr>
			<?php $ithree=1;?>
            <?php foreach($recordprocess as $rec):?>
			   <td><?=$ithree;?></td>
               <td><?php echo $rec['no'];?></td>
               <td><?php echo $rec['tr_code'];?></td>
               <td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <td><?php echo $rec['sex'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    
					<a href="<?php echo base_url();?>time_report/hrd/timeuser/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
					<a href="<?php echo base_url();?>time_report/hrd/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
			   
			   <td style="width:50px">
				 <a href="<?=base_url();?>time_report/hrd/view_transport/<?=$rec['tr_code'];?>"><img src="<?=base_url();?>assets/images/view.gif" /></a>
				 <a href="<?=base_url();?>time_report/hrd/print_transport/<?=$rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               
               <td style="width:50px">
			     <a href="<?=base_url();?>overtime/manage/listing/<?=$rec['tr_code'];?>"><img src="<?=base_url();?>assets/images/view.gif" /></a>
                 <a href="<?php echo base_url();?>time_report/hrd/print_ov/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               
               <td>
                    <?php if ($rec['status_hrd']=='process'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/hrd/status_hrd/<?php echo $rec['tr_code'];?>/">Process</a>
                    <?php } elseif ($rec['status_hrd']=='approval'){ ?>
                    Approval
                    <?php } ?>
               </td>
               
               <td>
    			   <?php if($rec['status']==0):?>
    			   <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'No');?>
    			   <?php else:?>
    			   <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'Yes');?>
    			   <?php endif;?>
			   </td>
               
               </tr>
			<?php $ithree++;?>   
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        <br />
        
        
        <h1 class="tit">Approval By HRD Manager (<?=COUNT($recordapprov)?> <i>People</i>)</h1>
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
			  <th>No</th>
              <th>NIK</th>	
              <th>TR-Code</th>
              <th>Name</th>
              <th>Sex</th>
              <th>Pos</th>
              <th width="6%" align="center">TimeReport</th>
			  <th width="5%" align="center">Transport</th>
              <th width="5%" align="center">Overtime</th>
              <th>Approval</th>
              <th width="6%" align="center">Block</th>
            </tr>
          </thead>
          <tbody>
            <tr>
			<?php $ifour=1;?>  
            <?php foreach($recordapprov as $rec):?>
			   <td><?=$ifour;?></td>
               <td><?php echo $rec['no'];?></td>
               <td><?php echo $rec['tr_code'];?></td>
               <td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <td><?php echo $rec['sex'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <a href="<?php echo base_url();?>time_report/hrd/timeuser/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>time_report/hrd/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
			   
			   <td>
				 <a href="<?php echo base_url();?>time_report/hrd/view_transport/ <?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                 <a href="<?php echo base_url();?>time_report/hrd/print_transport/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               <td>
			     <a href="<?php echo base_url();?>overtime/manage/listing/ <?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                 <a href="<?php echo base_url();?>time_report/hrd/print_ov/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               
               <td>
                    <?php if ($rec['status_hrd']=='approval'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/hrd/status_hrd/<?php echo $rec['tr_code'];?>/">Approval</a>
                    <?php } elseif ($rec['status_hrd']=='process'){ ?>
                         Process
                    <?php } ?>
               </td>
               
               <td>
    			   <?php if($rec['status']==0):?>
    			     <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'No');?>
    			   <?php else:?>
    			     <?=anchor('time_report/hrd/blockey/'.$rec['tr_code'],'Yes');?>
    			   <?php endif;?>
			   </td>
               
               </tr>
			  <?php $ifour++;?>  
            <?php endforeach;?>
            
          </tbody>
        </table>