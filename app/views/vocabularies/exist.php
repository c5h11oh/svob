<?php include_once APPROOT.'/views/inc/header.php'; ?>

<?php 
    echo "<h3>". ($data['input'] ? "You've made an input." : "No input made!") ."</h3>";
    if($data['input'])
        echo "<h4>". ($data['exist'] ? "Found." : "Not found") ."</h4>";
?>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>