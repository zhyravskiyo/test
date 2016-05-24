<table id="date-list">
  <tr>
    <td>Date</td>
    <td>Number upload</td>
    <td>Number download</td>
    <td>The most downloaded file</td>
  </tr>

  <?php foreach ($table as $date => $item):?>
    <tr>
      <td><?php echo $date ?></td>
      <td><?php echo (isset($item['file_upload']) && !empty($item['file_upload'])) ? $item['file_upload'] : 'for this date do not upload files' ?></td>
      <td><?php echo (isset($item['file_download']) && !empty($item['file_download'])) ? $item['file_download'] : 'for this date do not download files' ?></td>
      <td><?php echo (isset($item['file']) && !empty($item['file'])) ? key($item['file']) : 'for this date do not upload files' ?></td>
    </tr>
  <?php endforeach;?>
</table>