<div class="a2bs form">
<?php echo $this->Form->create('A2b'); ?>
	<fieldset>
		<legend><?php echo __('Edit A2b'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('from');
		echo $this->Form->input('to');
		echo $this->Form->input('type');
		echo $this->Form->input('resource_id');
		echo $this->Form->input('begin');
		echo $this->Form->input('finish');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('A2b.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('A2b.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List A2bs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs Units'), array('controller' => 'a2bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2bs Unit'), array('controller' => 'a2bs_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
