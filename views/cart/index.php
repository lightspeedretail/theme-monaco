<?php
/*
  LightSpeed Web Store
 
  NOTICE OF LICENSE
 
  This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@lightspeedretail.com <mailto:support@lightspeedretail.com>
 * so we can send you a copy immediately.
   
 * @copyright  Copyright (c) 2011 Xsilva Systems, Inc. http://www.lightspeedretail.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 
 */

/**
 * template Edit Cart display
 *
 *
 *
 */

$form = $this->beginWidget('CActiveForm', array(
  'id'=>'ShoppingCart',
  'action'=>array('cart/updatecart'),

));?>
<div class='container-fluid'>

  <table class="cart-table" cellspacing="0">
    <thead class="row-fluid cart-header">
      <tr>
        <th class="span5 item-description">Item</th>
        <th class="span2 item-price"><?= Yii::t('cart','Price'); ?></th>
        <th class="span2 item-quantity"><?= Yii::t('cart','Qty'); ?></th>
        <th class="span3 item-subtotal"><?= Yii::t('cart','Subtotal'); ?></th>
      </tr>
    </thead>
    <tbody class="row-fluid">
  <?php
  /*
   * This file is used in a renderPartial() to display the cart within another view
   * Because our cart is pulled from the component, we can render from anywhere
   *
   * If our controller set intEditMode to be true, then this becomes an edit form to let the user change qty
   */
      if (!isset($model)) $model = Yii::app()->shoppingcart;
  ?>

  <?php $this->renderPartial('/cart/_cartitems'); ?>
    </tbody>
    <tfoot class="row-fluid cart-adjust">
      <tr>
        <td class="span5 text-left">
        <?php echo CHtml::ajaxButton(
          Yii::t('cart', 'Update Cart'),
          array('cart/updatecart'),
          array('data'=>'js:$("#ShoppingCart").serialize()',
            'type'=>'POST',
            'dataType'=>'json',
            'success' => 'js:function(data){
                            if (data.action=="alert") {
                              alert(data.errormsg);
                  } else if (data.action=="success") {
                     location.reload();
                  }}'
          ),
          array('class'=>'update-cart-btn')); ?>
          <?php echo CHtml::ajaxButton(
          Yii::t('cart', 'Clear Cart'),
          array('cart/clearcart'),
          array('data'=>array(),
            'type'=>'POST',
            'dataType'=>'json',
            'success' => 'js:function(data){
                            if (data.action=="alert") {
                              alert(data.errormsg);
                  } else if (data.action=="success") {
                     location.reload();
                  }}'
          ),
          array('class'=>'clear-cart-btn'),
          array('confirm'=>Yii::t('cart',"Are you sure you want to erase your cart items?"))); ?>
        </td>
        <td class="span5 text-right item-foot-label" colspan="2"><?= Yii::t('cart','Subtotal'); ?></td>
        <td class="span2 item-foot-price"><?= _xls_currency($model->subtotal); ?></td>
      </tr>
  <?php if($model->TaxTotal && Yii::app()->params['TAX_INCLUSIVE_PRICING']=='0'): ?>
    <?php foreach($model->Taxes as $tax=>$taxvalue): ?>
      <?php if($taxvalue): ?>
      <tr>
        <td class="span5">&nbsp;</td>
        <td class="span5 text-right item-foot-label" colspan="2"><?= $tax; ?></td>
        <td class="span2 item-foot-price"><?= _xls_currency($taxvalue); ?></td>
      </tr>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>
      <tr class="slimrow">
        <td class="span5">&nbsp;</td>
        <td class="span5 text-right item-foot-label" colspan="2"><?= Yii::t('cart','Shipping'); ?></td>
        <td class="span2 item-foot-price"><?= _xls_currency($model->shipping_sell); ?></td>
      </tr>
      <tr class="slimrow">
        <td class="span5">&nbsp;</td>
        <td class="span5 text-right item-foot-label" colspan="2"><?= Yii::t('cart',"Total"); ?> </td>
        <td class="span2 item-foot-price"><?= _xls_currency($model->total); ?></td>
      </tr>
    <?php if($model->PromoCode): ?>
      <tr class="slimrow">
        <td class="span5">&nbsp;</td>
        <td class="span5 item-foot-label promoCode"><?= Yii::t('cart',"Promo Code {code} Applied",array('{code}'=>"<strong>".$model->PromoCode."</strong>")); ?></td>
      </tr>    
    <?php endif; ?>
      <tr class="row-buttons">
        <td class="span12">
        <?php echo CHtml::link(Yii::t('cart','Checkout'),array('cart/checkout'), array('class' => 'checkout big-button')) ?>
        <?= CHtml::tag('div',array(
          'id'=>'shoppingcartcontinue',
          'class'=>'span4 checkoutlink',
          'style' => 'float: right;',
          'onClick'=>'js:window.location.href="'. $this->returnUrl.'"'),
          Yii::t('cart','Continue Shopping'));
        ?>
        </td>
      </tr>
    </tfoot>
  </table>

</div><!-- .container-fluid -->
<?php $this->endWidget();


/* This is our sharing box, which remains hidden until used */
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
  'id'=>'CartShare',
  'options'=>array(
    'title'=>Yii::t('wishlist','Share my Cart'),
    'autoOpen'=>false,
    'modal'=>'true',
    'width'=>'380',
    'height'=>(Yii::app()->user->isGuest ? '580' : '430'),
    'scrolling'=>'yes',
    'resizable'=>false,
    'position'=>'center',
    'draggable'=>false,
  ),
));
$this->renderPartial('/cart/_sharecart', array('model'=>$CartShare));
$this->endWidget('zii.widgets.jui.CJuiDialog');




