<style>
    .ui_tpicker_hour_label{margin:0 0 0em 0;font-weight:50;font-size:14px;}
    .ui_tpicker_time_label{margin:0 0 0em 0;font-weight:50;font-size:14px;}
    .ui_tpicker_minute_label{margin:0 0 0em 0;font-weight:50;font-size:14px;}
    .ui_tpicker_second_label{margin:0 0 0em 0;font-weight:50;font-size:14px;}
</style>

<script>
$(function(){
	set_datetimepicker('fmdt');
	set_datetimepicker('todt');

	$('#fmdt').val('<?php echo date('Y-m-d');?> 00:00:00');
	$('#todt').val('<?php echo date('Y-m-d');?> 23:59:59');

	$('#gps_id_sb').change(function(){reloadMarkers();$('#tb_sum').DataTable().ajax.reload();});
	$('#fmdt').change(function(){reloadMarkers();$('#tb_sum').DataTable().ajax.reload();});
	$('#todt').change(function(){reloadMarkers();$('#tb_sum').DataTable().ajax.reload();});
	
});
</script>
<section>
	<div class="row">
      <div class="col-4 col-12-medium">
       		<select id="gps_id_sb" name="gps_id_sb">
       			<?php 
       			     foreach ($gps_q as $row):
                          echo '<option value='.$row["gps_id"].'>'.$row["name"].'</option>'; 
                     endforeach;
                ?>
       		</select>
      </div>
      <div class="col-4 col-12-medium">
       		<input type="text" name="fmdt" id="fmdt" value="" placeholder="From">
      </div>
      <div class="col-4 col-12-medium">
       		<input type="text" name="todt" id="todt" value="" placeholder="To">
      </div>
   </div>
	<div >
		<style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                    width: 100%;
                    height: 500px;
                  }
        </style>
       	
        <section id="map" ></section>
        <!-- Replace the value of the key parameter with your own API key. -->

    	<script>

    			  var map; 
    			  var markers = [];
    			  var infoWindow;
    			  
                    function initMap() {
                          map = new google.maps.Map(document.getElementById('map'), {
                                                      center: new google.maps.LatLng(22.3330918, 114.2),
                                                      zoom: 11}
                         							);
                          infoWindow = new google.maps.InfoWindow;
                          
                    }

                  function reloadMarkers() {

                	  for (var i=0; i<markers.length; i++) {
                	        markers[i].setMap(null);
                	    }
                	  markers = [];
                      
                	  ajax_post_api('<?php echo base_url().'/'.$class.'/select';?>',
                	  						{gps_id:$('#gps_id_sb').val(),fmdt:$('#fmdt').val(),todt:$('#todt').val()},
                        	  			  function (data){
                                        	  //console.log(data.data);
                                        	  var data_ar = data.data;
                                        	  for(var i = 0; i < data_ar.length; i++) {
                                            	  
                                        		    var obj = data_ar[i];
													set_Marker(obj);
                                        		    console.log(obj.track_id);
                                        		    
                                        		}//for(var i = 0; i < data.length; i++) {
                            	  			  },
                        	  		      function (data){}
                        	  		    );
                	}//reloadMarkers
                	
    				function set_Marker(obj){
    					var id = obj.track_id;
                        var name = obj.cur_datetime;
                        var address = obj.gps_name;
                        var type = obj.type;
                        var point = new google.maps.LatLng(
                            parseFloat(obj.latitude),
                            parseFloat(obj.longitude));
          
                        var infowincontent = document.createElement('div');
                        var strong = document.createElement('strong');
                        
                        strong.textContent = name
                        infowincontent.appendChild(strong);
                        infowincontent.appendChild(document.createElement('br'));
          				/*
                        var text = document.createElement('text');
                        text.textContent = address
                        infowincontent.appendChild(text);
                        */
                        var marker = new google.maps.Marker({
                          map: map,
                          position: point,
                          label: 'I'
                        });

                        google.maps.event.addListener(marker, 'click', function(){
                            infoWindow.close(); // Close previously opened infowindow
                            infoWindow.setContent(infowincontent);
                            infoWindow.open(map, marker);
                        });
    
                        markers.push(marker);
        				}//set_Marker

        				setTimeout(function(){
        			    	reloadMarkers();
            			    },2000);
    	</script>

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjlz8aaSVF3LoLDJ6qHhntDgGbg7OAQBk&callback=initMap">
    	</script>
        
	</div>
</section>	


<section>
	<div class="features">
<style>
div.dataTables_wrapper {
        width: 100%;
    }
</style>

<script>
$( function() {

	var table = $('#tb_sum').DataTable( {
        "width": "100%",
        dom: 'B<"clear">lfrtip',
        select: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "ajax": {
            "url": "<?php echo base_url().'/'.$class.'/select';?>",
            "type": "POST",
            "data":function ( d ) {
                d.gps_id = $('#gps_id_sb').val();
                d.fmdt = $('#fmdt').val();
                d.todt = $('#todt').val();
            }
        },
        "columns": [
            <?php foreach ($columns as $key => $column):
                        echo '{"data" : "'.$key.'"},';
                  endforeach;
            ?>
        ],
        "columnDefs": [
            <?php  $i = 0;
                   foreach ($columns as $key => $column):
                    if($column["type"] == "select"):
                        echo '{"targets": [ '.$i.' ],';
                        echo '"visible": false,';
                        echo '"searchable": false},';
                    endif;
                    $i++;
                   endforeach;?>
        ],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    } );
	/*
	$('#tb_sum tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
	*/
	    
});
</script>
<?php include 'control.php'; ?>
<table id="tb_sum" class="display" style="width:100%" >
        <thead>
            <tr>
            	<?php foreach ($columns as $key => $column):
            	           echo '<th>'.lang($lang_path.'.'.$key).'</th>';
                      endforeach;
                ?>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <?php foreach ($columns as $key => $column):
                            echo '<th>'.lang($lang_path.'.'.$key).'</th>';
                      endforeach;
                ?>
            </tr>
        </tfoot>
</table>
</div>
</section>	