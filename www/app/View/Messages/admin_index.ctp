<div class="messages index">
	<h2><?php echo __('Messages'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('sent'); ?></th>
			<th><?php echo $this->Paginator->sort('read'); ?></th>
			<th><?php echo $this->Paginator->sort('to'); ?></th>
			<th><?php echo $this->Paginator->sort('from'); ?></th>
			<th><?php echo $this->Paginator->sort('archive'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($messages as $message): ?>
	<tr>
		<td><?php echo h($message['Message']['id']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['title']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['content']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['sent']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['read']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['to']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['from']); ?>&nbsp;</td>
		<td><?php echo h($message['Message']['archive']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'admin_view', $message['Message']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'admin_edit', $message['Message']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'admin_delete', $message['Message']['id']), null, __('Are you sure you want to delete # %s?', $message['Message']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Message'), array('action' => 'admin_add')); ?></li>
	</ul>
</div>