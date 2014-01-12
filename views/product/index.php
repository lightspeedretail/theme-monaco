<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'product'
));

//Note we used form-named DIVs with the Yii CHtml::tag() command so our javascript can update fields when choosing matrix items
?>
	<div id="product_details" class="viewport">
		<div class="row-fluid">
	        <div class="span4">
		        <div id="photos">
			        <?= $this->renderPartial('/product/_photos', array('model'=>$model), true); ?>
	            </div>
	            <div class="row-fluid">
		            <?php 
		            	if(_xls_get_conf('SHOW_SHARING')) {
				            echo $this->renderPartial('/site/_sharing_tools',array('product'=>$model),true);
		            	}
					?>		            	
	            </div>
	        </div>

	        <div class="span7">
	            <div class="row productheader">
	                <h1 class="title"><?= CHtml::tag('div',array('id'=>CHtml::activeId($model,'title')),$model->Title); ?></h1>
					<?php if(isset($model->family)): ?>
						<h2 class="brand">By: <?= CHtml::link($model->family->family,$model->family->Link) ?></h2>
					<?php endif; ?>
		            <?php if (_xls_get_conf('SHOW_TEMPLATE_CODE', true)): ?>
	                    <h3 class="code"><?= CHtml::tag('div',array('id'=>CHtml::activeId($model,'code')),$model->code); ?></h3>
	                <?php endif; ?>

		            <?= CHtml::tag('div',array('id'=>CHtml::activeId($model,'FormattedPrice'),'class'=>'price'),$model->Price); ?>

		            <?= CHtml::tag('div',array('id'=>CHtml::activeId($model,'FormattedRegularPrice').'_wrap','class'=>'price_reg',
							'style'=>(!$model->SlashedPrice ? 'display:none' : '')),
				            Yii::t('product', 'Regular Price').": ".
					            CHtml::tag('span',array('id'=>CHtml::activeId($model,'FormattedRegularPrice'),
						            'class'=>'price_slash'),$model->SlashedPrice));
					?>

		            <?= CHtml::tag('div',array('id'=>CHtml::activeId($model,'InventoryDisplay'),'class'=>'stock'),
			            $model->InventoryDisplay); ?>

	            </div>
				
				<div class="row">
		            <?= CHtml::tag('div',
	                	array('id'=>CHtml::activeId($model,'description_long'),'class'=>''),
	                	$model->WebLongDescription); ?>
    			</div>

		        <?php if (_xls_get_conf('USE_SHORT_DESC'))
			        echo CHtml::tag('div',
				        array('id'=>CHtml::activeId($model,'description_short'),'class'=>'row description'),
			            $model->WebShortDescription);
			    ?>
			    
	            <?php if ($model->IsMaster): ?>
	                <div class="row">
	                    <?= $this->renderPartial('/product/_matrixdropdown', array('form'=>$form,'model'=>$model), true); ?>
	                </div>
	            <?php endif; ?>

	            <?php if (!_xls_get_conf('DISABLE_CART', false)): ?>
		            <div class="row">
			            <?php if (_xls_get_conf('ENABLE_WISH_LIST'))
				            echo CHtml::tag('div',array(
					            'id'=>'addToWishList',
					            'class'=>'wishlist span5',
					            'onClick'=>CHtml::ajax(array(
						            'url'=>array('wishlist/add'),
						            'data'=>array('id'=>$model->id,
							            'qty'=>'js:$("#'.CHtml::activeId($model,'intQty').'").val()',
							            'size'=>'js:$("#SelectSize option:selected").val()',
							            'color'=>'js:$("#SelectColor option:selected").val()'),
						            'type'=>'POST',
						            'success' => 'function(data) {
					                if (data=="multiple")
					                    $("#WishitemShare").dialog("open");
					                 else alert(data); }'
					            )),
				            ),CHtml::link(Yii::t('product', 'Add to Wish List'), '#'));
			            ?>

			            <div class="span1" <?php echo (_xls_get_conf('SHOW_QTY_ENTRY') ? '' : 'style="display:none"'); ?>>
					            <?php echo $form->labelEx($model,'intQty'); ?>
					            <?php echo $form->textField($model,'intQty'); ?>
			            </div>

			            <?= CHtml::tag('div',array(
				            'class'=>'addcart span5',
				            'id'=>'addToCart',
				            'onClick'=>CHtml::ajax(array(
					            'url'=>array('cart/AddToCart'),
					            //If we are viewing a matrix product, Add To Cart needs to pass selected options, otherwise just our model id
					            'data'=>($model->IsMaster ?
						            'js:{"'.'product_size'.'": $("#SelectSize option:selected").val(),
							            "'.'product_color'.'": $("#SelectColor option:selected").val(),
							            "'.'id'.'": '.$model->id.',
							            "'.'qty'.'": $("#'.CHtml::activeId($model,'intQty').'").val() }'
						            : array('id'=>$model->id,'qty'=>'js:$("#'.CHtml::activeId($model,'intQty').'").val()')),
					            'type'=>'POST',
					            'dataType'=>'json',
					            'success' => 'js:function(data){
				                    if (data.action=="alert") {
				                      alert(data.errormsg);
									} else if (data.action=="success") {
										'.(_xls_get_conf('AFTER_ADD_CART') ?'window.location.href="'.$this->createUrl("/cart").'"' : 'location.reload()').'

									}}'
				            )),
			            ),CHtml::link(Yii::t('product', 'Add to Cart'), '#'));
			            ?>
					</div>

		            <div class="row">
			            <div class="span11">
				            <?php
				            $this->widget('zii.widgets.grid.CGridView', array(
					            'id' => 'autoadd',
					            'dataProvider' => $model->autoadd(),
					            'showTableOnEmpty'=>false,
					            'selectableRows'=>0,
					            'emptyText'=>'',
					            'summaryText' => Yii::t('global',
						            'The following related products will be added to your cart automatically with this purchase:'),
					            'hideHeader'=>false,
					            'columns' => array(
						            'SliderImageTag:html',
						            'TitleTag:html',
						            'Price',
					            ),
				            ));
				            ?>
			            </div>
		            </div>

	            <?php endif; ?>



	        </div>
		</div><!-- end of top row -->

		<div class="row-fluid">
	        

	        <div class="facebook_comments">
		        <?php if(_xls_facebook_login() && _xls_get_conf('FACEBOOK_COMMENTS')): ?>
		        <h2><?= Yii::t('product', 'Comments about this product')?></h2>
			       <?php  $this->widget('ext.yii-facebook-opengraph.plugins.Comments', array(
				        'href' => $this->CanonicalUrl,
			        )); ?>
				<?php endif; ?>
	        </div>



		</div><!-- end of middle row -->

	    <div class="row-fluid">
	        <div class="span10">
				<?php
					$this->widget('ext.JCarousel.JCarousel', array(
						'dataProvider' => $model->related(),
						'thumbUrl' => '$data->MiniImage',
						'imageUrl' => '$data->Link',
						'summaryText' => Yii::t('global',
							'Other items you may be interested in:'),
						'emptyText'=>'',
						'titleText' => '$data->Title',
						'captionText' => '$data->Title."<br>"._xls_currency($data->sell)',
						'target' => 'do-not-delete-this',
						//'wrap' => 'circular',
						'visible' => true,
						'skin' => 'slider',
						'clickCallback'=>'window.location.href=itemSrc;'
					));
				?>
	        </div>
	    </div>

	</div>

<?php $this->endWidget(); ?>


<?php

/* This is our add to wish list box, which remains hidden until used */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'WishitemShare',
    'options'=>array(
	    'title'=>Yii::t('wishlist','Add to Wish List'),
	    'autoOpen'=>false,
	    'modal'=>'true',
	    'width'=>'330',
	    'height'=>'250',
	    'scrolling'=>'no',
	    'resizable'=>false,
	    'position'=>'center',
	    'draggable'=>false,
    ),
));
echo $this->renderPartial('/wishlist/_addtolist', array('model'=>$WishlistAddForm,'objProduct'=>$model) ,true);
$this->endWidget('zii.widgets.jui.CJuiDialog');

