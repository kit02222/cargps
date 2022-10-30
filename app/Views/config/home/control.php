<a href="#" id="new_bt" class="a-button icon solid fa-plus">New</a>
<a href="#" id="update_bt" class="a-button icon solid fa-plus">Update</a>
<a href="#" id="delete_bt" class="a-button icon solid fa-plus">Delete</a>

<?php ?>
<script>
  $( function() {

	  $('#new_bt').click(function(){get_dialog('i');});
	  $('#update_bt').click(function(){
		  if($('#tb_sum').DataTable().rows( { selected: true } ).count() == 0){
			  gen_noty_mess('<?php echo lang('general_lang.error-003');?>','error');
			  return;
		  }
		  get_dialog('u',$('#tb_sum').DataTable().rows({ selected: true }).data().toArray());
	  });
	  $('#delete_bt').click(function(){
		  if($('#tb_sum').DataTable().rows( { selected: true } ).count() == 0){
			  gen_noty_mess('<?php echo lang('general_lang.error-003');?>','error');
			  return;
		  }
		  get_dialog('d',$('#tb_sum').DataTable().rows({ selected: true }).data().toArray());
		  });
	  
	  function get_dialog(flag, data = []){
		  
		  var dialog_title = (flag == 'i')?"New":((flag == 'u')?"Update":"Delete");
		  //console.log('data: '+JSON.stringify(data));
		  
		  $( "#dialog-is-form" ).attr("title",dialog_title);
		  ajax_post("<?php echo base_url().'/'.$class.'/'?>iud_index",
		    	  {flag:flag,
	    	  	   data:JSON.stringify(data)},
		    	  function(data){
		    		    $("#dialog-is-form").html(data.html);
		    		    $("#dialog-is-form" ).dialog({
		    			      resizable: false,
		    			      height: "auto",
		    			      width: 'auto',
		    			      modal: true,
		    			      fluid: true, //new option
		    			      buttons: {
		    			        "Save": function() {
		    			        	preSaveForm();//from form.php
		    			        },
		    			        Cancel: function() {
		    			          $( this ).dialog( "close" );
		    			        }
		    			      },
		    			      open:function( event, ui ){}
		    			    });
		    		    
		    		  },
		    	 function(data){}
				 );
		  $(".ui-dialog-titlebar").parent().find("span.ui-dialog-title").html(dialog_title);
		  }
	  	
  } );
	  
</script>
  
<div id="dialog-is-form" title="" style="display:none;">
  
</div>  