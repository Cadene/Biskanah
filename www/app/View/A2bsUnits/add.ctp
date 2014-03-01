<div class="a2bsUnits form">
<?php echo $this->Form->create('A2bsUnit'); ?>
	<fieldset>
		<legend><?php echo __('Add A2bs Unit'); ?></legend>
	<?php
		echo $this->Form->input('a2b_id');
		echo $this->Form->input('unit_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List A2bs Units'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List A2bs'), array('controller' => 'a2bs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2b'), array('controller' => 'a2bs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
