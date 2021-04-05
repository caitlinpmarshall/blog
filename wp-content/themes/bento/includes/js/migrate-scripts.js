
// Scripts used by the admin elements

var $mig = jQuery.noConflict();

$mig(document).ready(function() {
	
	
	// Migrate old theme options into Customizer
	$mig('.notice-migrate-bento-options .button-primary').click(function() { 
		$mig.ajax({
			url: bentoMigrateVars.ajaxurl,
			type: 'POST',
			data: {
				action: 'bento_migrate_customizer_options',
			},
			success: function(response) {
				$mig('.notice-migrate-bento-options').hide(300, function() {
					$mig('.notice-migrate-bento-options-success').show(300);
				});
			},
			error: function(response) {
				alert('Shoot! Something went wrong. Please try again or contact support@satoristudio.net');
			}
		});
	});
	
		
});