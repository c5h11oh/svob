<?php include_once APPROOT . '/views/inc/header.php'; ?>

<?php echo flash('word-message'); ?>
<form class="" action="<?php echo URLROOT ?>/vocabularies/search" method="post">
    <div class="row h-100 align-items-end">
        <div class="col-8">
            <label for="word"></label>
            <input type="text" class="form-control form-control-lg" name="word" id="word" aria-describedby="helpId" placeholder="Type the word you're looking...">
            <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
        </div>
        <div class="col-3">
          <label for="search_mode"></label>
          <select class="form-control form-control-lg" name="search_mode" id="search_mode">
            <option value="<?php echo VOC_EXACT;?>">Exact word</option>
            <option value="<?php echo VOC_CONTAINS;?>">Contains pattern</option>
          </select>
        </div>
        <div class="col-1">
            <button type="submit" class="btn btn-lg form-control form-control-lg">
            <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>

<?php include_once APPROOT . '/views/inc/footer.php'; ?>