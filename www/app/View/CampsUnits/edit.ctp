<div class="campsUnits form">
<?php echo $this->Form->create('CampsUnit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Camps Unit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('camp_id');
		echo $this->Form->input('unit_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CampsUnit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CampsUnit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
