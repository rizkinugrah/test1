<?php

foreach ($forms as $key => $value) {

  // Defined
  if ( isset($value['label']) ){
    $label = ucfirst($value['label']);
  } else {
    $label = ucfirst($value['name']);
  }

  $name = $value['name'];
  $type = $value['type'];

  ?>

  <?php $error = form_error($name, '<span class="help-block">', '</span>'); ?>
  <div class="form-group <?php if ($error != ''){ echo "has-error"; }?>">
    <label class="col-sm-2 control-label" for="<?php echo $label; ?>">
      <?php echo $label; ?>
    </label>
    <div class="col-sm-10">

      <?php echo isset($value['formNote']) ? '<p class="help-block">'.$value['formNote'].'</p>' : ''; ?>

      <?php
      if ($type == 'hidden'){
        ?> <input class="form-control" type="hidden" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if ($type == 'text'){
        ?> <input class="form-control" type="text" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if ($type == 'password'){
        ?> <input class="form-control" type="password" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if($type == 'number'){
        ?> <input class="form-control" type="number" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if($type == 'time'){
        ?> <input class="form-control" type="time" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if($type == 'date'){
        ?> <input class="form-control" type="date" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if($type == 'datetime'){
        ?> <input class="form-control" type="datetime-local" name="<?php echo $name; ?>" value="<?php echo isset($value['value']) ? $value['value'] : ''; ?>"/> <?php
      } else if($type == 'textarea'){
        ?> <textarea class="form-control" name="<?php echo $name; ?>" rows="3"><?php echo isset($value['value']) ? $value['value'] : ''; ?></textarea> <?php
      } else if($type == 'select'){
        ?> <select class="form-control" name="<?php echo $name; ?>">
          <option>Select...</option>
            <?php
            foreach ($value['options'] as $item) {
              ?> <option value="<?php echo $item['value']; ?>" <?php echo (isset($value['value']) && $item['value'] == $value['value']) ? 'selected' : ''; ?>> <?php echo $item['label']; ?> </option> <?php
            }
            ?>
        </select> <?php
      }
      ?>

      <?php echo $error; ?>
    </div>
  </div>

  <?php
}
?>

<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" id="btnSubmit" name="submit" class="btn btn-primary">Submit</button>
    <button type="button" onclick="window.history.back();" class="btn btn-default">Back</button>
  </div>
</div>
