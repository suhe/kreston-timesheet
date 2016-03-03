<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head><script type="text/javascript">window.NREUM||(NREUM={});NREUM.info = {"beacon":"beacon-1.newrelic.com","errorBeacon":"jserror.newrelic.com","licenseKey":"f11fb5f248","applicationID":"316895","transactionName":"b1FRNhNVDBdUUUdZClYbdw0VegcQdl1dRBdXWF8HExsuAVJTUEkkW1dcFw9ATShaVVpe","queueTime":0,"applicationTime":29,"ttGuid":"FD33E9C5B4FFF8D2","agent":"js-agent.newrelic.com/nr-323.min.js"}</script><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function a(b,c,d){function e(f){if(!c[f]){var g=c[f]={exports:{}};b[f][0].call(g.exports,function(a){var c=b[f][1][a];return e(c?c:a)},g,g.exports,a,b,c,d)}return c[f].exports}for(var f=0;f<d.length;f++)e(d[f]);return e}({"4O2Y62":[function(a,b){function c(a,b){var c=d[a];return c?c.apply(this,b):(e[a]||(e[a]=[]),void e[a].push(b))}var d={},e={};b.exports=c,c.queues=e,c.handlers=d},{}],handle:[function(a,b){b.exports=a("4O2Y62")},{}],YLUGVp:[function(a,b){function c(){var a=m.info=NREUM.info;if(a&&a.agent&&a.licenseKey&&a.applicationID){m.proto="https"===l.split(":")[0]||a.sslForHttp?"https://":"http://",g("mark",["onload",f()]);var b=i.createElement("script");b.src=m.proto+a.agent,i.body.appendChild(b)}}function d(){"complete"===i.readyState&&e()}function e(){g("mark",["domContent",f()])}function f(){return(new Date).getTime()}var g=a("handle"),h=window,i=h.document,j="addEventListener",k="attachEvent",l=(""+location).split("?")[0],m=b.exports={offset:f(),origin:l};i[j]?(i[j]("DOMContentLoaded",e,!1),h[j]("load",c,!1)):(i[k]("onreadystatechange",d),h[k]("onload",c)),g("mark",["firstbyte",f()])},{handle:"4O2Y62"}],loader:[function(a,b){b.exports=a("YLUGVp")},{}]},{},["YLUGVp"]);</script>
        <title><?=$title?></title>
        <link type="text/css" href="<?=base_url();?>templates/login/style/reset.css" rel="Stylesheet" media="screen" />
        <link type="text/css" href="<?=base_url();?>templates/login/style/global.css" rel="Stylesheet" media="screen" />
    </head>
<body>
    
<div class="External-Header">
        <a href="/">
            <img src="<?=base_url()?>/assets/images/logo2.jpg" alt="PerkSpot Discount Program" />
        </a>
    </div>

    <div class="External-HeaderBorder"></div>

    <div class="GlobalBodyContainer">
        <div class="GlobalBodyTop"></div>
        <div class="GlobalBodyLeft">
            <div class="GlobalBodyRight">
                

<div class="Login-Title">
    <h1 style="padding: 35px 0 0 0;">
        Account Staff Login
    </h1>
</div>

<div class="Login-Content">
    <div class="Left">
<form name="loginform" id="loginform" action="<?php echo base_url().'login/user/do_login'; ?>" method="post">

            <table>
                <tr>
                    <td>
                        <label for="Username">NIK</label>
                    </td>
                    <td>
                        <input class="Text" data-val="true" maxlength="5" data-val-required="Enter your email address." id="Username" name="no" type="text" value="" />
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Password">Password</label>
                    </td>
                    <td>
                        <input class="Text" data-val="true" maxlength="15" data-val-required="Enter your password." id="Password" name="password" type="password" />
                        
                    </td>
                </tr>
                <tr>
                    <td></td>
            
                    <td>
                        <a class="ResetPassword" href="#"><?=$this->session->flashdata('error_msg')?></a>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" id="btnSubmit" style="border: 0; padding: 0; background-color: transparent; cursor: pointer; margin-left: -10px;">
                            <span id="spnSubmit" style="padding-left: 42px; width: 105px;" class="Button" tabindex="3">Login</span>
                        </button>  
                    </td>
                </tr>
            </table>
</form>    </div>
    <div class="Right">
        <img src="<?=base_url()?>/assets/images/User_group.png"  />
    </div>
    <div class="Footer">
            <span style="font-weight: bold;"></span>
    </div>
</div>


            </div>
        </div>
        <div class="GlobalBodyBottom"></div>
    </div>
 
</body>
</html>
