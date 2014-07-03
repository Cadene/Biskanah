<div class="sends form">
<?php echo $this->Form->create('Send'); ?>
	<fieldset>
		<legend><?php echo __('Add Send'); ?></legend>
	<?php
		echo $this->Form->input('from');
		echo $this->Form->input('to');
		echo $this->Form->input('pc_res1');
		echo $this->Form->input('pc_res2');
		echo $this->Form->input('pc_res3');
		echo $this->Form->input('activate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sends'), array('action' => 'index')); ?></li>
	</ul>
</div>
