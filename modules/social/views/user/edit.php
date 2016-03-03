<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>home/user/update">
<input type="hidden" id="no" name="no" value="<?php echo $no;?>" />
<div class="mainpage">
     
     <?php echo $this->session->flashdata('message'); ?>
     
    <div class="photo">
       <?php if ($photo<>""){ ?>
    <img src="<?php echo base_url();?><?php echo $photo;?>"  />
    <?php } else { ?>
    <img src="<?php echo base_url();?>assets/photo/default.gif"  />
    <?php } ?>
       <br />
       <input type="file" name="image" id="image"  />
       
    </div>
    <div class="profile">
        <div class="title">No</div>
        <div class="separator">:</div>
        <div class="name"><input id="no" name="no" maxlength="5" value="<?php echo $no;?>" disabled="disabled"/></div>
        <div class="clear"></div>
        
        <div class="title">Name</div>
        <div class="separator">:</div>
        <div class="name"><input id="name" class="len"   name="name"  maxlength="255" value="<?php echo $name;?>" /></div>
        <div class="clear"></div>

<div class="title">Nickname</div>
        <div class="separator">:</div>
        <div class="name"><input id="nickname" class="len"   name="nickname"  maxlength="255" value="<?php echo $nickname;?>" /></div>
        <div class="clear"></div>
        
       <!--
        <div class="title">Old Password</div>
        <div class="separator">:</div>
        <div class="name"><input id="old_password" name="old_password" type="password"  maxlength="255" value="" /></div>
        <div class="clear"></div>
        
        <div class="title">New Password</div>
        <div class="separator">:</div>
        <div class="name"><input id="password" name="password" type="password"  maxlength="255" value="" /></div>
        <div class="clear"></div>
        
        <div class="title">Confirm Password</div>
        <div class="separator">:</div>
        <div class="name"><input id="confirm_password" name="confirm_password" type="password" value=""  maxlength="15" /></div>
        <div class="clear"></div>
      --> 

<!-- 
        <div class="title">Position</div>
        <div class="separator">:</div>
        <div class="name">
          <select name="job" id="job">
               <option value="<?php echo $job;?>"><?php echo $job;?></option>
               <?php if($job=="Auditor"){ ?> 
                 <option value="Supervisor">Supervisor</option>
                 <option value="Manager">Manager</option>
               <?php } elseif($job="Supervisor"){ ?> 
                <option value="Auditor">Auditor</option>
                <option value="Manager">Manager</option>
               <?php } elseif($job="Manager"){?>
                <option value="Auditor">Auditor</option>
                <option value="Supervisor">Supervisor</option>
               <?php } ?>  
            </select>
        </div>
        <div class="clear"></div>
-->
        
        <div class="title">Email</div>
        <div class="separator">:</div>
        <div class="name"><input id="email" class="len" name="email"  maxlength="255" value="<?php echo $email;?>" /></div>
        <div class="clear"></div>
        
        <div class="title">Handphone</div>
        <div class="separator">:</div>
        <div class="name"><input id="hp" name="hp" class="len" value="<?php echo $hp;?>" maxlength="15" /></div>
        <div class="clear"></div>
        
        <div class="title">Birthday</div>
        <div class="separator">:</div>
        <div class="name">
            <select name="day" id="day">
                <option value="<?php echo $day; ?>"><?php echo $day;?></option>
               <?php
                    for($i=1;$i<=31;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="month" id="month">
                <option value="<?php echo $month; ?>"><?php echo $month;?></option>
               <?php
                    for($i=1;$i<=12;$i++)
                    {  
                        if ($i<=9){
                        echo "<option value=0".$i.">0".$i."</option>";}
                        else{
                            echo "<option value=".$i.">".$i."</option>";
                        }
                    }    
               ?> 
            </select>
            <select name="year" id="year">
                <option value="<?php echo $year; ?>"><?php echo $year;?></option>
               <?php
                    for($i=1950;$i<=1990;$i++)
                    {  
                        
                            echo "<option value=".$i.">".$i."</option>";
                    
                    }    
               ?> 
            </select>
        </div>
        <div class="clear"></div>
        
        <div class="title">Sex</div>
        <div class="separator">:</div>
        <div class="name"><select name="sex" id="sex">
               <option value="<?php echo $sex?>"><?php echo $sex;?></option> 
               <?php if($sex=="Pria"){ ?> 
                    <option value="Wanita">Wanita</option>
               <?php } elseif($sex=="Wanita"){ ?>
                    <option value="Pria">Pria</option>
               <?php } ?>      
            </select></div>
        <div class="clear"></div>
        
        <div class="title">Address</div>
        <div class="separator">:</div>
        <div class="name"><input id="address" class="len" name="address" value="<?php echo $address;?>" maxlength="255" /></div>
        <div class="clear"></div>
        
        <div class="title">City</div>
        <div class="separator">:</div>
        <div class="name"><input id="city" name="city" class="len" value="<?php echo $city;?>" maxlength="255" /></div>
        <div class="clear"></div>
        
        <div class="title">Country</div>
        <div class="separator">:</div>
        <div class="name"><input id="country" name="country" value="<?php echo $country;?>" maxlength="255" /></div>
        <div class="clear"></div>
        
        <div class="title"><input type="submit" value="Save" /></div>   
        <div class="separator"></div>
        <div class="name"></div>
        <div class="clear"></div>
        
    </div>
  
    <div class="clear"></div>
</div>
</form>
