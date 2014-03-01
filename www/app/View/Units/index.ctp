<div class="units index">
	<h2><?php echo __('Units'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('num'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($units as $unit): ?>
	<tr>
		<td><?php echo h($unit['Unit']['id']); ?>&nbsp;</td>
		<td><?php echo h($unit['Unit']['type']); ?>&nbsp;</td>
		<td><?php echo h($unit['Unit']['num']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $unit['Unit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $unit['Unit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $unit['Unit']['id']), null, __('Are you sure you want to delete # %s?', $unit['Unit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Unit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List A2 Bs Units'), array('controller' => 'a2_bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2 Bs Unit'), array('controller' => 'a2_bs_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('controller' => 'camps_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Units'), array('controller' => 'd_t_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Unit'), array('controller' => 'd_t_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
