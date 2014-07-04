<div class="a2bsUnits index">
	<h2><?php echo __('A2bs Units'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('a2b_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unit_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($a2bsUnits as $a2bsUnit): ?>
	<tr>
		<td><?php echo h($a2bsUnit['A2bsUnit']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($a2bsUnit['A2b']['id'], array('controller' => 'a2bs', 'action' => 'view', $a2bsUnit['A2b']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($a2bsUnit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $a2bsUnit['Unit']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $a2bsUnit['A2bsUnit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $a2bsUnit['A2bsUnit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $a2bsUnit['A2bsUnit']['id']), null, __('Are you sure you want to delete # %s?', $a2bsUnit['A2bsUnit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New A2bs Unit'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List A2bs'), array('controller' => 'a2bs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2b'), array('controller' => 'a2bs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
