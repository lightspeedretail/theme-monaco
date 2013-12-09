<div class="span9 clearfix category-images">

	<div class='row1 clearfix'>

		<div class='landscape'>
			<img src='<?php echo Yii::app()->theme->config->topLandscape ?>' />
			<div>
				<div class='content'>
					<i></i>
					<p>
						<span class='line'></span>
						<span><?php echo Yii::app()->theme->config->topLandscapeText ?></span>
						<span class='line'></span>
					</p>
				</div>
			</div>
		</div>

		<div class='portrait'>
			<img src='<?php echo Yii::app()->theme->config->topPortrait ?>' />
			<p>
				<?php echo Yii::app()->theme->config->topPortraitText ?>
			</p>
		</div>
	</div>

	<div class='row2 clearfix'>
		<div class='portrait'>
			<img src='<?php echo Yii::app()->theme->config->bottomPortrait ?>' />
			<p>
				<?php echo Yii::app()->theme->config->bottomPortraitText ?>
			</p>
		</div>
		<div class='landscape'>
			<img src='<?php echo Yii::app()->theme->config->bottomLandscape ?>' />
			<div>
				<div class='content'>
					<i></i>
					<p>
						<span class='line'></span>
						<span><?php echo Yii::app()->theme->config->bottomLandscapeText ?></span>
						<span class='line'></span>
					</p>
				</div>
			</div>
		</div>
		
	</div>

</div>
