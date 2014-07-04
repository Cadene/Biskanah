<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
		echo $this->Form->input('access');
		echo $this->Form->input('desc');
		echo $this->Form->input('diam');
		echo $this->Form->input('plus');
		echo $this->Form->input('token');
		echo $this->Form->input('last_update');
		echo $this->Form->input('team_id');
		echo $this->Form->input('team_access');
		echo $this->Form->input('biskanah');
		echo $this->Form->input('rank_pts');
		echo $this->Form->input('rank_units');
		echo $this->Form->input('unread_msg');
	?>
	</fieldset>

<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invits'), array('controller' => 'invits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invit'), array('controller' => 'invits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankusers'), array('controller' => 'rankusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankuser'), array('controller' => 'rankusers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technos'), array('controller' => 'technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
	</ul>
</div>
