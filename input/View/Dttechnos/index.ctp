<div class="dttechnos index">
	<h2><?php echo __('Dttechnos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('techno_id'); ?></th>
			<th><?php echo $this->Paginator->sort('building_id'); ?></th>
			<th><?php echo $this->Paginator->sort('finish'); ?></th>
			<th><?php echo $this->Paginator->sort('begin'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dttechnos as $dttechno): ?>
	<tr>
		<td><?php echo h($dttechno['Dttechno']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($dttechno['Techno']['id'], array('controller' => 'technos', 'action' => 'view', $dttechno['Techno']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($dttechno['Building']['id'], array('controller' => 'buildings', 'action' => 'view', $dttechno['Building']['id'])); ?>
		</td>
		<td><?php echo h($dttechno['Dttechno']['finish']); ?>&nbsp;</td>
		<td><?php echo h($dttechno['Dttechno']['begin']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dttechno['Dttechno']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dttechno['Dttechno']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dttechno['Dttechno']['id']), null, __('Are you sure you want to delete # %s?', $dttechno['Dttechno']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Dttechno'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Technos'), array('controller' => 'technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
