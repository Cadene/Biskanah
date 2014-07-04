<div class="assists index">
	<h2><?php echo __('Assists'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('from'); ?></th>
			<th><?php echo $this->Paginator->sort('on'); ?></th>
			<th><?php echo $this->Paginator->sort('resource_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assists as $assist): ?>
	<tr>
		<td><?php echo h($assist['Assist']['id']); ?>&nbsp;</td>
		<td><?php echo h($assist['Assist']['from']); ?>&nbsp;</td>
		<td><?php echo h($assist['Assist']['on']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assist['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $assist['Resource']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assist['Assist']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assist['Assist']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assist['Assist']['id']), null, __('Are you sure you want to delete # %s?', $assist['Assist']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assist'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
