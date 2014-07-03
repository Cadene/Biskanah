<div class="rankteams index">
	<h2><?php echo __('Rankteams'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th><?php echo $this->Paginator->sort('kill'); ?></th>
			<th><?php echo $this->Paginator->sort('steal'); ?></th>
			<th><?php echo $this->Paginator->sort('evo'); ?></th>
			<th><?php echo $this->Paginator->sort('lost'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rankteams as $rankteam): ?>
	<tr>
		<td><?php echo h($rankteam['Rankteam']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rankteam['Team']['name'], array('controller' => 'teams', 'action' => 'view', $rankteam['Team']['id'])); ?>
		</td>
		<td><?php echo h($rankteam['Rankteam']['kill']); ?>&nbsp;</td>
		<td><?php echo h($rankteam['Rankteam']['steal']); ?>&nbsp;</td>
		<td><?php echo h($rankteam['Rankteam']['evo']); ?>&nbsp;</td>
		<td><?php echo h($rankteam['Rankteam']['lost']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rankteam['Rankteam']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rankteam['Rankteam']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rankteam['Rankteam']['id']), null, __('Are you sure you want to delete # %s?', $rankteam['Rankteam']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rankteam'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
