<div class="assistsUnits view">
<h2><?php echo __('Assists Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assistsUnit['AssistsUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assist'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assistsUnit['Assist']['id'], array('controller' => 'assists', 'action' => 'view', $assistsUnit['Assist']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assistsUnit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $assistsUnit['Unit']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assists Unit'), array('action' => 'edit', $assistsUnit['AssistsUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assists Unit'), array('action' => 'delete', $assistsUnit['AssistsUnit']['id']), null, __('Are you sure you want to delete # %s?', $assistsUnit['AssistsUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assists Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Assists'), array('controller' => 'assists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assist'), array('controller' => 'assists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
