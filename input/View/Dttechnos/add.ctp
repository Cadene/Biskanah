<div class="dttechnos form">
<?php echo $this->Form->create('Dttechno'); ?>
	<fieldset>
		<legend><?php echo __('Add Dttechno'); ?></legend>
	<?php
		echo $this->Form->input('techno_id');
		echo $this->Form->input('building_id');
		echo $this->Form->input('finish');
		echo $this->Form->input('begin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dttechnos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Technos'), array('controller' => 'technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
