<?php require_once("templates/header.php");?>


<div class="content">

<div id="welcome" class="text-center">
  <h1>welcome to <span class="orange regular">pythagoras</span></h1>
  <!-- <p>enter a composer or work to get started</p> -->
  <p>enter a composer to get started</p>
  <br>
</div><!-- end welcome -->

<div id="index-form">
  <form action="adv-search-results.php" method="post">
  <!-- <input class="no-outline" type="text" id="composer_work" name="composer_work" placeholder="composer name or work title"/> -->
  <input class="no-outline" type="text" id="composer_work" name="comp_name" placeholder="composer name"/>
  <input class="regular scale" type="submit" value="see analysis">
  </form>
</div><!-- end index-form -->

<!-- The goal  of the preceding query is to display a composer and the eras with which they are associated.-->

</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>
