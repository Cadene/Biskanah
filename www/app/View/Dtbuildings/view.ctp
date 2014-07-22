<div class="dtbuildings view">
<h2><?php echo __('Dtbuilding'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dtt['Dtbuilding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Building'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dtt['Building']['id'], array('controller' => 'buildings', 'action' => 'view', $dtt['Building']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish'); ?></dt>
		<dd>
			<?php echo h($dtt['Dtbuilding']['finish']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($dtt['Dtbuilding']['begin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($dtt['Dtbuilding']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dtbuilding'), array('action' => 'edit', $dtt['Dtbuilding']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dtbuilding'), array('action' => 'delete', $dtt['Dtbuilding']['id']), null, __('Are you sure you want to delete # %s?', $dtt['Dtbuilding']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtbuildings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtbuilding'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
