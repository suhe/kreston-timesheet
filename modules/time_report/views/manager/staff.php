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
           <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/manage/index/">Back</a>
        </div>
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        <!--<h3 class="h">The same group</h3>-->
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>TR-Code</th>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>Handphone</th>
              <th>email</th>
              <th>Position</th>
              <th>Approval</th>
              <th width="6%" align="center">Action</th>
              
            </tr>
          </thead>
          
          <tbody>
          <?php foreach($records as $rec):?>
           <?php if(($rec['status_manager']=='process') OR ($rec['status_manager']=='approval')): ?> 
            <tr>
               <td><?php echo $rec['tr_code'];?></td>
               <td><?php echo $rec['no'];?></td>
               <!--<td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>-->
			   <td><a href="#"><?php echo $rec['name'];?></a></td>
               <td><?php echo $rec['hp'];?></td>
               <td><?php echo $rec['email'];?></td>
               <td><?php echo $rec['pos_code'];?></td>
               <td>
                    <?php if ($rec['status_manager']=='process'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/manage/status_manager/<?php echo $rec['tr_code'];?>/">Process</a>
                    <?php } elseif ($rec['status_manager']=='approval'){ ?>
                    <a class="green" href="<?php echo base_url();?>time_report/manage/status_manager/<?php echo $rec['tr_code'];?>/">Approval</a>
                    <?php } ?>
               </td>
               <td>
					<?php if($rec['status']==1):?>
					Block 
					<?php else:?>
                    <a href="<?php echo base_url();?>time_report/manage/timeuser/<?php echo $rec['tr_code'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <?php endif;?>
					<a href="<?php echo base_url();?>time_report/manage/print_out/<?php echo $rec['tr_code'];?>/" target="_blank"><img src="<?php echo base_url();?>assets/images/b_print.png" /></a>
               </td>
               </tr>
            <?php endif; ?>   
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        
