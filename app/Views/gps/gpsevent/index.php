
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
            "type": "POST"
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