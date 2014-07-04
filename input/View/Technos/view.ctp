<div class="technos view">
<h2><?php echo __('Techno'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($techno['Techno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($techno['User']['id'], array('controller' => 'users', 'action' => 'view', $techno['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($techno['Techno']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lvl'); ?></dt>
		<dd>
			<?php echo h($techno['Techno']['lvl']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Techno'), array('action' => 'edit', $techno['Techno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Techno'), array('action' => 'delete', $techno['Techno']['id']), null, __('Are you sure you want to delete # %s?', $techno['Techno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Technos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List D T Technos'), array('controller' => 'd_t_technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New D T Techno'), array('controller' => 'd_t_technos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related D T Technos'); ?></h3>
	<?php if (!empty($techno['DTTechno'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Techno Id'); ?></th>
		<th><?php echo __('Building Id'); ?></th>
		<th><?php echo __('Finish'); ?></th>
		<th><?php echo __('Begin'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($techno['DTTechno'] as $dTTechno): ?>
		<tr>
			<td><?php echo $dTTechno['id']; ?></td>
			<td><?php echo $dTTechno['techno_id']; ?></td>
			<td><?php echo $dTTechno['building_id']; ?></td>
			<td><?php echo $dTTechno['finish']; ?></td>
			<td><?php echo $dTTechno['begin']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'd_t_technos', 'action' => 'view', $dTTechno['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'd_t_technos', 'action' => 'edit', $dTTechno['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'd_t_technos', 'action' => 'delete', $dTTechno['id']), null, __('Are you sure you want to delete # %s?', $dTTechno['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New D T Techno'), array('controller' => 'd_t_technos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
