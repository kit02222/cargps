<!---------------- Jquery----------------------- -->
<script src="<?php echo base_url(); ?>/implements/js/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>/implements/js/jquery/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/jquery/jquery-ui.css">
<script src="<?php echo base_url(); ?>/implements/js/main.js"></script>
<!---------------- End of Jquery---------------- -->

<!---------------- Jquery UI----------------------- -->
<script src="<?php echo base_url(); ?>/implements/js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/jquery-ui/jquery-ui.css">
<!---------------- End of Jquery UI---------------- -->

<!---------------- Datatable----------------------- -->
<script src="<?php echo base_url(); ?>/implements/js/DataTables/datatables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/DataTables/datatables.css">
<script src="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/js/dataTables.rowReorder.min.js"></script>
<script src="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/js/dataTables.select.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/DataTables/DataTables-1.10.20/css/select.dataTables.min.css">
<!---------------- End of Datatable---------------- -->

<!-- ------Date Time Picker------ -->
<script src="<?php echo base_url(); ?>/implements/js/datetimepicker/src/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>/implements/js/datetimepicker/src/jquery-ui-sliderAccess.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>/implements/js/datetimepicker/src/jquery-ui-timepicker-addon.css" rel="stylesheet"></link>
<!-- ------End of Date Time Picker------ -->

<!---------------- ajax loader----------------------- -->
<script src="<?php echo base_url(); ?>/implements/js/loader/loader.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/loader/loader.css">
<!---------------- end of ajax loader----------------------- -->

<!---------------- noty------------- -->
<script src="<?php echo base_url(); ?>/implements/js/noty/packaged/jquery.noty.packaged.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/implements/js/noty/buttons.css">  
<!---------------- end of noty------------- -->

<!-- ------------- SSO-------------------------- -->
<script src="<?php echo base_url();?>/implements/js/sso/synology-sso.js"></script>
<!-- ------------- End of SSO-------------------------- -->




<script>
	var home_url = '<?php echo base_url().'/'; ?>';
    function gen_noty_mess(text,type) {
        
        var n = noty({
            text        : text,
            type        : type,
            dismissQueue: true,
            closeWith   : ['click', 'backdrop'],
            modal       : true,
            layout      : 'center',
            theme       : 'defaultTheme',
            maxVisible  : 10
        });
        //console.log('html: ' + n.options.id);
        return n;
    }

    function gen_noty_confirm(text, type , OkMethod , CancelMethod , YesMess , NoMess ) {
        var n = noty({
            text        : text,
            type        : type,
            dismissQueue: true,
            layout      : 'center',
            modal		: true,
            theme       : 'defaultTheme',
            buttons     : [
                {addClass: 'btn btn-primary', text: YesMess, onClick: function ($noty) {
                    $noty.close();
                    OkMethod();
                }
                },
                {addClass: 'btn btn-danger', text: NoMess, onClick: function ($noty) {
                    $noty.close();
                    CancelMethod();
                }
                }
            ]
        });
        //console.log('html: ' + n.options.id);
		return n;
     }
	
    function gen_jdialog_mess(divname,html,title_name){

    	var winW = $(window).width() - 180;
        var winH = $(window).height() - 180;

        $( "#"+divname ).html(html);
        //$( "#"+divname ).attr('title',title_name);
    	$( "#"+divname ).dialog({
  	      modal: true,  	 
  	      title:title_name,
  	      height: winH,
          width: winW,     
  	      buttons: {
  	        Close: function() {
  	          $( this ).dialog( "close" );
  	        }
  	      }
  	    });
  	    
     }

	function gen_jdialog_confirm(divname,html,title_name,yesf,nof,yesmess,nomess){

		var winW = $(window).width() - 180;
        var winH = $(window).height() - 180;

        $( "#"+divname ).html(html);
        //$( "#"+divname ).attr('title',title_name);
		 $( "#"+divname ).dialog({
			  title:title_name,
		      height: winH,
	          width: winW,   
		      modal: true,
		      buttons: [
		    	  { text: yesmess,
		    	  click: function() {
			           yesf();
				      //$( this ).dialog( "close" );
			        }},
		        {text:nomess,
		        click: function() {
		           nof(); 
		          $( this ).dialog( "close" );
			        }
			      }
				       ]
		    });
		

	}

	var block_loader;
	
    
   	
</script>

