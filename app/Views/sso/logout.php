<html>
   <head>
   <!-- include Synology SSO js -->
	</head>
	
<body>
	<?php include __DIR__ .'/../script.php';?>
	<script type="text/javascript">
	 
	$(function(){

        $("#logoutbt").click(function () {
        	SYNOSSO.logout();
        	gen_noty_mess('Bye!','success');
        });

        SYNOSSO.init({
            oauthserver_url: '<?php echo getenv('oauthserver_url'); ?>',
            app_id: '<?php echo getenv('app_id');; ?>',
            redirect_uri: '<?php echo getenv('redirect_uri');?>', //no idea what this is :)
            callback: authCallback
         });	

        function authCallback(reponse){
        	if (reponse.status == 'login') {$("#logoutbt").click()};
			setTimeout(function(){redirection('<?php echo base_url();?>')},1000);
        }
        
	});
</script>	

<button id="logoutbt" style="display:none;">Logout</button>

</body>

</html>