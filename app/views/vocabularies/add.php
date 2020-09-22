<?php include_once APPROOT . '/views/inc/header.php'; ?>

<!-- 如果是從搜尋畫面過來的，就加入下面這些內容 -->
<?php if (!empty($data)) : ?>
    <a href="<?php echo URLROOT; ?>/words/search" class="btn btn-light">
        <i class="fa fa-backward"></i>Back to search</a>
    <div class="">
        <p>There is no such word founded. Try to add an entry!</p>
    </div>
<?php endif; ?>

<div>
    <form action="<?php echo URLROOT; ?>/vocabularies/add" method="post">
        <div class="form-group">
            <label for="word">單字:</label>
            <input type="text" name="word" class="
                <?php echo (empty($data['word_err'])) ? '' : 'is-invalid'; ?>
            " value="<?php echo $data['word']; ?>">
            <span class="invalid-feedback">
                <?php echo $data['word_err']; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="user_id">使用者(temp): </label>
            <input type="text" name="user_id" class="" value="<?php echo $data['user_id']?>">
            <span class="invalid-feedback">
                <?php echo $data['type_id_err']; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="meaning">意思: </label>
            <textarea name="meaning" rows="2" cols="40" class=""><?php echo $data['meaning']; ?></textarea>
            <span class="invalid-feedback">
                <?php echo $data['meaning_err']; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="example">例句: </label>
            <textarea name="example" rows="2" cols="40" class=""><?php echo $data['example']; ?></textarea>
            <span class="invalid-feedback">
                <?php echo $data['example_err']; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="link">辭典連結: </label>
            <input type="text" name="link" value="<?php echo $data['link']; ?>">
        </div>
        <input type="submit" value="Add word" class="btn btn-success">
    </form>
</div>

<?php include_once APPROOT . '/views/inc/footer.php'; ?>