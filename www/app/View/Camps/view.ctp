<div class="camp info">
    <?php debug($data);?>
</div>

<div class="buildings form">
    <?php echo $this->Form->create('Building', array('action' => 'create')); ?>
    <fieldset>
        <legend><?php echo __('Add Building'); ?></legend>
        <?php
        //echo $this->Form->input('camp_id');
        echo $this->Form->input('databuilding_id', array('type'=>'text'));
        echo $this->Form->input('field');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>



