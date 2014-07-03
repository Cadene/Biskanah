<div class="units form">
<?php echo $this->Form->create('Unit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Unit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type');
		echo $this->Form->input('num');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Unit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Unit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Units'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List A2 Bs Units'), array('controller' => 'a2_bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2 Bs Unit'), array('controller' => 'a2_bs_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('controller' => 'camps_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Units'), array('controller' => 'd_t_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Unit'), array('controller' => 'd_t_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
