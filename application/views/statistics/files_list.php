<div id="files-list">
  <span id="files-list-title">These files are available for viewing</span> <br>

  <?php foreach ($files as $file):?>
    <a href="<?php echo "statistics/file/$file" ?>"> <?php echo $file?></a> <br>
  <?php endforeach;?>
</div>