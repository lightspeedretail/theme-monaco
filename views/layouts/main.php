<!DOCTYPE html>
<html lang="<?= Yii::app()->language ?>">
	<!-- <head> section -->
	<?php echo $this->renderPartial("/site/_head",null,true,false); ?>

	<body>
		<?php echo $this->sharingHeader; ?>
		<div id="container" class="container-fluid text-center">

			<!-- template header -->
			<div class='col1'>
				<?php echo $this->renderPartial("/site/_navigation",null,true,false); ?>
			</div>

			<div class='col2'>

				<div class='main'>
					<?php echo $this->renderPartial("/site/_header",null,true,false); ?>
				<!-- content (viewport) -->
					<?php echo $content; ?>
				</div>
				
			</div>

			<!-- footer -->
			<?php echo $this->renderPartial("/site/_footer",null,true,false); ?>

		</div>

		<?php echo $this->sharingFooter; ?>

		<?php echo $this->loginDialog; ?>

		
		<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/all.js'); ?>
		<script type="text/javascript">
			(function($) {
				$(function() {
					// script for mobile navigation
					$("ul.visible-phone li a:empty").remove();
					$("ul.visible-phone li a").click(function(event) {
						if ( $(this).siblings("ul.submenu").length > 0 && !$(this).siblings("ul.submenu").is(":visible") ) {
							event.preventDefault();
							$(this).siblings("ul.submenu").slideToggle();
						}
					});
				});
			})(jQuery);
		</script>
	</body>
</html>