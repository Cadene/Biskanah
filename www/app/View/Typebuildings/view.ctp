<div class="typebuildings view">
<h2><?php echo __('Typebuilding'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($typebuilding['Typebuilding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($typebuilding['Typebuilding']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($typebuilding['Typebuilding']['desc']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typebuilding'), array('action' => 'edit', $typebuilding['Typebuilding']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Typebuilding'), array('action' => 'delete', $typebuilding['Typebuilding']['id']), null, __('Are you sure you want to delete # %s?', $typebuilding['Typebuilding']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typebuildings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typebuilding'), array('action' => 'add')); ?> </li>
	</ul>
</div>
