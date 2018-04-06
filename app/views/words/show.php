<?php include_once APPROOT.'/views/inc/header.php'; ?>

<p>You got <?php echo $data['count']; ?> word(s) founded.</p>
<div class="mb-3 box">
      <?php foreach ($data['searchResult'] as $word): ?>
      <div class="mb-3 box">
            <h3><?php echo $word->word; ?></h3>
            <h5><?php
                  echo $word->form2.'<pre>     </pre>';
                  echo $word->form3.'<pre>     </pre>';
                  echo $word->form4.'<pre>     </pre>';
                  echo $word->form5;
            ?></h5>
            <p>Meaning: <?php echo $word->meaning; ?></p>
            <p>Last_searched at: <?php echo $word->last_searched_at; ?></p>
            <?php $aa = explode(' ', $word->created_at, 2); ?>
            <p>Created at: <?php echo explode(' ', $word->created_at)[0]; ?></p>
      </div>
<?php endforeach; ?>
</div>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>