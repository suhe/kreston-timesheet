<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/css/screen.css" />
<link href="<?php echo base_url()?>templates/default/css/table.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>templates/default/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>templates/default/css/layout.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>templates/default/css/main.css"> 
<style type="text/css">
#commentForm { width: 100%; }
#commentForm label { width: 250px; }
#commentForm label.error, #commentForm input.submit { margin-left: 253px; }
#signupForm { width: 100%; }
#signupForm label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
}
#newsletter_topics label.error {
	display: none;
	margin-left: 103px;
}
</style>
<!-- Start Javascript File -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script src="<?php echo base_url() ?>assets/js/javascript.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>templates/default/js/application.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/js/validate.js" type="text/javascript"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!-- End  Javascript File -->
</head>

<body>
	<div id="container">
       
	<div class="menu_container">
	<nav class="menu"> <!-- Code for Mobile View / Start -->
	<h2 class="dropdown">Menu</h2> <input type="checkbox" id="dropdown"> 
	<label for="dropdown" onclick><i class="icon-list"></i></label> <!-- Code for Mobile View / End --> <!-- Main Links / Start --> 
	<ul>
	  <li><a href="<?=base_url()?>social/user/index">Home</a></li>
	  <li><a href="<?=base_url()?>home/user/index">My Profile</a></li>
	  <?php if($_SESSION['level']=='HRD'){ ?>
	  <li><a href="<?=base_url()?>client/accounting/index">Client</a></li>
	  <li><a href="<?=base_url()?>job_desc/accounting/index">Job Setup</a></li>
	  <li><a href="<?=base_url()?>staff/hrd/index">Edit Staff</a></li>
	  <li><a href="<?=base_url()?>holiday/hrd/index">Holiday</a></li>
	  <?php } ?>
	  <?php if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='M') ){ ?>
	  <li><a href="<?=base_url()?>job_desc/user/approval">Job Project</a></li>
	  <?php } ?>
	  <li><a href="<?=base_url()?>staff/user/index">Employee</a></li>
	  <?php if(($_SESSION['level']=='HRD') || ($_SESSION['level']=='ADM') ){ ?>
	  <li><a href="<?=base_url()?>/time_report/hrd/index">Time Report</a></li>
	  <li><a href="<?=base_url()?>/overtime/accounting/">Overtime</a></li>
	  <li><a href="<?=base_url()?>/transport/accounting/">Transport</a></li>
	  <li><a href="<?=base_url()?>/salary/accounting/payroll">Payroll</a></li>
	   <?php } ?>
	  <?php if($_SESSION['level']!='HRD'){ ?>
	  <li><a href="<?=base_url()?>/time_report/user/index">Time Report</a> </li>
	   <?php if(($_SESSION['level']!='TA') ){ ?>
	  <li><a href="<?=base_url()?>/time_report/manage/index">Manage Time & OT</a></li>
	  <?php } ?>
	  <?php } ?>
	  <li><a href="<?=base_url()?>/login/user/logout">Logout</a></li>
	</ul> 
	</nav>
	</div>
        
        <div id="wrapper">
            <?php echo $this->load->module_view($module,$main);?>
        </div>
        
        <div id="footer">
		 <div id="menustaff">
            <?php echo $_SESSION['menu']; ?>
        </div>
        </div>
    </div>

<!--
<div id="footpanel">
    <ul id="mainpanel">
		<li>
		<marquee><a href="#">Breaking News :
		<?php
			$this->db->where('staff_no','20003');
			$this->db->order_by('id','DESC');
			$Q=$this->db->get('social_status',5);
			$data=$Q->result_array();
			foreach($data as $rec){
				echo $rec['content'].'-';
			}
		?>
		</a></marquee>
		</li>
    </ul>
</div>
-->


<script type="text/javascript"> 
$(document).ready(function(){

	//Adjust panel height
	$.fn.adjustPanel = function(){ 
		$(this).find("ul, .subpanel").css({ 'height' : 'auto'}); //Reset subpanel and ul height
		
		var windowHeight = $(window).height(); //Get the height of the browser viewport
		var panelsub = $(this).find(".subpanel").height(); //Get the height of subpanel	
		var panelAdjust = windowHeight - 100; //Viewport height - 100px (Sets max height of subpanel)
		var ulAdjust =  panelAdjust - 25; //Calculate ul size after adjusting sub-panel (27px is the height of the base panel)
		
		if ( panelsub >= panelAdjust ) {	 //If subpanel is taller than max height...
			$(this).find(".subpanel").css({ 'height' : panelAdjust }); //Adjust subpanel to max height
			$(this).find("ul").css({ 'height' : ulAdjust}); //Adjust subpanel ul to new size
		}
		else if ( panelsub < panelAdjust ) { //If subpanel is smaller than max height...
			$(this).find("ul").css({ 'height' : 'auto'}); //Set subpanel ul to auto (default size)
		}
	};
	
	//Execute function on load
	$("#chatpanel").adjustPanel(); //Run the adjustPanel function on #chatpanel
	$("#alertpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel
	
	//Each time the viewport is adjusted/resized, execute the function
	$(window).resize(function () { 
		$("#chatpanel").adjustPanel();
		$("#alertpanel").adjustPanel();
	});
	
	//Click event on Chat Panel + Alert Panel	
	$("#chatpanel a:first, #alertpanel a:first").click(function() { //If clicked on the first link of #chatpanel and #alertpanel...
		if($(this).next(".subpanel").is(':visible')){ //If subpanel is already active...
			$(this).next(".subpanel").hide(); //Hide active subpanel
			$("#footpanel li a").removeClass('active'); //Remove active class on the subpanel trigger
		}
		else { //if subpanel is not active...
			$(".subpanel").hide(); //Hide all subpanels
			$(this).next(".subpanel").toggle(); //Toggle the subpanel to make active
			$("#footpanel li a").removeClass('active'); //Remove active class on all subpanel trigger
			$(this).toggleClass('active'); //Toggle the active class on the subpanel trigger
		}
		return false; //Prevent browser jump to link anchor
	});
	
	//Click event outside of subpanel
	$(document).click(function() { //Click anywhere and...
		$(".subpanel").hide(); //hide subpanel
		$("#footpanel li a").removeClass('active'); //remove active class on subpanel trigger
	});
	$('.subpanel ul').click(function(e) { 
		e.stopPropagation(); //Prevents the subpanel ul from closing on click
	});
	
	//Delete icons on Alert Panel
	$("#alertpanel li").hover(function() {
		$(this).find("a.delete").css({'visibility': 'visible'}); //Show delete icon on hover
	},function() {
		$(this).find("a.delete").css({'visibility': 'hidden'}); //Hide delete icon on hover out
	});
	
});
</script>

</body>
</html>
