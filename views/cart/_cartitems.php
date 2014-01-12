<?php
/*
 * This file is used in a renderPartial() to display the cart within another view
 * Because our cart is pulled from the component, we can render from anywhere
 *
 * If our controller set intEditMode to be true, then this becomes an edit form to let the user change qty
 */
  if (!isset($model)) $model = Yii::app()->shoppingcart;
?>

  <?php foreach ( $model->cartItems as $item ) : ?>
    <tr class="cart-item row-fluid">
      <td class="span2 item-img">
          <?php if ($item->product->ProductPhotos) { ?>
          <img src="<?php echo $item->product->ProductPhotos[0]['image']; ?>" style='max-width: 128px' />
      </td>
      <td class="span3 item-description">
          <?php } ?>
          <a href="<?php echo $item->Link; ?>"><?=  _xls_truncate($item->description, 65, "...\n", true); ?></a>
      </td>
      <td class="span2 item-price">
        <?= ($item->discount) ? sprintf("<strike>%s</strike> ", _xls_currency($item->sell_base))._xls_currency($item->sell_discount) : _xls_currency($item->sell);  ?>
      </td>
      <td class="span2 item-quantity">
      <?php
        if (isset($this->intEditMode) && $this->intEditMode)
          echo CHtml::textField(CHtml::activeId($item,'qty')."_".$item->id,$item->qty,array('class'=>'cart_qty_box'));
          else echo $item->qty;
      ?>    
      </td>
      <td class="span3 item-subtotal">
      <?= _xls_currency($item->sell_total) ?>
      </td>
    </tr>
  <?php endforeach; ?>
