<?php if(isset($_GET["message"])): ?>
    <div class="alert alert-success text-center" role="alert" id="alert">
    <?php
    if($_GET['message'] == "successadd"){
        echo "Kindly Checkout now!";
    }else{
        echo "Failed Action";
    }
    ?>
    </div>
<?php elseif(isset($_GET["errmsg"])): ?>  
    <div class="alert alert-danger text-center" role="alert" id="alert">
    <?php
    if($_GET['errmsg'] == "successerror"){
        echo "Failed to Place your Order.Please Check the Payment Amount!";
    }else{
        echo "Failed Action";
    }
    ?>
    </div>
<?php elseif(isset($_GET["msg"])): ?>  
    <div class="alert alert-primary text-center" role="alert" id="alert">
    <?php
    if($_GET['msg'] == "successupdated"){
        echo "Your Profile Updated Successfully!";
    }else{
        echo "Failed Action";
    }
    ?>
    </div>
<?php elseif(isset($_GET["placed"])): ?>  
    <div class="alert alert-primary text-center" role="alert" id="alert">
    <?php
    if($_GET['placed'] == "successplaced"){
        echo "Your Order Successfully Placed!";
    }else{
        echo "Failed Action";
    }
    ?>
    </div>
<?php elseif(isset($_GET["del"])): ?>  
    <div class="alert alert-warning text-center" role="alert" id="alert">
    <?php
    if($_GET['del'] == "deletedS"){
        echo "Your Order Successfully Deleted!";
    }else{
        echo "Failed Action";
    }
    ?>
    </div>
<?php endif?>