<div class="technos index">
	<h2><?php echo __('Technos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('lvl'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($technos as $techno): ?>
	<tr>
		<td><?php echo h($techno['Techno']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($techno['User']['id'], array('controller' => 'users', 'action' => 'view', $techno['User']['id'])); ?>
		</td>
		<td><?php echo h($techno['Techno']['type']); ?>&nbsp;</td>
		<td><?php echo h($techno['Techno']['lvl']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $techno['Techno']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $techno['Techno']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $techno['Techno']['id']), null, __('Are you sure you want to delete # %s?', $techno['Techno']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Techno'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Technos'), array('controller' => 'd_t_technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Techno'), array('controller' => 'd_t_technos', 'action' => 'add')); ?> </li>
	</ul>
</div>
