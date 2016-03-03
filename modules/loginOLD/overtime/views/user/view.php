<style>
    .wrapper2 {
	width: 800px;
	margin-left: auto;
	margin-right: auto;
	}


    .accordionButton {	
	width: 800px;
	float: left;
	_float: none;  /* Float works in all browsers but IE6 */
	background: #003366;
	border-bottom: 1px solid #FFFFFF;
	cursor: pointer;
	}
	
.accordionContent {	
	width: 800px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	background: #95B1CE;
	}
	
/***********************************************************************************************************************
 EXTRA STYLES ADDED FOR MOUSEOVER / ACTIVE EVENTS
************************************************************************************************************************/

.on {
	background: #990000;
	}
	
.over {
	background: #CCCCCC;
	}
h1{font-size:15px ;}   
.time{width:5% ;} 

.button2{width:100px;cursor: pointer;}
</style>
   
        <div id="search">
           <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
        </div>
        
        <div id="navigation">
            <a class="button" href="<?php echo base_url();?>time_report/user/addjob">Add New Job</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/addnonjob">Add New Non Job</a>
            <a class="button" href="<?php echo base_url();?>time_report/user/">Come Back</a>
        </div>
        
        <div class="clear"></div>
        
    
          <?php echo $this->session->flashdata('message'); ?>
  
  <h1>CHARGEABLE HOURS - FIELDWORK</h1>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>	
              <th>Job Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $rec):?>
              <tr >
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['job_name'];?></td>
               <td><?php echo $rec['description'];?></td>
               
               </tr>
               <tr >
               <td>Day</td>
               
               <td>Time</td>
               <!--<td></td>-->
               
               </tr>
               
               <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
               <?php $exe=mysql_query($sql);?>
               <?php while($rec2=mysql_fetch_array($exe)){?>
               <tr >
               <td><?php echo $rec2['date'] ?></td>
               <td><?php echo $rec2['time'] ?></td>
               <!--<td></td>-->
               
               </tr>
               <?php } ?>
               
               <form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
               <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />
               <tr >
               <td>
                    <select name="day">
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    </select>
               </td>
               <td>
                    <input name="time" type="text" size="2" class="time" />
               </td>
               <td>
               <input type="submit" value="submit" class="button2" />
               </td>
               
               </tr>
               </form>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        <h1>CHARGEABLE HOURS - OFFICE</h1>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>	
              <th>Job Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records2 as $rec):?>
              <tr >
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['job_name'];?></td>
               <td><?php echo $rec['description'];?></td>
               
               </tr>
               <tr >
               <td>Day</td>
               
               <td>Time</td>
               <!--<td></td>-->
               
               </tr>
               
               <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
               <?php $exe=mysql_query($sql);?>
               <?php while($rec2=mysql_fetch_array($exe)){?>
               <tr >
               <td><?php echo $rec2['date'] ?></td>
               <td><?php echo $rec2['time'] ?></td>
               <!--<td></td>-->
               
               </tr>
               <?php } ?>
               
               <form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
               <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />
               <tr >
               <td>
                    <select name="day">
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    </select>
               </td>
               <td>
                    <input name="time" type="text" size="2" class="time" />
               </td>
               <td>
               <input type="submit" value="submit" class="button2" />
               </td>
               
               </tr>
               </form>
            <?php endforeach;?>
            
          </tbody>
        </table>
        
        
        <h1>NON-CHARGEABLE HOURS</h1>
        
        <table cellpadding="1" cellspacing="1" id="resultTable">
          <thead>
            <tr>
              <th>Job Code</th>	
              <th>Job Name</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records3 as $rec):?>
              <tr >
               <td><?php echo $rec['job_code'];?></td>
               <td><?php echo $rec['job_name'];?></td>
               <td><?php echo $rec['description'];?></td>
               
               </tr>
               <tr >
               <td>Day</td>
               
               <td>Time</td>
               <!--<td></td>-->
               
               </tr>
               
               <?php $sql="SELECT * FROM josh_details_day_tr WHERE code='$rec[day_code]' order by date ASC" ?>
               <?php $exe=mysql_query($sql);?>
               <?php while($rec2=mysql_fetch_array($exe)){?>
               <tr >
               <td><?php echo $rec2['date'] ?></td>
               <td><?php echo $rec2['time'] ?></td>
               <!--<td></td>-->
               
               </tr>
               <?php } ?>
               
               <form class="cmxform" id="signupForm" method="POST" action="<?php echo base_url();?>time_report/user/saved" >
               <input type="hidden" name="code" value="<?php echo $rec['day_code'];?>" />
               <tr >
               <td>
                    <select name="day">
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                    </select>
               </td>
               <td>
                    <input name="time" type="text" size="2" class="time" />
               </td>
               <td>
               <input type="submit" value="submit" class="button2" />
               </td>
               
               </tr>
               </form>
            <?php endforeach;?>
            
          </tbody>
        </table>