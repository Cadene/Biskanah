<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Access'); ?></dt>
		<dd>
			<?php echo h($user['User']['access']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($user['User']['desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Diam'); ?></dt>
		<dd>
			<?php echo h($user['User']['diam']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plus'); ?></dt>
		<dd>
			<?php echo h($user['User']['plus']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Token'); ?></dt>
		<dd>
			<?php echo h($user['User']['token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Update'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Team']['name'], array('controller' => 'teams', 'action' => 'view', $user['Team']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team Access'); ?></dt>
		<dd>
			<?php echo h($user['User']['team_access']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Biskanah'); ?></dt>
		<dd>
			<?php echo h($user['User']['biskanah']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank Pts'); ?></dt>
		<dd>
			<?php echo h($user['User']['rank_pts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank Units'); ?></dt>
		<dd>
			<?php echo h($user['User']['rank_units']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unread Msg'); ?></dt>
		<dd>
			<?php echo h($user['User']['unread_msg']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invits'), array('controller' => 'invits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invit'), array('controller' => 'invits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankusers'), array('controller' => 'rankusers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankuser'), array('controller' => 'rankusers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technos'), array('controller' => 'technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Camps'); ?></h3>
	<?php if (!empty($user['Camp'])): ?>
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
	<?php foreach ($user['Camp'] as $camp): ?>
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
<div class="related">
	<h3><?php echo __('Related Invits'); ?></h3>
	<?php if (!empty($user['Invit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('From User'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Read'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Invit'] as $invit): ?>
		<tr>
			<td><?php echo $invit['id']; ?></td>
			<td><?php echo $invit['user_id']; ?></td>
			<td><?php echo $invit['team_id']; ?></td>
			<td><?php echo $invit['from_user']; ?></td>
			<td><?php echo $invit['created']; ?></td>
			<td><?php echo $invit['read']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invits', 'action' => 'view', $invit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invits', 'action' => 'edit', $invit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invits', 'action' => 'delete', $invit['id']), null, __('Are you sure you want to delete # %s?', $invit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Invit'), array('controller' => 'invits', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Rankusers'); ?></h3>
	<?php if (!empty($user['Rankuser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Kill'); ?></th>
		<th><?php echo __('Steal'); ?></th>
		<th><?php echo __('Evo'); ?></th>
		<th><?php echo __('Lost'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Rankuser'] as $rankuser): ?>
		<tr>
			<td><?php echo $rankuser['id']; ?></td>
			<td><?php echo $rankuser['user_id']; ?></td>
			<td><?php echo $rankuser['kill']; ?></td>
			<td><?php echo $rankuser['steal']; ?></td>
			<td><?php echo $rankuser['evo']; ?></td>
			<td><?php echo $rankuser['lost']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rankusers', 'action' => 'view', $rankuser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rankusers', 'action' => 'edit', $rankuser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rankusers', 'action' => 'delete', $rankuser['id']), null, __('Are you sure you want to delete # %s?', $rankuser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rankuser'), array('controller' => 'rankusers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Technos'); ?></h3>
	<?php if (!empty($user['Techno'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Lvl'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Techno'] as $techno): ?>
		<tr>
			<td><?php echo $techno['id']; ?></td>
			<td><?php echo $techno['user_id']; ?></td>
			<td><?php echo $techno['type']; ?></td>
			<td><?php echo $techno['lvl']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'technos', 'action' => 'view', $techno['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'technos', 'action' => 'edit', $techno['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'technos', 'action' => 'delete', $techno['id']), null, __('Are you sure you want to delete # %s?', $techno['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
