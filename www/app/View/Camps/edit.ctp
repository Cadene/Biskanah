<div class="camps form">
<?php echo $this->Form->create('Camp'); ?>
	<fieldset>
		<legend><?php echo __('Edit Camp'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
