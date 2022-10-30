<?php 
$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);
?>
<script src="<?php echo base_url();?>/implements/js/chartjs/chart.js"></script>

<section>
	<div class="row" >
    
    	<div class="col-12 col-12-small">
    		<select id="cur_month" name="cur_month">
    			<?php 
    			      for($i = 0; $i < count($months); $i++):
    			         echo '<option value="'.($i+1).'" '.(($i+1)==date('m')?'selected':'').' >'.$months[$i].'</option>';
    			      endfor;
    			?>
    		</select>
    	</div>	
    	<div class="col-6 col-12-small">
    		<h3>GPS Event Count</h3>
    		<canvas id="gec"></canvas>
    	</div>
    	<div class="col-6 col-12-small">
    		<h3>GPS Track Count</h3>
    		<canvas id="gtc"></canvas>
    	</div>
    	
	</div>
</section>	

<section>
	<div class="row" >

		<div class="col-6 col-12-small">
    		<h3>Engine Online / Offline Count</h3>
    		<canvas id="eoc"></canvas>
    	</div>
    	<div class="col-6 col-12-small">

    	</div>
	</div>
</section>	

<script type="text/javascript">
	var gec_ctx = document.getElementById('gec').getContext('2d');
	var gtc_ctx = document.getElementById('gtc').getContext('2d');
	var eoc_ctx = document.getElementById('eoc').getContext('2d');

	var gec_chart = null;
	var gtc_chart = null;
	var eoc_chart = null;

	gec_chart = new Chart(gec_ctx, {
		type: 'horizontalBar',
        data: null,
	    options: {responsive: false}
	});

	gtc_chart = new Chart(gtc_ctx, {
		type: 'horizontalBar',
        data: null,
	    options: {responsive: false}
	});

	eoc_chart = new Chart(eoc_ctx, {
		type: 'horizontalBar',
        data: null,
	    options: {responsive: false}
	});

	function reloadGPSEvent(){
		ajax_post_api('<?php echo base_url();?>/mainctr/getGPSEventCount',
					  {month:$('#cur_month').val()},
					  function(data){
						  if(data.havedata == true){
							  gec_chart.data = data.chartdata;
							  gec_chart.update();
						  }
    	    	      },
					  function(data){}
					  );
		}

	function reloadGPSTrack(){
		ajax_post_api('<?php echo base_url();?>/mainctr/getGPStrackCount',
					  {month:$('#cur_month').val()},
					  function(data){
						  if(data.havedata == true){
							  gtc_chart.data = data.chartdata;
							  gtc_chart.update();
						  }
    	    	      },
					  function(data){}
					  );
		}

	function reloadEOC(){
		ajax_post_api('<?php echo base_url();?>/mainctr/geteoc',
					  {month:$('#cur_month').val()},
					  function(data){
						  if(data.havedata == true){
							  eoc_chart.data = data.chartdata;
							  eoc_chart.update();
						  }
    	    	      },
					  function(data){}
					  );
		}

	setTimeout(function(){
		reloadGPSEvent();
		reloadGPSTrack();
		reloadEOC();
		}
	,1000);

	
	$(function(){
		$('#cur_month').change(function(){
			reloadGPSEvent();
			reloadGPSTrack();
			reloadEOC();
			});
		
		});
	
</script>






