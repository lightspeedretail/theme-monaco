<div class="span9 clearfix category-images">

	<div class='row1 clearfix'>

		<div class='landscape'>
			<a href='<?php echo Yii::app()->theme->config->topLandscapeUrl ?>'>
				<img src='<?php echo Yii::app()->theme->config->topLandscape ?>' />
			</a>
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
			<a href='<?php echo Yii::app()->theme->config->topPortraitUrl ?>'>
				<img src='<?php echo Yii::app()->theme->config->topPortrait ?>' />
			</a>
			<p>
				<?php echo Yii::app()->theme->config->topPortraitText ?>
			</p>
		</div>
	</div>

	<div class='row2 clearfix'>
		<div class='portrait'>
			<a href='<?php echo Yii::app()->theme->config->bottomPortraitUrl ?>'>
				<img src='<?php echo Yii::app()->theme->config->bottomPortrait ?>' />
			</a>
			<p>
				<?php echo Yii::app()->theme->config->bottomPortraitText ?>
			</p>
		</div>
		<div class='landscape'>
			<a href='<?php echo Yii::app()->theme->config->bottomLandscapeUrl ?>'>
				<img src='<?php echo Yii::app()->theme->config->bottomLandscape ?>' />
			</a>
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
