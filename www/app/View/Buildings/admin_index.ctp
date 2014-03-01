<div class="buildings index">
	<h2><?php echo __('Buildings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('camp_id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('lvl'); ?></th>
			<th><?php echo $this->Paginator->sort('field'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($buildings as $building): ?>
	<tr>
		<td><?php echo h($building['Building']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($building['Camp']['name'], array('controller' => 'camps', 'action' => 'view', $building['Camp']['id'])); ?>
		</td>
		<td><?php echo h($building['Building']['type']); ?>&nbsp;</td>
		<td><?php echo h($building['Building']['lvl']); ?>&nbsp;</td>
		<td><?php echo h($building['Building']['field']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $building['Building']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $building['Building']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $building['Building']['id']), null, __('Are you sure you want to delete # %s?', $building['Building']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Building'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtbuildings'), array('controller' => 'dtbuildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtbuilding'), array('controller' => 'dtbuildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dttechnos'), array('controller' => 'dttechnos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dttechno'), array('controller' => 'dttechnos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtunits'), array('controller' => 'dtunits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtunit'), array('controller' => 'dtunits', 'action' => 'add')); ?> </li>
	</ul>
</div>
