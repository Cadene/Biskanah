<div class="worlds index">
	<h2><?php echo __('Worlds'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('x'); ?></th>
			<th><?php echo $this->Paginator->sort('y'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('occupied'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($worlds as $world): ?>
	<tr>
		<td><?php echo h($world['World']['id']); ?>&nbsp;</td>
		<td><?php echo h($world['World']['x']); ?>&nbsp;</td>
		<td><?php echo h($world['World']['y']); ?>&nbsp;</td>
		<td><?php echo h($world['World']['type']); ?>&nbsp;</td>
		<td><?php echo h($world['World']['occupied']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $world['World']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $world['World']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $world['World']['id']), null, __('Are you sure you want to delete # %s?', $world['World']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New World'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
	</ul>
</div>
