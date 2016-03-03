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
        
        <!--<div id="navigation">
            <a class="button" href="<?php echo base_url();?>staff/hrd/add">Add New Record</a>
        </div>-->
        
        <div class="clear"></div>
        
        <?php echo $this->session->flashdata('message'); ?>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Staff NO</th>	
              <th>Name</th>
              <th>email</th>
              <th>Handphone</th>
              <!--<th>City</th>-->
              <th>Position</th>
              <th>Group</th>
              <!--<th width="6%" align="center">Action</th>-->
              
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php foreach($records as $rec):?>
               <td><?php echo $rec['no'];?></td>
               <td><a href="<?php echo base_url();?><?php echo $rec['photo'];?>" class="preview" title="<?php echo $rec['name'];?>"><?php echo $rec['name'];?></a></td>
               <td><?php echo $rec['email'];?></td>
               <td><?php echo $rec['hp'];?></td>
               <!--<td><?php echo $rec['city'];?></td>-->
               <td><?php echo $rec['name_p'];?></td>
               <td><?php echo $rec['group_name'];?></td>
               <!--<td>
                    <a href="<?php echo base_url();?>staff/hrd/view/<?php echo $rec['no'];?>"><img src="<?php echo base_url();?>assets/images/view.gif" /></a>
                    <a href="<?php echo base_url();?>staff/hrd/drop/<?php echo $rec['no'];?>"><img src="<?php echo base_url();?>assets/images/drop.png" /></a>
               </td>-->
               </tr>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
 