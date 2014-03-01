<div class="rankteams form">
<?php echo $this->Form->create('Rankteam'); ?>
	<fieldset>
		<legend><?php echo __('Add Rankteam'); ?></legend>
	<?php
		echo $this->Form->input('team_id');
		echo $this->Form->input('kill');
		echo $this->Form->input('steal');
		echo $this->Form->input('evo');
		echo $this->Form->input('lost');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rankteams'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
