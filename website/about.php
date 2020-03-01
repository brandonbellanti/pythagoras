<?php require_once("templates/header.php"); ?>


<div class="content">

<h1 class="text-center">about the <span class="orange regular">project</span></h1>
<br>
<br>

<h2>introduction</h2>
<br>
<div itemscope itemtype="https://schema.org/CreativeWork" class="microdata">
    <span itemprop="name" class="orange regular">pythagoras</span> is an 
    <span itemprop="creativeWorkStatus">ongoing</span> <span itemprop="description">digital humanities project</span> started by 
    <div itemprop="Creator" itemscope itemtype="http://schema.org/Person" class="microdata">
        <span itemprop="name">Brandon Bellanti</span>, 
        <span itemprop="disambiguatingDescription">a masters
            <div itemscope itemtype="https://schema.org/Role" class="microdata">
                <span itemprop="roleName">student</span>
            </div> 
        </span> in the
        <div itemprop="affiliation" itemscope itemtype="http://schema.org/EducationalOrganization" class="microdata">
            <div itemprop="subOrganization" itemscope itemtype="http://schema.org/EducationalOrganization" class="microdata">
                <span itemprop="name">School of Library and Information Science</span>
            </div> (SLIS) at
            <span itemprop="name">Simmons University</span> in
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="microdata">
                <span itemprop="addressLocality">Boston</span>, 
                <span itemprop="addressRegion">MA</span>
            </div>
        </div>
    </div>. The project was conceptualized as a requirement for the 
    <div itemscope itemtype="https://schema.org/EducationEvent" class="microdata">
        <span itemprop="name">
            <span itemprop="startDate" scheme="ISO8601" content="2019-05-19"><span itemprop="endDate" scheme="ISO8601" content="2019-06-01">2019</span></span> 
            <div itemprop="location" itemscope itemtype="https://schema.org/City" class="microdata">
                <span itemprop="name">
                    <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" class="microdata">
                        <span itemprop="addressRegion">Prague</span>
                    </div>
                </span>
            </div> 
            Summer Seminar
        </span> 
        through the 
        <div itemprop="organizer" itemscope itemtype="http://schema.org/EducationalOrganization" class="microdata">
            <div itemprop="subOrganization" itemscope itemtype="http://schema.org/EducationalOrganization" class="microdata">
                    <span itemprop="name">School of Information and Library Science</span>
            </div> (SILS) at the 
            <span itemprop="name">University of North Carolina at Chapel Hill</span>
        </div>
    </div>.
    <br><br>
    <div itemprop="abstract" class="microdata">
        The goal of the project is to perform data analysis and pattern recognition on music scores using
        <div itemscope itemtype="https://schema.org/ComputerLanguage" class="microdata"><span itemprop="name">Python</span></div> to identify relationships within individual works, between works by the same composer, and between works from different composers. In its current form, <span class="orange regular">pythagoras</span> exists as a searchable database of composers and their works.
    </div>
    <br><br>
</div>
    For examples of the final version, see:
    <br>
<ul>
    <li><a href="89.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, I. Allegro</a></li>
    <li><a href="90.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, II. Andante</a></li>
    <li><a href="91.php">J.S. Bach - Brandenburg Concerto No. 2 in F Major, BWV 1047, III. Allegro assai</a></li>
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
