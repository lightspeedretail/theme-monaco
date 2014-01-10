<div class='header'>

<!-- 	<div class='mobile-menu-btn visible-phone'>
		<i></i>
		<i></i>
		<i></i>
	</div> -->


	<h3>
		<?php echo Yii::app()->theme->config->headerSurtitle; ?>
	</h3>
	<h1>
		<span><?= _xls_get_conf('STORE_NAME') ?></span>
	</h1>
	<h3>
		<?php echo Yii::app()->theme->config->headerSubtitle; ?>
	</h3>
	<div class="visible-tablet visible-phone span3 search_bar">
		<?php echo CHtml::beginForm(Yii::app()->createUrl('search/results'),'get'); ?>
		<!-- <span class="search_left"><img class="spyglass" src="<?= Yii::app()->theme->baseUrl; ?>/css/images/spyglass.png"></span> -->
		<span class="search_box"><?php
			$this->widget('bootstrap.widgets.TbTypeahead',array(
				'name'=>'q',
				'id'=>'xlsSearch',
				'htmlOptions'=>array('autocomplete'=>'off','placeholder'=>Yii::t('global','SEARCH').'...'),
				'options'=>array(
					'minChars'=>2,
					'autoFill'=>false,
					'source'=>'js:function (query, process) {
						$.get("'.Yii::app()->controller->createUrl("search/live").'",{q: query},function(jsdata) {
							response = $.parseJSON(jsdata);
							var data = new Array();
							data.push("'.Yii::app()->controller->createUrl("search/results").'?q="+query+"|search for "+query);
							for(var key in response.options)
								data.push(key+"|"+response.options[key]);
							process(data);
						 });}',
					'onchange'=>'js:function(value) {
	                    alert("enter");
						}',
					'highlighter'=>'js:function(item) {
						var parts = item.split("|");
						parts.shift();
						var part = parts.join("|");
						var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&");
						return parts.join("|").replace(new RegExp("(" + query + ")", "ig"), function ($1, match) {
					        return "<strong>" + match + "</strong>"
					      })
						}',
					'updater'=>'js:function(item) {
						var parts = item.split("|");
						window.location.href=(parts.shift());
						}',
				))); ?>
		</span>
		</form>
	</div>

</div>