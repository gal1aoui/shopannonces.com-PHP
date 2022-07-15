<?php
// require variables named: $jscal_input_name, $jscal_def_date, $jscal_trig_id
?>
<input class="txtbox" type="text" name="<?php echo $jscal_input_name?>" id="<?php echo $jscal_input_name?>" size="10"  readonly value="<?php echo $jscal_def_date?>" <?php if($validation!=''){?> alt="<?php echo $validation?>" emsg="<?php echo $validation_msg?>" <?php }?>/> 

<img src="<?php echo DATE_PICKER_WS_PATH?>/jscal/img.gif" id="<?php echo $jscal_input_name?>_trigger" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';"  onmouseout="this.style.background=''" /> 
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "<?php echo $jscal_input_name?>",     // id of the input field
        ifFormat       :    "%Y-%m-%d %H:%M",      // format of the input field
        button         :    "<?php echo $jscal_input_name?>_trigger",  // trigger for the calendar (button ID)
        align          :    "B2",           // alignment (defaults to "Bl")
        showsTime      :    true,
        timeFormat     :    "24",
        singleClick    :    true
    });
</script> 