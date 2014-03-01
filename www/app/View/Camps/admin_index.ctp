<div class="camps index">
	<h2><?php echo __('Camps'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('world_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('resource_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('pts'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('loyalty'); ?></th>
			<th><?php echo $this->Paginator->sort('last_update'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('prod1'); ?></th>
			<th><?php echo $this->Paginator->sort('prod2'); ?></th>
			<th><?php echo $this->Paginator->sort('prod3'); ?></th>
			<th><?php echo $this->Paginator->sort('unread_reports'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camps as $camp): ?>
	<tr>
		<td><?php echo h($camp['Camp']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($camp['World']['id'], array('controller' => 'worlds', 'action' => 'view', $camp['World']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($camp['User']['id'], array('controller' => 'users', 'action' => 'view', $camp['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($camp['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $camp['Resource']['id'])); ?>
		</td>
		<td><?php echo h($camp['Camp']['name']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['pts']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['type']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['loyalty']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['last_update']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['created']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['prod1']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['prod2']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['prod3']); ?>&nbsp;</td>
		<td><?php echo h($camp['Camp']['unread_reports']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $camp['Camp']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $camp['Camp']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $camp['Camp']['id']), null, __('Are you sure you want to delete # %s?', $camp['Camp']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Camp'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Worlds'), array('controller' => 'worlds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New World'), array('controller' => 'worlds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('controller' => 'camps_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
