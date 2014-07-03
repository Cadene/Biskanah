<div class="dttechnos view">
<h2><?php echo __('Dttechno'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dttechno['Dttechno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Techno'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dttechno['Techno']['id'], array('controller' => 'technos', 'action' => 'view', $dttechno['Techno']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Building'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dttechno['Building']['id'], array('controller' => 'buildings', 'action' => 'view', $dttechno['Building']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish'); ?></dt>
		<dd>
			<?php echo h($dttechno['Dttechno']['finish']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($dttechno['Dttechno']['begin']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dttechno'), array('action' => 'edit', $dttechno['Dttechno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dttechno'), array('action' => 'delete', $dttechno['Dttechno']['id']), null, __('Are you sure you want to delete # %s?', $dttechno['Dttechno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dttechnos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dttechno'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Technos'), array('controller' => 'technos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Techno'), array('controller' => 'technos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
