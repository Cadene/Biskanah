<div class="dataunits view">
<h2><?php echo __('Dataunit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res1'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['res1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res2'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['res2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Res3'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['res3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Att1'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['att1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Att2'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['att2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Att3'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['att3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attbat'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['attbat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Speed'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['speed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conso'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['conso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Capacity'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['capacity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Spy'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['spy']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Time'); ?></dt>
		<dd>
			<?php echo h($dataunit['Dataunit']['time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dataunit'), array('action' => 'edit', $dataunit['Dataunit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dataunit'), array('action' => 'delete', $dataunit['Dataunit']['id']), null, __('Are you sure you want to delete # %s?', $dataunit['Dataunit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dataunits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dataunit'), array('action' => 'add')); ?> </li>
	</ul>
</div>
