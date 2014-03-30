<div class="typetechnos view">
<h2><?php echo __('Typetechno'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($typetechno['Typetechno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($typetechno['Typetechno']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($typetechno['Typetechno']['desc']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typetechno'), array('action' => 'edit', $typetechno['Typetechno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Typetechno'), array('action' => 'delete', $typetechno['Typetechno']['id']), null, __('Are you sure you want to delete # %s?', $typetechno['Typetechno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typetechnos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typetechno'), array('action' => 'add')); ?> </li>
	</ul>
</div>
