<script src="<?php echo base_url();?>assets/js/main.js" type="text/javascript"></script>
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
           <label for="filter">Search : </label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/manage/index/">Back</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>TR-Code</th>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Handphone</th>
              <th>email</th>
              <th>Position</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          <tbody>
          <?php foreach($records as $rec):?>
          <?php if(($rec['status_manager']=='process') OR ($rec['status_manager']=='approval') ): ?> 
            <?php
                $SQL="SELECT SUM(transport_chf) as total FROM josh_details_day_tr WHERE tr_code='$rec[tr_code]'";
                $Q=$this->db->query($SQL);
                $row=$Q->row_array();
                $total=$row['total']; 
            ?>
            <?php if($total >= 1 ): ?>
          
            <tr>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo $rec['no'];?></td>
               <td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <td><?php echo $rec['hp'];?></td>
               <td><?php echo $rec['email'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <a href="<?php echo base_url();?>transport/manage/listing/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>transport/manage/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endif; ?>
            <?php endif; ?>   
            <?php endforeach;?>
            
          </tbody>
        </table>