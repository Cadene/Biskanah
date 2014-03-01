<div class="dtbuildings index">
	<h2><?php echo __('Dtbuildings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('building_id'); ?></th>
			<th><?php echo $this->Paginator->sort('finish'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dtbuildings as $dtbuilding): ?>
	<tr>
		<td><?php echo h($dtbuilding['Dtbuilding']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dtbuilding['Building']['id'], array('controller' => 'buildings', 'action' => 'view', $dtbuilding['Building']['id'])); ?>
		</td>
		<td><?php echo h($dtbuilding['Dtbuilding']['finish']); ?>&nbsp;</td>
		<td><?php echo h($dtbuilding['Dtbuilding']['begin']); ?>&nbsp;</td>
		<td><?php echo h($dtbuilding['Dtbuilding']['type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dtbuilding['Dtbuilding']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dtbuilding['Dtbuilding']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dtbuilding['Dtbuilding']['id']), null, __('Are you sure you want to delete # %s?', $dtbuilding['Dtbuilding']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Dtbuilding'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
