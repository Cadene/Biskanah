<div class="dtunits form">
<?php echo $this->Form->create('Dtunit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Dtunit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('building_id');
		echo $this->Form->input('begin');
		echo $this->Form->input('finish');
		echo $this->Form->input('num');
		echo $this->Form->input('num_ready');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Dtunit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Dtunit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Dtunits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
