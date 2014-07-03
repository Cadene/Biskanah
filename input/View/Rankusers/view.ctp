<div class="rankusers view">
<h2><?php echo __('Rankuser'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rankuser['Rankuser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($rankuser['User']['id'], array('controller' => 'users', 'action' => 'view', $rankuser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kill'); ?></dt>
		<dd>
			<?php echo h($rankuser['Rankuser']['kill']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Steal'); ?></dt>
		<dd>
			<?php echo h($rankuser['Rankuser']['steal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Evo'); ?></dt>
		<dd>
			<?php echo h($rankuser['Rankuser']['evo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lost'); ?></dt>
		<dd>
			<?php echo h($rankuser['Rankuser']['lost']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rankuser'), array('action' => 'edit', $rankuser['Rankuser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rankuser'), array('action' => 'delete', $rankuser['Rankuser']['id']), null, __('Are you sure you want to delete # %s?', $rankuser['Rankuser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rankusers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rankuser'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
