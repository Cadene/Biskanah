<div class="resources form">
<?php echo $this->Form->create('Resource'); ?>
	<fieldset>
		<legend><?php echo __('Edit Resource'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('res1');
		echo $this->Form->input('res2');
		echo $this->Form->input('res3');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Resource.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Resource.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Resources'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List A2 Bs'), array('controller' => 'a2_bs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2 B'), array('controller' => 'a2_bs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists'), array('controller' => 'assists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
	</ul>
</div>
