<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('access'); ?></th>
			<th><?php echo $this->Paginator->sort('desc'); ?></th>
			<th><?php echo $this->Paginator->sort('diam'); ?></th>
			<th><?php echo $this->Paginator->sort('plus'); ?></th>
			<th><?php echo $this->Paginator->sort('token'); ?></th>
			<th><?php echo $this->Paginator->sort('last_update'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_access'); ?></th>
			<th><?php echo $this->Paginator->sort('biskanah'); ?></th>
			<th><?php echo $this->Paginator->sort('rank_pts'); ?></th>
			<th><?php echo $this->Paginator->sort('rank_units'); ?></th>
			<th><?php echo $this->Paginator->sort('unread_msg'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['access']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['desc']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['diam']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['plus']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['token']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_update']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Team']['name'], array('controller' => 'teams', 'action' => 'view', $user['Team']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['team_access']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['biskanah']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['rank_pts']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['rank_units']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['unread_msg']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
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
