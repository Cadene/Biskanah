<div class="dataunits form">
<?php echo $this->Form->create('Dataunit'); ?>
	<fieldset>
		<legend><?php echo __('Add Dataunit'); ?></legend>
	<?php
		echo $this->Form->input('res1');
		echo $this->Form->input('res2');
		echo $this->Form->input('res3');
		echo $this->Form->input('att1');
		echo $this->Form->input('att2');
		echo $this->Form->input('att3');
		echo $this->Form->input('attbat');
		echo $this->Form->input('type');
		echo $this->Form->input('speed');
		echo $this->Form->input('conso');
		echo $this->Form->input('capacity');
		echo $this->Form->input('spy');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dataunits'), array('action' => 'index')); ?></li>
	</ul>
</div>
