
	function redirection(url){
		$(location).attr('href', url);
	}
	
	function reload_page(){
		location.reload();
	}
	
	function reload_page_with_second(){
		setTimeout(function () {
			reload_page();
        	}, 2000);
	}
	
	function set_datetimepicker(field){
		
		var opt={dateFormat: 'yy-mm-dd',
	               showSecond: true,
	               timeFormat: 'HH:mm:ss'
	               };
	    
		$('#'+field).datetimepicker(opt);
		
	}
	
	function set_timepicker(field){
		
		$('#'+field).datetimepicker({
			 						  dateFormat: '',
									  timeFormat: 'HH:mm:ss',
									  timeOnly: true 
									});
		
	}
	
	function get_current_datetime(){
		
		var currentdate = new Date(); 
	    return "" + currentdate.getFullYear() + "-"
	                + ((currentdate.getMonth()+1) < 10? '0' : '') + (currentdate.getMonth()+1)  + "-" 
	                + (currentdate.getDate() < 10? '0' : '') + currentdate.getDate() + " "  
	                + (currentdate.getHours() < 10? '0' : '') + currentdate.getHours() + ":"  
	                + (currentdate.getMinutes() < 10? '0' : '') + currentdate.getMinutes() + ":" 
	                + (currentdate.getSeconds() < 10? '0' : '') + currentdate.getSeconds();
	    
	}
	
	function f_fields_chk_space(field_chk_space){
		
		for(var i = 0 ; i <  field_chk_space.length ; i++){
			
			if(hasWhiteSpace($('#'+field_chk_space[i]).val())){
				gen_noty_mess($('#'+field_chk_space[i]).attr('alt')+" - Field can't contain space. ",'error');
				$('#'+field_chk_space[i]).focus();
				return false;
				}

			}
		return true;
	}
	
	function hasWhiteSpace(s) {
		  return /\s/g.test(s);
		}
	
	function f_fields_chk_null(field_chk_null){
		
		for(var i = 0 ; i <  field_chk_null.length ; i++){
			var chk_field = $('#'+field_chk_null[i]).val().replace(/\s+/g, '');
			if(chk_field == ''){
				gen_noty_mess($('#'+field_chk_null[i]).attr('alt')+" -  * Mandatory Field can't empty. ",'error');
				$('#'+field_chk_null[i]).focus();
				return false;
				}

			}
		return true;
	}
	
	function f_field_chk_spc(field_chk_spc){
		
		for(var i = 0 ; i <  field_chk_spc.length ; i++){

			if(check_specialChars_normal($('#'+field_chk_spc[i]).val()) == true){
				gen_noty_mess($('#'+field_chk_spc[i]).attr('alt')+" - Field can't contain special characters.(<>!$^&*()+[]{}?:|'\"\\./~`=) ",'error');
				$('#'+field_chk_spc[i]).focus();
				return false;
				}

			}
		return true;
	}

	 function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
 	}
	 
	 function check_specialChars_normal(string){
	 	 var specialChars = "<>!$^&*()+[]{}?:|'\"\\/~`=";
	     
	 	    for(i = 0; i < specialChars.length;i++){
	 	        if(string.indexOf(specialChars[i]) > -1){
	 	            return true;
	 	        }
	 	    }
	 	    return false;
	 	}
	 
	function open_ajax_loader(){

    	 var options = {classOveride: 'blue-loader', bgColor: '#000'};
		
    	block_loader = new ajaxLoader($('body'), options);

    }

    function close_ajax_loader(){
        
    	block_loader.remove();
    	
    }
    function ajax_post_api(url,data,success,error){

    		$.ajax({
    				type: "POST",
    				url: url,
    				data: data,
    				dataType: "json" ,
    				success: function(data){
    						success(data);
    						},
    				error: function(xhr, textStatus, error){
    						console.log(xhr.statusText);
    						console.log(textStatus);
    						console.log(error);
    						console.log(xhr.responseText);			  
    						} 
    		});

    	}
    
    function ajax_post_nonlogin(url,data,success,error){

	open_ajax_loader();
		$.ajax({
				type: "POST",
				url: url,
				data: data,
				dataType: "json" ,
				success: function(data){
						close_ajax_loader();
						success(data);
						},
				error: function(xhr, textStatus, error){
						console.log(xhr.statusText);
						console.log(textStatus);
						console.log(error);
						console.log(xhr.responseText);			  
						} 
		});

	}

    function ajax_post(url,data,success,error){
		
		$.ajax({
			  type: "POST",
			  url: (home_url+"ssoctr/checkSession"),
			  dataType: "json" ,
			  success: function(logindata){
				  if(logindata.result){
					  
					  open_ajax_loader();
					  $.ajax({
							  type: "POST",
							  url: url,
							  data: data,
							  dataType: "json" ,
							  success: function(data){close_ajax_loader();success(data);},
							  error: function(xhr, textStatus, error){
								  
							      console.log(xhr.statusText);
							      console.log(textStatus);
							      console.log(error);
								  console.log(xhr.responseText);
								  
							  } 
							});
						  
						  
				  }else{
					  gen_noty_mess('Your session is expired.','error');
					  reload_page_with_second();
				  		}
				  },
			  error: function(xhr, textStatus, error){
			      console.log(xhr.statusText);
			      console.log(textStatus);
			      console.log(error);
				  console.log(xhr.responseText);
			  } 
			});
		
	}
	
	function ajax_form(formname,success,error){
		
		$("#"+formname).submit(function(e)
				{
				 
				    var formObj = $(this);
				    var formURL = formObj.attr("action");
				    var formData = formObj.serialize();
				    
				    ajax_post(formURL,formData,success,error);
				    
				    e.preventDefault(); //Prevent Default action. 
				    //e.unbind();
				}); 

	}
	
	function makeid(length) {
		   var result           = '';
		   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		   var charactersLength = characters.length;
		   for ( var i = 0; i < length; i++ ) {
		      result += characters.charAt(Math.floor(Math.random() * charactersLength));
		   }
		   return result;
		}

