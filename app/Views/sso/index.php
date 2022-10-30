<html>
	<head>
		<title>Car GPS System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
	</head>
<body>
	<?php include __DIR__ .'/../script.php';?>

<script>
         /** Callback for SSO.
       * Called by init() and login()
       * @param reponse the JSON returned by SSO. See Syno SSO Dev Guide.
       */     
       function authCallback(reponse) {
          console.log(JSON.stringify(reponse));
          if (reponse.status == 'login') {
             //console.log('logged');
             ajax_post_nonlogin(
                     			'<?php echo base_url(); ?>/ssoctr/checklogin'
                     			,{data:JSON.stringify(reponse)}
                     			,function(data){
                     				
                         				if(data.login == 1){
                         						gen_noty_mess('welcome back!','success');
                     							setTimeout(function(){redirection(data.message)},3000);
                     					}
                     					else{gen_noty_mess(data.message,'error');}
                     			 }
                     			,function(data){gen_noty_mess(data.message,'error');}
                     			);
          }
          else {
             console.log('not logged ' + reponse.status);
             //if($(location).attr('href') != '<?php echo base_url(); ?>')
            //	 redirection('<?php echo base_url(); ?>');
          }
       }
         
       SYNOSSO.init({
          oauthserver_url: '<?php echo getenv('oauthserver_url'); ?>',
          app_id: '<?php echo getenv('app_id');; ?>',
          redirect_uri: '<?php echo getenv('redirect_uri');?>', //no idea what this is :)
          callback: authCallback
       });
</script>
	
	
<script type="text/javascript">

	$(function(){
		
        $("#loginbt").click(function () {
        	SYNOSSO.login();
        });
        $("#logoutbt").click(function () {
        	SYNOSSO.logout();
        	location.href = "<?php echo base_url().'/ssoctr/logout';?>";
        });
        
	});
</script>	
<!-- Wrapper -->
<div id="wrapper">

	<!-- Main -->
	<div id="main">
		<div class="inner">	
		<section>
			<div class="row" >
   				<div class="col-12 col-12-small">
            		<h2>SSO Login</h2>
            	</div>
            </div>	
         </section>   
         
         <section>
         	<div class="row" >	
         		<div class="col-12 col-12-small">
                	<a href="#"  id="loginbt" class="a-button icon solid fa-sign-in-alt" >Login</a>
                </div>
         	</div>
         </section>   
         
         <section>
         	<div class="row" >	
         		<div class="col-12 col-12-small">
                	<a href="#"  id="logoutbt" class="a-button icon solid fa-sign-out-alt" >Logout</a>
                </div>
         	</div>
         </section>   
         </div>
    </div>
</div>

<!---------------- Theme -------------------------->
<link rel="stylesheet" href="<?php echo base_url();; ?>/implements/theme/assets/css/main.css" />

<script src="<?php echo base_url();; ?>/implements/theme/assets/js/browser.min.js"></script>
<script src="<?php echo base_url();; ?>/implements/theme/assets/js/breakpoints.min.js"></script>
<script src="<?php echo base_url();; ?>/implements/theme/assets/js/util.js"></script>
<script src="<?php echo base_url();; ?>/implements/theme/assets/js/main.js"></script>
<!---------------- End of Theme ------------------->

</body>

</html>