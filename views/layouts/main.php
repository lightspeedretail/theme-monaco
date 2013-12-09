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

				<?php echo $this->renderPartial("/site/_header",null,true,false); ?>
			<!-- content (viewport) -->
				<?php echo $content; ?>
			
				<!-- footer -->
				<?php echo $this->renderPartial("/site/_footer",null,true,false); ?>

			</div>
			


		</div>

		<?php echo $this->sharingFooter; ?>

		<?php echo $this->loginDialog; ?>

	</body>
</html>