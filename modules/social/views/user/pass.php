<form class="cmxform" enctype="multipart/form-data" id="signupForm" method="POST" action="<?php echo base_url()?>home/user/updatepass">
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
       
       
    </div>
    <div class="profile">
       
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
        
        <div class="title"><input type="submit" value="Save" /></div>   
        <div class="separator"></div>
        <div class="name"></div>
        <div class="clear"></div>
		       
    </div>
  
    <div class="clear"></div>
</div>
</form>
