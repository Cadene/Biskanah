<div class="a2bs index">
	<h2><?php echo __('A2bs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('from'); ?></th>
			<th><?php echo $this->Paginator->sort('to'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('resource_id'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('finish'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($a2bs as $a2b): ?>
	<tr>
		<td><?php echo h($a2b['A2b']['id']); ?>&nbsp;</td>
		<td><?php echo h($a2b['A2b']['from']); ?>&nbsp;</td>
		<td><?php echo h($a2b['A2b']['to']); ?>&nbsp;</td>
		<td><?php echo h($a2b['A2b']['type']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($a2b['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $a2b['Resource']['id'])); ?>
		</td>
		<td><?php echo h($a2b['A2b']['begin']); ?>&nbsp;</td>
		<td><?php echo h($a2b['A2b']['finish']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $a2b['A2b']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $a2b['A2b']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $a2b['A2b']['id']), null, __('Are you sure you want to delete # %s?', $a2b['A2b']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New A2b'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs Units'), array('controller' => 'a2bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2bs Unit'), array('controller' => 'a2bs_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
