<div class="campsUnits view">
<h2><?php echo __('Camps Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($campsUnit['CampsUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Camp'); ?></dt>
		<dd>
			<?php echo $this->Html->link($campsUnit['Camp']['name'], array('controller' => 'camps', 'action' => 'view', $campsUnit['Camp']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($campsUnit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $campsUnit['Unit']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Camps Unit'), array('action' => 'edit', $campsUnit['CampsUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Camps Unit'), array('action' => 'delete', $campsUnit['CampsUnit']['id']), null, __('Are you sure you want to delete # %s?', $campsUnit['CampsUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camps Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Camps'), array('controller' => 'camps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Camp'), array('controller' => 'camps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
