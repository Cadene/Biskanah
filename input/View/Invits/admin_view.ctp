<div class="invits view">
<h2><?php echo __('Invit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invit['Invit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invit['User']['id'], array('controller' => 'users', 'action' => 'view', $invit['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($invit['Team']['name'], array('controller' => 'teams', 'action' => 'view', $invit['Team']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From User'); ?></dt>
		<dd>
			<?php echo h($invit['Invit']['from_user']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($invit['Invit']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Read'); ?></dt>
		<dd>
			<?php echo h($invit['Invit']['read']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invit'), array('action' => 'edit', $invit['Invit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invit'), array('action' => 'delete', $invit['Invit']['id']), null, __('Are you sure you want to delete # %s?', $invit['Invit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Invits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
