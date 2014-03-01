<div class="a2bs view">
<h2><?php echo __('A2b'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resource'); ?></dt>
		<dd>
			<?php echo $this->Html->link($a2b['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $a2b['Resource']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['begin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish'); ?></dt>
		<dd>
			<?php echo h($a2b['A2b']['finish']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit A2b'), array('action' => 'edit', $a2b['A2b']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete A2b'), array('action' => 'delete', $a2b['A2b']['id']), null, __('Are you sure you want to delete # %s?', $a2b['A2b']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2b'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs Units'), array('controller' => 'a2bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2bs Unit'), array('controller' => 'a2bs_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related A2bs Units'); ?></h3>
	<?php if (!empty($a2b['A2bsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('A2b Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($a2b['A2bsUnit'] as $a2bsUnit): ?>
		<tr>
			<td><?php echo $a2bsUnit['id']; ?></td>
			<td><?php echo $a2bsUnit['a2b_id']; ?></td>
			<td><?php echo $a2bsUnit['unit_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'a2bs_units', 'action' => 'view', $a2bsUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'a2bs_units', 'action' => 'edit', $a2bsUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'a2bs_units', 'action' => 'delete', $a2bsUnit['id']), null, __('Are you sure you want to delete # %s?', $a2bsUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New A2bs Unit'), array('controller' => 'a2bs_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
