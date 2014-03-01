<div class="assists form">
<?php echo $this->Form->create('Assist'); ?>
	<fieldset>
		<legend><?php echo __('Add Assist'); ?></legend>
	<?php
		echo $this->Form->input('from');
		echo $this->Form->input('on');
		echo $this->Form->input('resource_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assists'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
