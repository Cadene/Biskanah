<?php debug($verifiedBuildings);?>

<div class="buildings form">
    <?php echo $this->Form->create('Building', array('action' => 'create')); ?>
    <fieldset>
        <legend><?php echo __('Create Building'); ?></legend>
        <?php
        echo $this->Form->input('type', array('type'=>'text'));
        echo $this->Form->input('field', array('type'=>'text','value' => $field));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>