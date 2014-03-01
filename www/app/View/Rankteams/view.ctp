<div class="rankteams view">
<h2><?php echo __('Rankteam'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rankteam['Rankteam']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rankteam['Team']['name'], array('controller' => 'teams', 'action' => 'view', $rankteam['Team']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kill'); ?></dt>
		<dd>
			<?php echo h($rankteam['Rankteam']['kill']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Steal'); ?></dt>
		<dd>
			<?php echo h($rankteam['Rankteam']['steal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evo'); ?></dt>
		<dd>
			<?php echo h($rankteam['Rankteam']['evo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lost'); ?></dt>
		<dd>
			<?php echo h($rankteam['Rankteam']['lost']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rankteam'), array('action' => 'edit', $rankteam['Rankteam']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rankteam'), array('action' => 'delete', $rankteam['Rankteam']['id']), null, __('Are you sure you want to delete # %s?', $rankteam['Rankteam']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankteams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankteam'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
