<div class="rankusers index">
	<h2><?php echo __('Rankusers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('kill'); ?></th>
			<th><?php echo $this->Paginator->sort('steal'); ?></th>
			<th><?php echo $this->Paginator->sort('evo'); ?></th>
			<th><?php echo $this->Paginator->sort('lost'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rankusers as $rankuser): ?>
	<tr>
		<td><?php echo h($rankuser['Rankuser']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($rankuser['User']['id'], array('controller' => 'users', 'action' => 'view', $rankuser['User']['id'])); ?>
		</td>
		<td><?php echo h($rankuser['Rankuser']['kill']); ?>&nbsp;</td>
		<td><?php echo h($rankuser['Rankuser']['steal']); ?>&nbsp;</td>
		<td><?php echo h($rankuser['Rankuser']['evo']); ?>&nbsp;</td>
		<td><?php echo h($rankuser['Rankuser']['lost']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $rankuser['Rankuser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rankuser['Rankuser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rankuser['Rankuser']['id']), null, __('Are you sure you want to delete # %s?', $rankuser['Rankuser']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rankuser'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
