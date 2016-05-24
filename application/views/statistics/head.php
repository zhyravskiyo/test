<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  <title><?php echo $title?></title>

  <?php if (is_array($js_files_head)):?>

    <?php foreach ($js_files_head as $js_file):?>
      <script type="text/javascript" src="<?php echo $js_file ?>"></script>
    <?php endforeach ;?>

  <?php endif;?>

  <?php if (is_array($css_files)):?>

    <?php foreach ($css_files as $css_file):?>

      <?php if (isset($css_file) && !empty($css_file)): ?>
      <link rel="stylesheet" type="text/css" href="<?php echo $css_file ?>">
      <?php endif;?>

    <?php endforeach ;?>

  <?php endif;?>

</head>
<body>
