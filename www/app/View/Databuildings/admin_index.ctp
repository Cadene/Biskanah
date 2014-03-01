<div class="databuildings index">
	<h2><?php echo __('Databuildings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lvl'); ?></th>
			<th><?php echo $this->Paginator->sort('res1'); ?></th>
			<th><?php echo $this->Paginator->sort('res2'); ?></th>
			<th><?php echo $this->Paginator->sort('res3'); ?></th>
			<th><?php echo $this->Paginator->sort('prod1'); ?></th>
			<th><?php echo $this->Paginator->sort('prod2'); ?></th>
			<th><?php echo $this->Paginator->sort('prod3'); ?></th>
			<th><?php echo $this->Paginator->sort('struct'); ?></th>
			<th><?php echo $this->Paginator->sort('conso'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($databuildings as $databuilding): ?>
	<tr>
		<td><?php echo h($databuilding['Databuilding']['id']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['lvl']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['res1']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['res2']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['res3']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['prod1']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['prod2']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['prod3']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['struct']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['conso']); ?>&nbsp;</td>
		<td><?php echo h($databuilding['Databuilding']['time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $databuilding['Databuilding']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $databuilding['Databuilding']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $databuilding['Databuilding']['id']), null, __('Are you sure you want to delete # %s?', $databuilding['Databuilding']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Databuilding'), array('action' => 'add')); ?></li>
	</ul>
</div>
