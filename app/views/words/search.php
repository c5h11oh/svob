<?php include_once APPROOT.'/views/inc/header.php'; ?>
      <div class="card card-body bg-light mt-5">
      <h2>Search</h2>
      <p>Search words here</p>
      <form action="<?php echo URLROOT; ?>/words/search" method="post">
            <div class="form-group">
               <label for="string">Search for: </label>
               <input type="text" name="string" class="form-control form-control-lg <?php echo (empty($data['string_err'])) ? '' : 'is-invalid'; ?>"
                  value="<?php echo $data['string']; ?>">
               <span class="invalid-feedback"><?php echo $data['string_err']; ?></span>
            </div>
            <input type="submit" value="Search" class="btn btn-success">
      </form>
   </div>
<?php include_once APPROOT.'/views/inc/footer.php'; ?>