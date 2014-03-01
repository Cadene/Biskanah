<div class="buildings view">
<h2><?php echo __('Building'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($building['Building']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Camp'); ?></dt>
		<dd>
			<?php echo $this->Html->link($building['Camp']['name'], array('controller' => 'camps', 'action' => 'view', $building['Camp']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($building['Building']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lvl'); ?></dt>
		<dd>
			<?php echo h($building['Building']['lvl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Field'); ?></dt>
		<dd>
			<?php echo h($building['Building']['field']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Building'), array('action' => 'edit', $building['Building']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Building'), array('action' => 'delete', $building['Building']['id']), null, __('Are you sure you want to delete # %s?', $building['Building']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtbuildings'), array('controller' => 'dtbuildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtbuilding'), array('controller' => 'dtbuildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dttechnos'), array('controller' => 'dttechnos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dttechno'), array('controller' => 'dttechnos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtunits'), array('controller' => 'dtunits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtunit'), array('controller' => 'dtunits', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Dtbuildings'); ?></h3>
	<?php if (!empty($building['Dtbuilding'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Finish'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($building['Dtbuilding'] as $dtbuilding): ?>
		<tr>
			<td><?php echo $dtbuilding['id']; ?></td>
			<td><?php echo $dtbuilding['building_id']; ?></td>
			<td><?php echo $dtbuilding['finish']; ?></td>
			<td><?php echo $dtbuilding['begin']; ?></td>
			<td><?php echo $dtbuilding['type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dtbuildings', 'action' => 'view', $dtbuilding['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dtbuildings', 'action' => 'edit', $dtbuilding['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dtbuildings', 'action' => 'delete', $dtbuilding['id']), null, __('Are you sure you want to delete # %s?', $dtbuilding['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dtbuilding'), array('controller' => 'dtbuildings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Dttechnos'); ?></h3>
	<?php if (!empty($building['Dttechno'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Techno Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Finish'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($building['Dttechno'] as $dttechno): ?>
		<tr>
			<td><?php echo $dttechno['id']; ?></td>
			<td><?php echo $dttechno['techno_id']; ?></td>
			<td><?php echo $dttechno['building_id']; ?></td>
			<td><?php echo $dttechno['finish']; ?></td>
			<td><?php echo $dttechno['begin']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dttechnos', 'action' => 'view', $dttechno['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dttechnos', 'action' => 'edit', $dttechno['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dttechnos', 'action' => 'delete', $dttechno['id']), null, __('Are you sure you want to delete # %s?', $dttechno['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dttechno'), array('controller' => 'dttechnos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Dtunits'); ?></h3>
	<?php if (!empty($building['Dtunit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th><?php echo __('Finish'); ?></th>
		<th><?php echo __('Num'); ?></th>
		<th><?php echo __('Num Ready'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($building['Dtunit'] as $dtunit): ?>
		<tr>
			<td><?php echo $dtunit['id']; ?></td>
			<td><?php echo $dtunit['unit_id']; ?></td>
			<td><?php echo $dtunit['building_id']; ?></td>
			<td><?php echo $dtunit['begin']; ?></td>
			<td><?php echo $dtunit['finish']; ?></td>
			<td><?php echo $dtunit['num']; ?></td>
			<td><?php echo $dtunit['num_ready']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dtunits', 'action' => 'view', $dtunit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dtunits', 'action' => 'edit', $dtunit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dtunits', 'action' => 'delete', $dtunit['id']), null, __('Are you sure you want to delete # %s?', $dtunit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dtunit'), array('controller' => 'dtunits', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
