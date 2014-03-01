<div class="databuildings form">
<?php echo $this->Form->create('Databuilding'); ?>
	<fieldset>
		<legend><?php echo __('Edit Databuilding'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('lvl');
		echo $this->Form->input('res1');
		echo $this->Form->input('res2');
		echo $this->Form->input('res3');
		echo $this->Form->input('prod1');
		echo $this->Form->input('prod2');
		echo $this->Form->input('prod3');
		echo $this->Form->input('struct');
		echo $this->Form->input('conso');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Databuilding.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Databuilding.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Databuildings'), array('action' => 'index')); ?></li>
	</ul>
</div>
