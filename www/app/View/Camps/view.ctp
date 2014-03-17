<div class="camps view">
<h2><?php echo __('Camp'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('World'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camp['World']['id'], array('controller' => 'worlds', 'action' => 'view', $camp['World']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camp['User']['id'], array('controller' => 'users', 'action' => 'view', $camp['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resource'); ?></dt>
		<dd>
			<?php echo $this->Html->link($camp['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $camp['Resource']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pts'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['pts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Loyalty'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['loyalty']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['last_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod1'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['prod1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod2'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['prod2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod3'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['prod3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unread Reports'); ?></dt>
		<dd>
			<?php echo h($camp['Camp']['unread_reports']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Camp'), array('action' => 'edit', $camp['Camp']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Camp'), array('action' => 'delete', $camp['Camp']['id']), null, __('Are you sure you want to delete # %s?', $camp['Camp']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Worlds'), array('controller' => 'worlds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New World'), array('controller' => 'worlds', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('controller' => 'camps_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reports'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Buildings'); ?></h3>
	<?php if (!empty($camp['Building'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Camp Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Lvl'); ?></th>
		<th><?php echo __('Field'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camp['Building'] as $building): ?>
		<tr>
			<td><?php echo $building['id']; ?></td>
			<td><?php echo $building['camp_id']; ?></td>
			<td><?php echo $building['type']; ?></td>
			<td><?php echo $building['lvl']; ?></td>
			<td><?php echo $building['field']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'buildings', 'action' => 'view', $building['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'buildings', 'action' => 'edit', $building['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'buildings', 'action' => 'delete', $building['id']), null, __('Are you sure you want to delete # %s?', $building['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Camps Units'); ?></h3>
	<?php if (!empty($camp['CampsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Camp Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camp['CampsUnit'] as $campsUnit): ?>
		<tr>
			<td><?php echo $campsUnit['id']; ?></td>
			<td><?php echo $campsUnit['camp_id']; ?></td>
			<td><?php echo $campsUnit['unit_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'camps_units', 'action' => 'view', $campsUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'camps_units', 'action' => 'edit', $campsUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'camps_units', 'action' => 'delete', $campsUnit['id']), null, __('Are you sure you want to delete # %s?', $campsUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Reports'); ?></h3>
	<?php if (!empty($camp['Report'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Camp Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Read'); ?></th>
		<th><?php echo __('Pts Att'); ?></th>
		<th><?php echo __('Pts Def'); ?></th>
		<th><?php echo __('Archive'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($camp['Report'] as $report): ?>
		<tr>
			<td><?php echo $report['id']; ?></td>
			<td><?php echo $report['camp_id']; ?></td>
			<td><?php echo $report['content']; ?></td>
			<td><?php echo $report['created']; ?></td>
			<td><?php echo $report['read']; ?></td>
			<td><?php echo $report['pts_att']; ?></td>
			<td><?php echo $report['pts_def']; ?></td>
			<td><?php echo $report['archive']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'reports', 'action' => 'view', $report['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'reports', 'action' => 'edit', $report['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reports', 'action' => 'delete', $report['id']), null, __('Are you sure you want to delete # %s?', $report['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Report'), array('controller' => 'reports', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
