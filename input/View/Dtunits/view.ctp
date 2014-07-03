<div class="dtunits view">
<h2><?php echo __('Dtunit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dtunit['Dtunit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dtunit['Unit']['id'], array('controller' => 'units', 'action' => 'view', $dtunit['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Building'); ?></dt>
		<dd>
			<?php echo $this->Html->link($dtunit['Building']['id'], array('controller' => 'buildings', 'action' => 'view', $dtunit['Building']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Begin'); ?></dt>
		<dd>
			<?php echo h($dtunit['Dtunit']['begin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Finish'); ?></dt>
		<dd>
			<?php echo h($dtunit['Dtunit']['finish']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num'); ?></dt>
		<dd>
			<?php echo h($dtunit['Dtunit']['num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Num Ready'); ?></dt>
		<dd>
			<?php echo h($dtunit['Dtunit']['num_ready']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dtunit'), array('action' => 'edit', $dtunit['Dtunit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dtunit'), array('action' => 'delete', $dtunit['Dtunit']['id']), null, __('Are you sure you want to delete # %s?', $dtunit['Dtunit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dtunits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dtunit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Buildings'), array('controller' => 'buildings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Building'), array('controller' => 'buildings', 'action' => 'add')); ?> </li>
	</ul>
</div>
