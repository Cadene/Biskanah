<div class="assistsUnits index">
	<h2><?php echo __('Assists Units'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('assist_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unit_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assistsUnits as $assistsUnit): ?>
	<tr>
		<td><?php echo h($assistsUnit['AssistsUnit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assistsUnit['Assist']['id'], array('controller' => 'assists', 'action' => 'view', $assistsUnit['Assist']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assistsUnit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $assistsUnit['Unit']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assistsUnit['AssistsUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assistsUnit['AssistsUnit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assistsUnit['AssistsUnit']['id']), null, __('Are you sure you want to delete # %s?', $assistsUnit['AssistsUnit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Assists'), array('controller' => 'assists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
