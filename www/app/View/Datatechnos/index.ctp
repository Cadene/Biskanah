<div class="datatechnos index">
	<h2><?php echo __('Datatechnos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('lvl'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('res1'); ?></th>
			<th><?php echo $this->Paginator->sort('res2'); ?></th>
			<th><?php echo $this->Paginator->sort('res3'); ?></th>
			<th><?php echo $this->Paginator->sort('time'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($datatechnos as $datatechno): ?>
	<tr>
		<td><?php echo h($datatechno['Datatechno']['id']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['lvl']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['type']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['res1']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['res2']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['res3']); ?>&nbsp;</td>
		<td><?php echo h($datatechno['Datatechno']['time']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $datatechno['Datatechno']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $datatechno['Datatechno']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $datatechno['Datatechno']['id']), null, __('Are you sure you want to delete # %s?', $datatechno['Datatechno']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Datatechno'), array('action' => 'add')); ?></li>
	</ul>
</div>
