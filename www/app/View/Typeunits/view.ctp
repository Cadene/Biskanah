<div class="typeunits view">
<h2><?php echo __('Typeunit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($typeunit['Typeunit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($typeunit['Typeunit']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Desc'); ?></dt>
		<dd>
			<?php echo h($typeunit['Typeunit']['desc']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typeunit'), array('action' => 'edit', $typeunit['Typeunit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Typeunit'), array('action' => 'delete', $typeunit['Typeunit']['id']), null, __('Are you sure you want to delete # %s?', $typeunit['Typeunit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typeunits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typeunit'), array('action' => 'add')); ?> </li>
	</ul>
</div>
