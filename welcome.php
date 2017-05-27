<?php 

/*
 * Name   : Chat 
 * Lang   : Php ANd Js 
 * Author : Ayman alaiwah
 * Fb     : wwww.fb.com/ProgAymanAlaiwah
 * GitHub : www.github.com/ProgAymanAlaiwah
*/
session_start();
require_once('config.php'); 



if(count(explode('?',$_SERVER['REQUEST_URI'],2)) > 1)
{
    $title= explode('?',$_SERVER['REQUEST_URI'],2)[1];
}else 
{
	$title = "Home";
}

require_once('include/header.inc.php');

if(count(explode('?',$_SERVER['REQUEST_URI'],2)) > 1)
{
    require_once('chat.php');
	require_once('include/footer.inc.php');

}
else
{
   ?>
  	<section class="container">
  		<div class="example">
  			<p><?php echo $_SERVER['REQUEST_URI']?>?<span>NameChatRoom</span></p>
  		</div>
  	</section>
   </body>
</html>
   <?php
}

