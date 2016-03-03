<?php echo $this->session->flashdata('message');?>

<div class="mainpage">
   <?php foreach($records as $rec): ?> 
    <div class="photo">
    <?php if ($rec['photo']<>""){ ?>
    <img src="<?php echo base_url();?><?php echo $rec['photo'];?>"  />
    <?php } else { ?>
    <img src="<?php echo base_url();?>assets/photo/default.gif"  />
    <?php } ?>
    </div>
    
    <div class="profile">
        <div class="title">No</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['no'];?></div>
        <div class="clear"></div>
        
        <div class="title">Name</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['name'];?></div>
        <div class="clear"></div>

        <div class="title">Nick Name</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['nickname'];?></div>
        <div class="clear"></div>
        
        <div class="title">Position</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['name_p'];?></div>
        <div class="clear"></div>
        
        <div class="title">Email</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['email'];?></div>
        <div class="clear"></div>
        
        <div class="title">Handphone</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['hp'];?></div>
        <div class="clear"></div>
        
        <div class="title">Birthday</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['birthday'];?></div>
        <div class="clear"></div>
        
        <div class="title">Sex</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['sex'];?></div>
        <div class="clear"></div>
        
        <div class="title">Address</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['address'];?></div>
        <div class="clear"></div>
        
        <div class="title">City</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['city'];?></div>
        <div class="clear"></div>
        
        <div class="title">Country</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $rec['country'];?></div>
        <div class="clear"></div>
        
        <div class="title"></div>
        <div class="separator"></div>
        <div class="name"><a href="<?php echo base_url();?>home/user/edit/">Edit</a></div>
        <div class="clear"></div>
        
    </div>
    <?php endforeach; ?>
    <div class="clear"></div>
</div>
