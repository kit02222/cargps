<script>
function preSaveForm(){
	<?php
	
	$user_name = $session->get('user_id');
	
	//--------checking field----------//
	$check_null_fields = array();
	$check_spc_fields = array();
 	foreach ($columns as $key => $column):
 	   
       if($column["type"] == "display")
     	 continue;
 	
 	   if($column["allow_edit"] == "Y" && $column["allow_null"] == "N"):
 	      array_push($check_null_fields, $key);
 	   endif;
 	   
 	   if($column["allow_edit"] == "Y" && (isset($column["allow_spec"]) && $column["allow_spec"]!="Y")):
 	      array_push($check_spc_fields, $key);
 	   endif;
	   
 	endforeach;
 	
 	echo ''
	//--------end of checking field----------//
	?>

 	var check_null_fields = <?php echo json_encode($check_null_fields);?>;
 	var check_spc_fields = <?php echo json_encode($check_spc_fields);?>;
	
	if(!f_fields_chk_null(check_null_fields))
		return;
	if(!f_field_chk_spc(check_spc_fields))
		return;
	   
	gen_noty_confirm('Confirm Save?',
 			 'warning' ,
 			  function(){
 			    <?php echo (($flag=="i")?'$("#createdt").val(get_current_datetime());':'');?>
 			    <?php echo (($flag=="u")?'$("#modifydt").val(get_current_datetime());':'');?>
 			    <?php echo (($flag=="u")?'$("#modifyby").val(\''.$user_name.'\');':'');?>
 			    <?php echo (($flag=="d")?'$("#iu_form input").prop(\'disabled\', false);':'');?>
 			    $('#iu_form').submit();
	 		   } ,
 			  function(){} ,
 			   'Confirm' ,
 			    'Cancel' );
	    
}

$(function(){

	ajax_form("iu_form",
		    function(data){
	    	if(data.status){
	    		 gen_noty_mess('Saved','success');
		   		 $('#tb_sum').DataTable().ajax.reload();//from index.php
		   		 $('#dialog-is-form').dialog( "close" );//from insert_update.php
	    		}else{
	    		gen_noty_mess(data.message,'error');
		    	}
		   	},
		    function(data){});

	<?php if($flag == "d"): ?>
	$("#iu_form input").prop('disabled', true);
	<?php endif; ?>
	
});
</script>

<?php $action = (($flag=='i')?"insert":(($flag=='u')?"update":"delete"));?>
<form id="iu_form" name="iu_form" action="<?php echo base_url().'/'.$class.'/'.$action;?>" method="post">
      <input type="hidden" id="flag" name="flag" value="<?php echo $flag; ?>" />

      <div class="row gtr-uniform">
      <?php 
            
            $result_q_ar = array();
            if($flag == "u" || $flag == "d"):
                $result_q_ar = (count($result_q->getResult('array')) > 0)?$result_q->getResult('array')[0]:null;
               
            endif;

            foreach ($columns as $key => $column):
                
              if($column["type"] == "display")
                continue;
              
              $value = (isset($result_q_ar[$key])?$result_q_ar[$key]:"");
              if ($column["type"] == "select"):
              
                 $temp_q = $select_q[$column["key"]];
                 echo '<div class="col-6 col-12-xsmall">';
                 echo '<select id="'.$key.'" name="'.$key.'" >';
                 
                 foreach ($temp_q->getResult('array') as $row):
                    echo '<option value="'.$row[$key].'" '.(($row[$key]==$value)?"selected":"").'>'.$row["name"].'</option>';
                 endforeach;
                 
                 echo '</select>';
                 echo '</div>';
              
              elseif ($column["type"] == "checkbox"):  
              
                  echo '<div class="col-6 col-12-xsmall">';
                  echo '<input type="hidden"  name="'.$key.'" value="" >';
                  echo '<input type="checkbox" id="'.$key.'" name="'.$key.'" value="'.$column["value"].'" '.(($value=="Y")?"checked":"").' >';
                  echo '<label for="'.$key.'">'.lang($lang_path.'.'.$key).'</label>';
                  echo '</div>';
              
              else:
                  
                  if($flag=="i"):
                    $value = (in_array($key, array("createby"))?$user_name:"");
                  endif;  
                    
                   echo ($column["size"]>255)?'<div class="col-12">':'<div class="col-6 col-12-xsmall">';
                   echo '<input type="text" id="'.$key.'" name="'.$key.'" value="'.$value.'" size="'.$column["size"].'" maxlength="'.$column["size"].'"  placeholder="'.lang($lang_path.'.'.$key).'"  alt="'.lang($lang_path.'.'.$key).'"  '.(($column["allow_edit"]=="N")?"readonly":"").' /> ';
                   echo '</div>';
                   
                   if(in_array($key, array("apikey","apisecret"))):
                        echo '<div class="col-6 col-12-xsmall">';
                        echo '<a href="#" id="gen_'.$key.'_bt" class="a-button icon solid" onclick="$(\'#'.$key.'\').val(makeid(15));">Gen '.lang($lang_path.'.'.$key).'</a>';
                        echo '</div>';
                   endif;
              endif;  
            endforeach;  
       ?> 	
       </div>
</form>