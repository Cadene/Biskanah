<div class="technos form">
<?php echo $this->Form->create('Techno'); ?>
	<fieldset>
		<legend><?php echo __('Edit Techno'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('type');
		echo $this->Form->input('lvl');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Techno.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Techno.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Technos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Technos'), array('controller' => 'd_t_technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Techno'), array('controller' => 'd_t_technos', 'action' => 'add')); ?> </li>
	</ul>
</div>
