<div class="units view">
<h2><?php echo __('Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unit['Unit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($unit['Unit']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num'); ?></dt>
		<dd>
			<?php echo h($unit['Unit']['num']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unit'), array('action' => 'edit', $unit['Unit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unit'), array('action' => 'delete', $unit['Unit']['id']), null, __('Are you sure you want to delete # %s?', $unit['Unit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2 Bs Units'), array('controller' => 'a2_bs_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2 Bs Unit'), array('controller' => 'a2_bs_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('controller' => 'assists_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('controller' => 'assists_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('controller' => 'camps_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('controller' => 'camps_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Units'), array('controller' => 'd_t_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Unit'), array('controller' => 'd_t_units', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related A2 Bs Units'); ?></h3>
	<?php if (!empty($unit['A2BsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('A2b Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unit['A2BsUnit'] as $a2BsUnit): ?>
		<tr>
			<td><?php echo $a2BsUnit['id']; ?></td>
			<td><?php echo $a2BsUnit['a2b_id']; ?></td>
			<td><?php echo $a2BsUnit['unit_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'a2_bs_units', 'action' => 'view', $a2BsUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'a2_bs_units', 'action' => 'edit', $a2BsUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'a2_bs_units', 'action' => 'delete', $a2BsUnit['id']), null, __('Are you sure you want to delete # %s?', $a2BsUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New A2 Bs Unit'), array('controller' => 'a2_bs_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Assists Units'); ?></h3>
	<?php if (!empty($unit['AssistsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Assist Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unit['AssistsUnit'] as $assistsUnit): ?>
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
<div class="related">
	<h3><?php echo __('Related Camps Units'); ?></h3>
	<?php if (!empty($unit['CampsUnit'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Camp Id'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unit['CampsUnit'] as $campsUnit): ?>
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
	<h3><?php echo __('Related D T Units'); ?></h3>
	<?php if (!empty($unit['DTUnit'])): ?>
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
	<?php foreach ($unit['DTUnit'] as $dTUnit): ?>
		<tr>
			<td><?php echo $dTUnit['id']; ?></td>
			<td><?php echo $dTUnit['unit_id']; ?></td>
			<td><?php echo $dTUnit['building_id']; ?></td>
			<td><?php echo $dTUnit['begin']; ?></td>
			<td><?php echo $dTUnit['finish']; ?></td>
			<td><?php echo $dTUnit['num']; ?></td>
			<td><?php echo $dTUnit['num_ready']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'd_t_units', 'action' => 'view', $dTUnit['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'd_t_units', 'action' => 'edit', $dTUnit['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'd_t_units', 'action' => 'delete', $dTUnit['id']), null, __('Are you sure you want to delete # %s?', $dTUnit['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New D T Unit'), array('controller' => 'd_t_units', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
