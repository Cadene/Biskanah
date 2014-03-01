<div class="teams form">
<?php echo $this->Form->create('Team'); ?>
	<fieldset>
		<legend><?php echo __('Edit Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('tag');
		echo $this->Form->input('desc');
		echo $this->Form->input('created_by');
		echo $this->Form->input('rank_pts');
		echo $this->Form->input('rank_units');
		echo $this->Form->input('rank_biskanah');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'admin_delete', $this->Form->value('Team.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Team.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'admin_index')); ?></li>
		<li><?php echo $this->Html->link(__('List Invits'), array('controller' => 'invits', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invit'), array('controller' => 'invits', 'action' => 'admin_add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankteams'), array('controller' => 'rankteams', 'admin_action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankteam'), array('controller' => 'rankteams', 'admin_action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'admin_index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'admin_add')); ?> </li>
	</ul>
</div>
