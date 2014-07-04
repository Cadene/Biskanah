<div class="assists view">
<h2><?php echo __('Assist'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assist['Assist']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From'); ?></dt>
		<dd>
			<?php echo h($assist['Assist']['from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('On'); ?></dt>
		<dd>
			<?php echo h($assist['Assist']['on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resource'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assist['Resource']['id'], array('controller' => 'resources', 'action' => 'view', $assist['Resource']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assist'), array('action' => 'edit', $assist['Assist']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assist'), array('action' => 'delete', $assist['Assist']['id']), null, __('Are you sure you want to delete # %s?', $assist['Assist']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Resources'), array('controller' => 'resources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resource'), array('controller' => 'resources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Assists Units'); ?></h3>
	<?php if (!empty($assist['AssistsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Assist Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assist['AssistsUnit'] as $assistsUnit): ?>
		<tr>
			<td><?php echo $assistsUnit['id']; ?></td>
			<td><?php echo $assistsUnit['assist_id']; ?></td>
			<td><?php echo $assistsUnit['unit_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'assists_units', 'action' => 'view', $assistsUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'assists_units', 'action' => 'edit', $assistsUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'assists_units', 'action' => 'delete', $assistsUnit['id']), null, __('Are you sure you want to delete # %s?', $assistsUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
