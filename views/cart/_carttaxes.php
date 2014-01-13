<?php //if($model->TaxTotal && Yii::app()->params['TAX_INCLUSIVE_PRICING']=='0'): ?>
<!--	--><?php //foreach($model->Taxes as $tax=>$taxvalue): ?>
<!--		--><?php //if($taxvalue): ?>
<!--            <div class='offset8 span4'>-->
<!--                --><?php //= $tax; ?><!-- --><?php //= _xls_currency($taxvalue); ?>
<!--            </div>-->
<!--		--><?php //endif; ?>
<!--	--><?php //endforeach; ?>
<?php //endif; ?>
<?php if($model->TaxTotal && Yii::app()->params['TAX_INCLUSIVE_PRICING']=='0'): ?>
    <?php foreach($model->Taxes as $tax=>$taxvalue): ?>
        <?php if($taxvalue): ?>
            <tr>
                <td class="span5">&nbsp;</td>
                <td class="span5 textalign-right item-foot-label" colspan="2"><?= $tax; ?></td>
                <td class="span2 textalign-right item-foot-price"><?= _xls_currency($taxvalue); ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>