<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">about the <span class="orange regular">project</span></h1>
<br>
<br>

<h2>introduction</h2>
<br>
<p><span class="orange regular">pythagoras</span> is an ongoing digital humanities project started by Brandon Bellanti, a masters student in the School of Library and Information Science (SLIS) at Simmons University in Boston, MA.
The project was conceptualized as a requirement for the Prague Summer Seminar through the School of Information and Library Science (SILS) at the University of North Carolina, Chapel Hill.</p>
<br><!-- <div class="text-center"><span class="orange regular xlarge">~</span></div> -->
<p>The goal of the project is to perform data analysis and pattern recognition on music scores to identify relationships within individual works,
between works by the same composer, and between works from different composers. In its current form, <span class="orange regular">pythagoras</span> exists as a searchable database of composers and their works.
For examples of the final version, see:</p>
<br>
<ul>
    <li><a href="JSB_BWV1047_1.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, I. Allegro</a></li>
    <li><a href="JSB_BWV1047_2.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, II. Andante</a></li>
    <li><a href="JSB_BWV1047_3.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, III. Allegro assai</a></li>
</ul>
<br>
<br>
<div id="db-diagrams">
    <h2>database diagrams</h2>
    <br>
    <h3>conceptual model</h3>
    <img src="images/erd/erd-conceptual.svg" alt="conceptual entity relationship diagram" width="800px">
    <h3>logical model</h3>
    <img src="images/erd/erd-logical.svg" alt="logical entity relationship diagram" width="800px">
</div>

</div><!-- end content -->

<?php require_once("templates/footer.php"); ?>
