<?php
/**
 * @package AkeebaReleaseSystem
 * @copyright Copyright (c)2010-2012 Nicholas K. Dionysopoulos
 * @license GNU General Public License version 3, or later
 */

defined('_JEXEC') or die();

$this->loadHelper('chameleon');
$this->loadHelper('router');

$Itemid = JRequest::getInt('Itemid',0);
?>
<?php if(version_compare(JVERSION, '1.7.0', 'ge') && $this->params->get('show_page_heading', 1)): ?>
	<h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><?php echo $this->escape($this->params->get('page_title')); ?></h2>
<?php elseif (!version_compare(JVERSION, '1.7.0', 'ge') && $this->params->get('show_page_title', 1)) : ?>
	<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><?php echo $this->escape($this->params->get('page_title')); ?></div>
<?php endif; ?>

<div id="ars-categories-normal">
	<h2><?php echo JText::_('ARS_CATEGORY_NORMAL'); ?></h2>

	<?php if(!empty($this->items['normal'])): ?>
	<?php foreach($this->vgroups as $vgroupID => $vgroupTitle): ?>
	<?php if($vgroupTitle): ?><h3><?php echo $vgroupTitle; ?></h3><?php endif; ?>
	<?php
		foreach($this->items['normal'] as $id => $item):
			$catURL = AKRouter::_('index.php?option=com_ars&view=category&id='.$item->id.'&Itemid='.$Itemid);
			$title = "<a href=\"$catURL\">{$item->title}</a>";
			$params = ArsHelperChameleon::getParams('category');
			@ob_start();
			$this->loadAnyTemplate('site:com_ars/browses/category');
			$contents = ob_get_clean();
			$module = ArsHelperChameleon::getModule($title, $contents, $params);
			echo JModuleHelper::renderModule($module, $params);
		endforeach;
	?>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="ars-noitems">
		<?php echo JText::_('ARS_NO_CATEGORIES'); ?>
	</div>
	<?php endif; ?>
</div>