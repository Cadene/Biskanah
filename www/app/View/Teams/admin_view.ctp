<div class="teams view">
<h2><?php echo __('Team'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo h($team['Team']['tag']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($team['Team']['desc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($team['Team']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created By'); ?></dt>
		<dd>
			<?php echo h($team['Team']['created_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank Pts'); ?></dt>
		<dd>
			<?php echo h($team['Team']['rank_pts']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank Units'); ?></dt>
		<dd>
			<?php echo h($team['Team']['rank_units']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank Biskanah'); ?></dt>
		<dd>
			<?php echo h($team['Team']['rank_biskanah']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), null, __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invits'), array('controller' => 'invits', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invit'), array('controller' => 'invits', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankteams'), array('controller' => 'rankteams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankteam'), array('controller' => 'rankteams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Invits'); ?></h3>
	<?php if (!empty($team['Invit'])): ?>
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
	<?php foreach ($team['Invit'] as $invit): ?>
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
	<h3><?php echo __('Related Rankteams'); ?></h3>
	<?php if (!empty($team['Rankteam'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Kill'); ?></th>
		<th><?php echo __('Steal'); ?></th>
		<th><?php echo __('Evo'); ?></th>
		<th><?php echo __('Lost'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($team['Rankteam'] as $rankteam): ?>
		<tr>
			<td><?php echo $rankteam['id']; ?></td>
			<td><?php echo $rankteam['team_id']; ?></td>
			<td><?php echo $rankteam['kill']; ?></td>
			<td><?php echo $rankteam['steal']; ?></td>
			<td><?php echo $rankteam['evo']; ?></td>
			<td><?php echo $rankteam['lost']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rankteams', 'action' => 'view', $rankteam['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rankteams', 'action' => 'edit', $rankteam['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rankteams', 'action' => 'delete', $rankteam['id']), null, __('Are you sure you want to delete # %s?', $rankteam['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rankteam'), array('controller' => 'rankteams', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($team['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Access'); ?></th>
		<th><?php echo __('Desc'); ?></th>
		<th><?php echo __('Diam'); ?></th>
		<th><?php echo __('Plus'); ?></th>
		<th><?php echo __('Token'); ?></th>
		<th><?php echo __('Last Update'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Team Access'); ?></th>
		<th><?php echo __('Biskanah'); ?></th>
		<th><?php echo __('Rank Pts'); ?></th>
		<th><?php echo __('Rank Units'); ?></th>
		<th><?php echo __('Unread Msg'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($team['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['access']; ?></td>
			<td><?php echo $user['desc']; ?></td>
			<td><?php echo $user['diam']; ?></td>
			<td><?php echo $user['plus']; ?></td>
			<td><?php echo $user['token']; ?></td>
			<td><?php echo $user['last_update']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['team_id']; ?></td>
			<td><?php echo $user['team_access']; ?></td>
			<td><?php echo $user['biskanah']; ?></td>
			<td><?php echo $user['rank_pts']; ?></td>
			<td><?php echo $user['rank_units']; ?></td>
			<td><?php echo $user['unread_msg']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
