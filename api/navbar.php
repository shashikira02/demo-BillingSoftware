<?php

  
?>
<style>
#updatePorfile{
  width:21px;
  height:21px;
  right:100px;
}
</style>
<!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center">
      <img loading="lazy" src=<?= "images/".$_SESSION["user_id"].".jpg" ?> alt="Not Found" onerror=this.src="images/default.jpg" width="80" height="80" class="mr-3  img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class="m-0"><?php echo $_SESSION['name']; ?></h4>
      </div>
    </div>
  </div>

 

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="index.php" class="nav-link text-dark">
                <i class="fa fa-home mr-3 text-dark fa-fw"></i>
                Home
            </a>
    </li>
  </ul>
  <br>
  

  <p class="text-dark font-weight-bold text-uppercase px-3 small pb-4 mb-0">Operations</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="updateProfile.php" class="nav-link text-dark bg-light">
                <!-- <i class="fa fa-pencil-square-o mr-3 text-dark fa-fw"></i> -->
                
                <img id="updatePorfile" src="images/updateProfile.png">&ensp;&ensp;
                Update Profile
            </a>
    </li>
    <li class="nav-item">
      <a href="createbill.php" class="nav-link text-dark ">
                <i class="fa fa-pencil-square-o mr-3 text-dark fa-fw"></i>
                Create Bill
            </a>
    </li>
    <li class="nav-item">
      <a href="managebill.php" class="nav-link text-dark">
                <i class="fa fa-bar-chart mr-3 text-dark fa-fw"></i>
                Manage Bill
            </a>
    </li>
    
    <li class="nav-item">
      <a href="generatereport.php" class="nav-link text-dark">
                <i class="fa fa-window-restore mr-3 text-dark fa-fw"></i>
                Generate Report
            </a>
    </li>
	<li class="nav-item">
		<a href="productshorthand.php" class="nav-link text-dark">
				  <i class="fa fa-th-list mr-3 text-dark fa-fw"></i>
				  Product Shorthand
			  </a>
	  </li>
	  <li class="nav-item">
		<a href="giveawaygenerator.php" class="nav-link text-dark">
				  <i class="fa fa-gift mr-3 text-dark fa-fw"></i>
				  Giveaway Generator
			  </a>
	  </li>
    <!-- <li class="nav-item">
		<a href="giveawaygenerator.php" class="nav-link text-dark">
				  <i class="fa fa-gift mr-3 text-dark fa-fw"></i>
				  Help
			  </a>
	  </li> -->
  </ul>

  
  <div class="mt-3 text-center">
  <button type="button" class="btn btn-dark"><a href="logout.php" style="color:white;text-decoration: none;">Logout</a></button>
	</div>
</div>

<!-- End vertical navbar -->