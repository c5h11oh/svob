<?php include_once APPROOT.'/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/words/search" class="btn btn-light"><i class="fa fa-backward"></i>Back to search</a>
<p>You got <?php echo $data['count']; ?> word(s) founded.</p>
<div class="mb-3 box">
      <?php foreach ($data['searchResult'] as $word): ?>
      <div class="mb-3 box">
            <h3><?php echo $word->word; ?></h3>
            <h4><?php
                  echo $word->form2.' / ';
                  echo $word->form3.' / ';
                  echo $word->form4.' / ';
                  echo $word->form5.' / ';
            ?></h4>
            <!-- <p></p> -->
            <p>Meaning: <?php echo $word->meaning; ?></p>
            <p>Last_searched at: <?php echo $word->last_searched_at; ?></p>
            <?php $aa = explode(' ', $word->created_at, 2); ?>
            <p>Created at: <?php echo explode(' ', $word->created_at)[0]; ?></p>
      </div>
<?php endforeach; ?>
</div>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>