<?php debug($allowedBuildings);?>

<div class="buildings form">
    <?php echo $this->Form->create('Building', array('action' => 'create')); ?>
    <fieldset>
        <legend><?php echo __('Create Building'); ?></legend>
        <?php
        echo $this->Form->input('type', array('type'=>'text'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>