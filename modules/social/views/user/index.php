<?=$this->session->flashdata('message');?>
<div class="mainpage">
    <!--
	<div class="photo">
    <?php if ($user['photo']<>""): ?>
        <img src="<?=base_url();?><?php echo $user['photo'];?>"  />
    <?php else: ?>
    <img src="<?=base_url();?>assets/photo/default.gif"  />
    <?php endif; ?>
	<hr/>
	My Information
	<hr/>
	<div class="profile" style="float:left"> 
	<div class="title">No</div>
        <div class="separator">:</div>
        <div class="name"><?php echo $user['no'];?></div>
        <div class="clear"></div>
		
		<div class="title">Nick</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['nickname'];?></div>
        <div class="clear"></div>
		
		<div class="title">Pos</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['pos_code'];?></div>
        <div class="clear"></div>
		
		<div class="title">HP</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['hp'];?></div>
        <div class="clear"></div>
		
		<div class="title">Birth</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['birthday'];?></div>
        <div class="clear"></div>
		
		<div class="title">Sex</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['sex'];?></div>
        <div class="clear"></div>
		
		<div class="title">City</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['city'];?></div>
        <div class="clear"></div>
        
        <div class="title">WN</div>
        <div class="separator">:</div>
        <div class="name"><?=$user['country'];?></div>
        <div class="clear"></div>
		
    </div>
	</div>
	-->
    <div class="activity">
         <h4><?=$_SESSION['name']; ?></h4>
		 <?php if(COUNT($users)):?>
            <h3><?=$users['content']; ?></h3>
         <?php endif;?>
		 <br/>
		 <form name="name" method="POST" action="<?=$action;?>" >
		 <textarea name="content" style="width:99%"></textarea>
		 <div align="right" style="float:right;margin-top:5px"><input style="width:80px;padding:10px;font-weight:bold;cursor:pointer;background:#64C1FF;border:0px" type="submit" name="save" value="POST" align="right" /></div>
		 <div style="clear:both"></div>
		 </form>
		 
		 <div class="activity">
			<h5>Last Activity</h5>
			<br/>
			<?php if($records): ?>
			<?php foreach($records as $rec): ?>
			<div class="status" >
				<?php if ($rec['photo']<>""): ?>
				<img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?><?php echo $rec['photo'];?>"  />
				<?php else: ?>
				<img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?>assets/photo/default.gif"  />
				<?php endif; ?>
				<b><?=$rec['name']; ?></b> Say.... 
				<?=$rec['content']; ?>
				<br/>
				<i><?=$rec['status_date']; ?></i>
			</div>
			
			<?php
			$comments = $this->Josh_social->selectRecordsComment($rec['id']);
			foreach($comments as $row): ?>
			<?php //if($row['status_id']==$rec['id']): ?>
			<div class="commentstatus">		
			<div style="background:#FFF;height:auto;padding:5px;margin-bottom:5px">
				<?php if ($row['photo']<>""): ?>
				    <img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?><?php echo $row['photo'];?>"  />
				<?php else: ?>
				    <img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?>assets/photo/default.gif"  />
				<?php endif; ?>
				<b><?=$row['name']; ?></b>
				<?=$row['comment']; ?>
				<br/>
				<i><?=$row['comment_date']; ?></i>
				</div>
			</div>	
			<?php //endif;?>	
			<?php endforeach;?>
			
			<?php echo form_open($open); ?>
			<input type="hidden" name="id_c" value="<?php echo $rec['id']; ?>"  />
			<?php if ((COUNT($user)>1) AND ($user['photo']<>"")): ?>
			<img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?><?php echo $user['photo'];?>"  />
			<?php else: ?>
			<img style="width:40px;height:40px;float:left;padding-right:20px" src="<?php echo base_url();?>assets/photo/default.gif"  />
			<?php endif; ?>
			<textarea style="width:93%;height:40px" name="comment"></textarea>
			
			<div align="right" style="float:right;margin-top:5px"><input style="width:80px;padding:10px;font-weight:bold;cursor:pointer;background:#64C1FF;border:0px" type="submit" name="save" value="POST" align="right" /></div>
		    <div style="clear:both"></div>
			<?php echo form_close();?>
			
			  
			<?php endforeach;?>
			<?php endif; ?>
		</div>
		 
        <div class="clear"></div>
        
    </div>
    
    <div class="clear"></div>
</div>

<style>
  .status {padding:5px;min-height:50px}
  .commentstatus{padding:5px;min-height:50px;margin-left:20px}
</style>
