<div class="databuildings view">
<h2><?php echo __('Databuilding'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lvl'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['lvl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res1'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['res1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res2'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['res2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res3'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['res3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod1'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['prod1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod2'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['prod2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prod3'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['prod3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Struct'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['struct']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conso'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['conso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($databuilding['Databuilding']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Databuilding'), array('action' => 'edit', $databuilding['Databuilding']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Databuilding'), array('action' => 'delete', $databuilding['Databuilding']['id']), null, __('Are you sure you want to delete # %s?', $databuilding['Databuilding']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Databuildings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Databuilding'), array('action' => 'add')); ?> </li>
	</ul>
</div>
