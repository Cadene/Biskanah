<div class="datatechnos form">
<?php echo $this->Form->create('Datatechno'); ?>
	<fieldset>
		<legend><?php echo __('Add Datatechno'); ?></legend>
	<?php
		echo $this->Form->input('lvl');
		echo $this->Form->input('type');
		echo $this->Form->input('res1');
		echo $this->Form->input('res2');
		echo $this->Form->input('res3');
		echo $this->Form->input('time');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Datatechnos'), array('action' => 'index')); ?></li>
	</ul>
</div>
