<div class="buildings form">
<?php echo $this->Form->create('Building'); ?>
	<fieldset>
		<legend><?php echo __('Add Building'); ?></legend>
	<?php
		echo $this->Form->input('camp_id');
		echo $this->Form->input('type');
		echo $this->Form->input('lvl');
		echo $this->Form->input('field');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Buildings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtbuildings'), array('controller' => 'dtbuildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtbuilding'), array('controller' => 'dtbuildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dttechnos'), array('controller' => 'dttechnos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dttechno'), array('controller' => 'dttechnos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtunits'), array('controller' => 'dtunits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtunit'), array('controller' => 'dtunits', 'action' => 'add')); ?> </li>
	</ul>
</div>
