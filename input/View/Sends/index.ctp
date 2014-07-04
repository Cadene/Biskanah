<div class="sends index">
	<h2><?php echo __('Sends'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('from'); ?></th>
			<th><?php echo $this->Paginator->sort('to'); ?></th>
			<th><?php echo $this->Paginator->sort('pc_res1'); ?></th>
			<th><?php echo $this->Paginator->sort('pc_res2'); ?></th>
			<th><?php echo $this->Paginator->sort('pc_res3'); ?></th>
			<th><?php echo $this->Paginator->sort('activate'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sends as $send): ?>
	<tr>
		<td><?php echo h($send['Send']['id']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['from']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['to']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['pc_res1']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['pc_res2']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['pc_res3']); ?>&nbsp;</td>
		<td><?php echo h($send['Send']['activate']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $send['Send']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $send['Send']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $send['Send']['id']), null, __('Are you sure you want to delete # %s?', $send['Send']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Send'), array('action' => 'add')); ?></li>
	</ul>
</div>
