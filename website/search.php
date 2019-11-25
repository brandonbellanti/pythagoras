<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">search the <span class="orange regular">database</span></h1>
<br>

<div id="search-form">
  <form action="adv-search-results.php" method="post">
  <label for="comp_name">Composer name: </label><br>
  <input class="no-outline" type="text" name="comp_name" placeholder="name"/><br><br>
    <label for="comp_name">Born after year: </label><br>
    <input class="no-outline" type="text" name="comp_bornafter" placeholder="YYYY"/><br><br>
    <label for="comp_name">Born before year: </label><br>
    <input class="no-outline" type="text" name="comp_bornbefore" placeholder="YYYY"/><br><br>
  <label for="comp_name">Nationality: </label><br>
  <input class="no-outline" type="text" name="comp_nationality" placeholder="nationality"/><br><br>
  <input class="regular scale" type="submit" value="search">
  </form>
</div><!-- end index-form -->


</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>
