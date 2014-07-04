<div class="a2bsUnits view">
<h2><?php echo __('A2bs Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($a2bsUnit['A2bsUnit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('A2b'); ?></dt>
		<dd>
			<?php echo $this->Html->link($a2bsUnit['A2b']['id'], array('controller' => 'a2bs', 'action' => 'view', $a2bsUnit['A2b']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($a2bsUnit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $a2bsUnit['Unit']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit A2bs Unit'), array('action' => 'edit', $a2bsUnit['A2bsUnit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete A2bs Unit'), array('action' => 'delete', $a2bsUnit['A2bsUnit']['id']), null, __('Are you sure you want to delete # %s?', $a2bsUnit['A2bsUnit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2bs Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List A2bs'), array('controller' => 'a2bs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New A2b'), array('controller' => 'a2bs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
