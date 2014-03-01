<div class="datatechnos view">
<h2><?php echo __('Datatechno'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lvl'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['lvl']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res1'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['res1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res2'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['res2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res3'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['res3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($datatechno['Datatechno']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Datatechno'), array('action' => 'edit', $datatechno['Datatechno']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Datatechno'), array('action' => 'delete', $datatechno['Datatechno']['id']), null, __('Are you sure you want to delete # %s?', $datatechno['Datatechno']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Datatechnos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Datatechno'), array('action' => 'add')); ?> </li>
	</ul>
</div>
