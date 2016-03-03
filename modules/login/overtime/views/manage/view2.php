<?php //echo number_format(substr('2010-05-06',5,2));?>

<div id="search" style="height:100px">
           <label for="filter">Code : </label> <b><?php echo $_SESSION['tr_code']; ?></b> <br/>
		   <label for="filter">*</label> <b>Over App Jangan Dikosongkan atau 0</b><br/>
		   <label for="filter">Keterangan</label><br/>
		   <label for="filter">A</label> <b>(1.5 * Total Lembur) * Gapok Perjam</b><br/>
		   <label for="filter">B</label> <b>(2.0 * Total Lembur) * Gapok Perjam</b><br/>
		   <label for="filter">C</label> <b>(3.0 * Total Lembur) * Gapok Perjam</b><br/>
		   <label for="filter">D</label> <b>(4.0 * Total Lembur) * Gapok Perjam</b><br/>
		   <label for="filter"> > 3 Jam</label> <b>(10.000,00/Hari)</b><br/>
</div>
        
        <div id="navigation">
            <!--<a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>-->
            <a target="_blank" class="button" href="<?php echo base_url();?>overtime/manage/print_out/<?php echo $_SESSION['tr_code'];?>">Print Preview</a>
            <a class="button" href="<?php echo base_url();?>overtime/manage/periode/<?=$_SESSION['periode'] ?>">Back</a>
        </div>
        
        <div class="clear"></div>
        
    
          <?php echo $this->session->flashdata('message'); ?>

<table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th width="5%">#</th>
              <th>Date</th>	
              <th>Job Desc</th>
              <th>Client Name</th>
              <!--<th>Time</th>-->
              <th>Time (From - To )</th>
              <th>Over</th>
              <th>Over App</th>
			  <th>A</th>
			  <th>B</th>
			  <th>C</th>
			  <th>D</th>
              <th>App (Charge)</th>
              <th>App (Manager)</th>
          </thead>
          <tbody>
          
            <?php 
                $no=1;
                $trans=0;
            ?>
            <?php foreach($records as $rec):?>
              <form name="form1"  action="<?php echo base_url();?>overtime/manage/aproval/" method="POST">
               <tr>
               <td><?php echo $no;?></td>
               <td>
               <?php //if($rec['over_manager']=='no'){ ?>
                 <input type="checkbox" name="date" id="date" value="<?php echo $rec['date'];?>" checked="checked"/>
                 <input type="hidden" name="code" id="code" value="<?php echo $rec['day_code'];?>" />
               <?php // } ?>
               </td>
               <td><?php echo indo_tgl($rec['date']);?></td>
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['name'];?></td>
               <td align="center"><?php echo $rec['time_1'].'-'.$rec['time_2'];?></td>
               <td align="right"><?php echo $rec['over_time'];?></td>
               <td align="right"><input type="text" name="ov" id="ov" style="width:30px;text-align: right;" value="<?php echo $rec['over_time_app'];?>" /></td>
               <td align="right"><?php echo $rec['x1'];?></td>
			   <td align="right"><?php echo $rec['x2'];?></td>
			   <td align="right"><?php echo $rec['x3'];?></td>
			   <td align="right"><?php echo $rec['x4'];?></td>
			   <td align="center">
                   <?php if($rec['over_charge']=="yes") {?>
                        <img src="<?php echo base_url().$rec['over_charge_sign'];?>" class="sign left" width="80" height="20" />
                    <?php } else { ?>
                        -
                    <?php } ?> 
               </td>
               <td align="center">
                 <?php if($rec['over_manager']=="yes") {?>
                        <select name="ov_manager" id="ov_manager">
                            <option value="yes">Yes</option>
                            <option value="no">No</option> 
                        </select>
                    
                    <?php } else { ?>
                        <select name="ov_manager" id="ov_manager">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    <?php } ?>
                    <br />
                    <input type="submit" value="GO" style="cursor: pointer;"  />
               </td>
               </tr>
               </form>  
             <?php $no++;?>  
            <?php endforeach;?>
              <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
			   <td></td>
               <td></td>
               <td></td>
               <td></td>			   
               <td></td>
               <td align="right"></td>
               <td></td>
               <td></td>
              </tr>
          </tbody>
        </table>
    
       
 <br />      
        
        


   				
