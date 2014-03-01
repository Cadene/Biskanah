<div class="dataunits index">
	<h2><?php echo __('Dataunits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('res1'); ?></th>
			<th><?php echo $this->Paginator->sort('res2'); ?></th>
			<th><?php echo $this->Paginator->sort('res3'); ?></th>
			<th><?php echo $this->Paginator->sort('att1'); ?></th>
			<th><?php echo $this->Paginator->sort('att2'); ?></th>
			<th><?php echo $this->Paginator->sort('att3'); ?></th>
			<th><?php echo $this->Paginator->sort('attbat'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('speed'); ?></th>
			<th><?php echo $this->Paginator->sort('conso'); ?></th>
			<th><?php echo $this->Paginator->sort('capacity'); ?></th>
			<th><?php echo $this->Paginator->sort('spy'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dataunits as $dataunit): ?>
	<tr>
		<td><?php echo h($dataunit['Dataunit']['id']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['res1']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['res2']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['res3']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['att1']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['att2']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['att3']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['attbat']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['type']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['speed']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['conso']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['capacity']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['spy']); ?>&nbsp;</td>
		<td><?php echo h($dataunit['Dataunit']['time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dataunit['Dataunit']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dataunit['Dataunit']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dataunit['Dataunit']['id']), null, __('Are you sure you want to delete # %s?', $dataunit['Dataunit']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Dataunit'), array('action' => 'add')); ?></li>
	</ul>
</div>
