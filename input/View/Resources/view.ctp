<div class="resources view">
<h2><?php echo __('Resource'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res1'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['res1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res2'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['res2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res3'); ?></dt>
		<dd>
			<?php echo h($resource['Resource']['res3']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Resource'), array('action' => 'edit', $resource['Resource']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Resource'), array('action' => 'delete', $resource['Resource']['id']), null, __('Are you sure you want to delete # %s?', $resource['Resource']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2 Bs'), array('controller' => 'a2_bs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2 B'), array('controller' => 'a2_bs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists'), array('controller' => 'assists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related A2 Bs'); ?></h3>
	<?php if (!empty($resource['A2B'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('From'); ?></th>
		<th><?php echo __('To'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Resource Id'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('Finish'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($resource['A2B'] as $a2B): ?>
		<tr>
			<td><?php echo $a2B['id']; ?></td>
			<td><?php echo $a2B['from']; ?></td>
			<td><?php echo $a2B['to']; ?></td>
			<td><?php echo $a2B['type']; ?></td>
			<td><?php echo $a2B['resource_id']; ?></td>
			<td><?php echo $a2B['begin']; ?></td>
			<td><?php echo $a2B['finish']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'a2_bs', 'action' => 'view', $a2B['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'a2_bs', 'action' => 'edit', $a2B['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'a2_bs', 'action' => 'delete', $a2B['id']), null, __('Are you sure you want to delete # %s?', $a2B['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New A2 B'), array('controller' => 'a2_bs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Assists'); ?></h3>
	<?php if (!empty($resource['Assist'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('From'); ?></th>
		<th><?php echo __('On'); ?></th>
		<th><?php echo __('Resource Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($resource['Assist'] as $assist): ?>
		<tr>
			<td><?php echo $assist['id']; ?></td>
			<td><?php echo $assist['from']; ?></td>
			<td><?php echo $assist['on']; ?></td>
			<td><?php echo $assist['resource_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'assists', 'action' => 'view', $assist['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'assists', 'action' => 'edit', $assist['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'assists', 'action' => 'delete', $assist['id']), null, __('Are you sure you want to delete # %s?', $assist['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Camps'); ?></h3>
	<?php if (!empty($resource['Camp'])): ?>
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
	<?php foreach ($resource['Camp'] as $camp): ?>
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
