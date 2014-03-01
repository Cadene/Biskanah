<div class="assistsUnits form">
<?php echo $this->Form->create('AssistsUnit'); ?>
	<fieldset>
		<legend><?php echo __('Add Assists Unit'); ?></legend>
	<?php
		echo $this->Form->input('assist_id');
		echo $this->Form->input('unit_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assists Units'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Assists'), array('controller' => 'assists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
