<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl._xls_get_conf('HEADER_IMAGE')), Yii::app()->baseUrl."/", array('class'=>'logo') ); ?>


 			<div id="side">
               <ul id="acc3" class="accordion">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products </a>
                    <?php
                    echo '<ul >';
                    echo '<div class="mtop"></div>';
                    foreach ($this->MenuTree as $cat) {
                        if ($cat['hasChildren']) {
                            echo '<li>';
                            echo '<a href="'.$cat['link'].'">'.$cat['label'].'</a>';
                            echo '<ul ';
                            if (strpos($this->CanonicalUrl,$cat['link']))
                                echo '>';
                            else if (strpos(Yii::app()->getRequest()->getUrl(),'brand') && ($cat['label']==_xls_get_conf('ENABLE_FAMILIES_MENU_LABEL')))
                                    echo '>';
                                 else echo 'style="">';
                            foreach ($cat['children'] as $cat1) {
                                if ($cat1['hasChildren']) {
                                    echo '<li>';
                                    echo '<a href="'.$cat1['link'].'">'.$cat1['label'].'</a>';
                                    echo '<ul  ';
                                    if (strpos($this->CanonicalUrl,$cat1['link']))
                                        echo '>';
                                    else echo 'style="">';
                                    foreach ($cat1['children'] as $cat2)
                                    {
                                        echo '<li>';
                                        echo '<a href="'.$cat2['link'].'">'.$cat2['label'].'</a>'.'</li>';
                                    }
                                    echo '</ul>';
                                }
                                else {
                                    echo '<li >';
                                    echo $cat1['text'].'</li>';
                                }
                            }
                            echo '</ul>';
                        }
                        else {
                            echo '<li>';
                            echo $cat['text'].'</li>';
                        }
                    }
                    echo '</ul>';?>

                    </li>
                    <?php
                    foreach (CustomPage::model()->toptabs()->findAll() as $arrTab)
                        echo '<li>'.CHtml::link(Yii::t('global',$arrTab->title),$arrTab->Link).'</li>'; ?>

                </ul>
			</div>




<!-- MENU FOR TABLET,MOBILES -->
<?php
function build_submenu($item) {
	if ( !empty($item['hasChildren']) ) {
		echo '<li class=""><a href="'.$item["link"].'">'.$item["text"].'</a>';
		echo '<ul class="">';
		foreach ( $item['children'] as $subitem ) {
			build_submenu($subitem);
		}
		echo '</ul>';
		echo '</li>';
	} else {
		echo '<li><a href="'.$item["link"].'">'.$item["text"].'</a></li>';
	}
}
?>


	<nav class="visible-phone visible-tablet">
		<ul>
			<?php foreach(Category::GetTree() as $item) { ?>
				<?php build_submenu($item); ?>
			<?php } ?>

            <?php
				foreach (CustomPage::model()->toptabs()->findAll() as $arrTab)
				echo '<li class="custom">'.CHtml::link(Yii::t('global',$arrTab->title),$arrTab->Link).'</li>'; 
			?>
		</ul>
	</nav>
<!-- END MENU TABLET,MOBILE -->

<span class='divider'></span>
<div class="bottom-menu">
	<?php echo $this->renderPartial("/site/_search",array(),true); ?>

	<div class="login">
		<?php if(Yii::app()->user->isGuest): ?>
			<?php echo CHtml::link(Yii::t('global', 'Login'), array("site/login")); ?>
			&nbsp;/&nbsp;
			<a href="<?= _xls_site_url('myaccount/edit'); ?>"><?php echo Yii::t('global', 'Register'); ?></a>
		<?php else: ?>
			<?php echo CHtml::link(CHtml::image(Yii::app()->user->profilephoto).Yii::app()->user->firstname, array('/myaccount')); ?>
			&nbsp;&nbsp;/&nbsp;&nbsp;<?php echo CHtml::link(Yii::t('global', 'Logout'), array("site/logout")); ?>
			<?php endif; ?>
	</div>

	<div class="checkoutlink" class="wishlists shoppingcartholder">
		<?php echo CHtml::link(Yii::t('Shopping Cart','n==1#Shopping Cart ({n})|n>1#Shopping Cart ({n})',Yii::app()->shoppingcart->totalItemCount), array('cart/index')) ?>
		<?= $this->renderPartial('/site/_sidecart',null, true); ?>
	</div>

	<?php if(_xls_get_conf('LANG_MENU',0)): ?>
		<div id="langmenu">
			<?php $this->widget('application.extensions.'._xls_get_conf('PROCESSOR_LANGMENU').'.'._xls_get_conf('PROCESSOR_LANGMENU')); ?>
		</div>
	<?php endif; ?>
</div>

















