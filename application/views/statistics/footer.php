<?php if (is_array($js_files_footer)):?>

  <?php foreach ($js_files_footer as $js_file):?>
    <script type="text/javascript" src="<?php echo $js_file ?>"></script>
  <?php endforeach ;?>

<?php endif;?>

</body>
</html>