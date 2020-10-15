<?php include_once APPROOT . '/views/inc/header.php'; ?>

<table class="table table-striped table-responsive">
  <thead class="thead-default">
    <tr>
      <th>Vocabulary</th>
      <th>Meaning</th>
      <th>Example</th>
      <th>Link</th>
      <th>Added Date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $row): ?>
    <tr>
      <td scope="row"><?php echo $row->word; ?></td>
      <td><?php echo $row->meaning; ?></td>
      <td><?php echo $row->example; ?></td>
      <td><?php echo $row->link; ?></td>
      <td><?php echo $row->add_date; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_once APPROOT . '/views/inc/footer.php'; ?>