<div class="messages form">
<?php echo $this->Form->create('Message'); ?>
	<fieldset>
		<legend><?php echo __('Add Message'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('content');
		echo $this->Form->input('sent');
		echo $this->Form->input('read');
		echo $this->Form->input('to');
		echo $this->Form->input('from');
		echo $this->Form->input('archive');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index')); ?></li>
	</ul>
</div>
