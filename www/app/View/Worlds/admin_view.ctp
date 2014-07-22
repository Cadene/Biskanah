<div class="worlds view">
<h2><?php echo __('World'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($world['World']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('X'); ?></dt>
		<dd>
			<?php echo h($world['World']['x']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Y'); ?></dt>
		<dd>
			<?php echo h($world['World']['y']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($world['World']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Occupied'); ?></dt>
		<dd>
			<?php echo h($world['World']['occupied']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit World'), array('action' => 'edit', $world['World']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete World'), array('action' => 'delete', $world['World']['id']), null, __('Are you sure you want to delete # %s?', $world['World']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Worlds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New World'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Camps'); ?></h3>
	<?php if (!empty($world['Camp'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('World Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Resource Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Pts'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Loyalty'); ?></th>
		<th><?php echo __('Last Update'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Prod1'); ?></th>
		<th><?php echo __('Prod2'); ?></th>
		<th><?php echo __('Prod3'); ?></th>
		<th><?php echo __('Unread Reports'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($world['Camp'] as $camp): ?>
		<tr>
			<td><?php echo $camp['id']; ?></td>
			<td><?php echo $camp['world_id']; ?></td>
			<td><?php echo $camp['user_id']; ?></td>
			<td><?php echo $camp['resource_id']; ?></td>
			<td><?php echo $camp['name']; ?></td>
			<td><?php echo $camp['pts']; ?></td>
			<td><?php echo $camp['type']; ?></td>
			<td><?php echo $camp['loyalty']; ?></td>
			<td><?php echo $camp['last_update']; ?></td>
			<td><?php echo $camp['created']; ?></td>
			<td><?php echo $camp['prod1']; ?></td>
			<td><?php echo $camp['prod2']; ?></td>
			<td><?php echo $camp['prod3']; ?></td>
			<td><?php echo $camp['unread_reports']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'camps', 'action' => 'view', $camp['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'camps', 'action' => 'edit', $camp['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'camps', 'action' => 'delete', $camp['id']), null, __('Are you sure you want to delete # %s?', $camp['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
