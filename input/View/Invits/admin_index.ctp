<div class="invits index">
	<h2><?php echo __('Invits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('from_user'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('read'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($invits as $invit): ?>
	<tr>
		<td><?php echo h($invit['Invit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($invit['User']['id'], array('controller' => 'users', 'action' => 'view', $invit['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($invit['Team']['name'], array('controller' => 'teams', 'action' => 'view', $invit['Team']['id'])); ?>
		</td>
		<td><?php echo h($invit['Invit']['from_user']); ?>&nbsp;</td>
		<td><?php echo h($invit['Invit']['created']); ?>&nbsp;</td>
		<td><?php echo h($invit['Invit']['read']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $invit['Invit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $invit['Invit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $invit['Invit']['id']), null, __('Are you sure you want to delete # %s?', $invit['Invit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Invit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
