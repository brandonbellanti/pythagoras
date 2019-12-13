<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">search the <span class="orange regular">database</span></h1>
<br>
<div id="search-menu">
  <a id="composer-search-button" onclick="composerSearch()">search <span class="orange regular">composers</span></a>
  <a id="work-search-button" onclick="workSearch()">search <span class="orange regular">works</span></a>
  <!-- <a id="all-search-button" onclick="allSearch()">search <span class="orange regular">all</span></a> -->
</div>
<br>

<div id="search-form">
  <form action="adv-search-results.php" method="post">
  <div id="composer-search">
    <label for="comp_name">Name</label><br>
    <input class="no-outline" type="text" name="comp_name" placeholder="name"/><br><br>
    <label for="comp_bornafter">Born after year</label><br>
    <input class="no-outline" type="text" name="comp_bornafter" placeholder="YYYY"/><br><br>
    <label for="comp_bornbefore">Born before year</label><br>
    <input class="no-outline" type="text" name="comp_bornbefore" placeholder="YYYY"/><br><br>
    <label for="comp_nationality">Nationality</label><br>
    <input class="no-outline" type="text" name="comp_nationality" placeholder="e.g. Czech"/><br><br>
    <label for="comp_era">Era</label><br>
    <input class="no-outline" type="text" name="comp_era" placeholder="e.g. Baroque"/><br><br>
  </div>
  <div id="work-search">
    <label for="work_title">Title</label><br>
    <input class="no-outline" type="text" name="work_title" placeholder="work or movement title"/><br><br>
    <label for="work_identifier">Identifier</label><br>
    <input class="no-outline" type="text" name="work_identifier" placeholder="e.g. BWV 1047"/><br><br>
    <label for="work_composer">Composer</label><br>
    <input class="no-outline" type="text" name="work_composer" placeholder="composer name"/><br><br>
    <label for="work_afteryear">Composed after year</label><br>
    <input class="no-outline" type="text" name="work_afteryear" placeholder="YYYY"/><br><br>
    <label for="work_beforeyear">Composed before year</label><br>
    <input class="no-outline" type="text" name="work_beforeyear" placeholder="YYYY"/><br><br>
    <label for="work_era">Era</label><br>
    <input class="no-outline" type="text" name="work_era" placeholder="e.g. baroque"/><br><br>
    <label for="work_key">Key signature</label><br>
    <input class="no-outline" type="text" name="work_key" placeholder="e.g. C major"/><br><br>
    <label for="work_time">Time signature</label><br>
    <input class="no-outline" type="text" name="work_time" placeholder="e.g. 4/4"/><br><br>
    <label for="work_tempo">Tempo</label><br>
    <input class="no-outline" type="text" name="work_tempo" placeholder="e.g. allegro"/><br><br>
    <label for="work_instrument">Instrument</label><br>
    <input class="no-outline" type="text" name="work_instrument" placeholder="e.g. trumpet"/><br><br>
  </div>
  <input class="regular scale" type="submit" value="search">
  </form>
</div><!-- end index-form -->


</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>
