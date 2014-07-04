<div class="worlds form">
<?php echo $this->Form->create('World'); ?>
	<fieldset>
		<legend><?php echo __('Add World'); ?></legend>
	<?php
		echo $this->Form->input('x');
		echo $this->Form->input('y');
		echo $this->Form->input('type');
		echo $this->Form->input('occupied');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Worlds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
	</ul>
</div>
