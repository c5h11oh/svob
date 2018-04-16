<?php include_once APPROOT.'/views/inc/header.php'; ?>

<!-- 如果是從搜尋畫面過來的，就加入下面這些內容 -->
<?php if (!empty($data)): ?>
<a href="<?php echo URLROOT; ?>/words/search" class="btn btn-light">
      <i class="fa fa-backward"></i>Back to search</a>
<div class="">
      <p>There is no such word founded. Try to add an entry!</p>
</div>
<?php endif; ?>

<div>
      <form action="<?php echo URLROOT; ?>/words/add" method="post">
            <div class="form-group">
                  <label for="word">單字： </label>
                  <input type="text" name="word" class="<?php echo (empty($data['word_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['word']; ?>">
                  <span class="invalid-feedback">
                        <?php echo $data['word_err']; ?>
                  </span>
            </div>
            <div class="form-group">
                  <label for="type_id">詞性： </label>
                  <input type="radio" name="type_id" value="1" class="<?php echo (empty($data['type_id_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['type_id']; ?>">Verb
                  <input type="radio" name="type_id" value="2" class="<?php echo (empty($data['type_id_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['type_id']; ?>">Noun
                  <input type="radio" name="type_id" value="3" class="<?php echo (empty($data['type_id_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['type_id']; ?>">adjective/adverb
                  <input type="radio" name="type_id" value="4" class="<?php echo (empty($data['type_id_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['type_id']; ?>">preposition
                  <input type="radio" name="type_id" value="5" class="<?php echo (empty($data['type_id_err'])) ? '' : 'is-invalid'; ?>" value="<?php echo $data['type_id']; ?>">conjunction
                  <span class="invalid-feedback">
                        <?php echo $data['type_id_err']; ?>
                  </span>
            </div>
            <div class="form-group">
                  <label for="meaning">意思： </label>
                  <textarea name="meaning" rows="2" cols="40" class="<?php echo (empty($data['meaning_err'])) ? '' : 'is-invalid'; ?>"><?php echo $data['meaning']; ?></textarea>
                  <span class="invalid-feedback">
                        <?php echo $data['meaning_err']; ?>
                  </span>
            </div>
            <div class="form-group">
                  <label for="form2">form2： </label>
                  <input type="text" name="form2" value="<?php echo $data['form2']; ?>">
            </div>
            <div class="form-group">
                  <label for="form3">form3： </label>
                  <input type="text" name="form3" value="<?php echo $data['form3']; ?>">
            </div>
            <div class="form-group">
                  <label for="form4">form4： </label>
                  <input type="text" name="form4" value="<?php echo $data['form4']; ?>">
            </div>
            <div class="form-group">
                  <label for="form5">form5： </label>
                  <input type="text" name="form5" value="<?php echo $data['form5']; ?>">
            </div>
            <input type="submit" value="Add word" class="btn btn-success">
      </form>
</div>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>