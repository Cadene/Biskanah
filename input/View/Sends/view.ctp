<div class="sends view">
<h2><?php echo __('Send'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($send['Send']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('From'); ?></dt>
		<dd>
			<?php echo h($send['Send']['from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('To'); ?></dt>
		<dd>
			<?php echo h($send['Send']['to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pc Res1'); ?></dt>
		<dd>
			<?php echo h($send['Send']['pc_res1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pc Res2'); ?></dt>
		<dd>
			<?php echo h($send['Send']['pc_res2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pc Res3'); ?></dt>
		<dd>
			<?php echo h($send['Send']['pc_res3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activate'); ?></dt>
		<dd>
			<?php echo h($send['Send']['activate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Send'), array('action' => 'edit', $send['Send']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Send'), array('action' => 'delete', $send['Send']['id']), null, __('Are you sure you want to delete # %s?', $send['Send']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sends'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Send'), array('action' => 'add')); ?> </li>
	</ul>
</div>
