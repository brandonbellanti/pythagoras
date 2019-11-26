/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }


function composerSearch() {
  document.getElementById("composer-search-button").style.textDecoration = "underline";
  document.getElementById("work-search-button").style.textDecoration = "none";
  document.getElementById("all-search-button").style.textDecoration = "none";
  var x = document.getElementById("composer-search");
    x.style.display = "block";
  var y = document.getElementById("work-search");
    y.style.display = "none";
}

function workSearch() {
  document.getElementById("composer-search-button").style.textDecoration = "none";
  document.getElementById("work-search-button").style.textDecoration = "underline";
  document.getElementById("all-search-button").style.textDecoration = "none";
  var x = document.getElementById("composer-search");
    x.style.display = "none";
  var y = document.getElementById("work-search");
    y.style.display = "block";
}

function allSearch() {
  document.getElementById("composer-search-button").style.textDecoration = "none";
  document.getElementById("work-search-button").style.textDecoration = "none";
  document.getElementById("all-search-button").style.textDecoration = "underline";
  var x = document.getElementById("composer-search");
    x.style.display = "block";
  var y = document.getElementById("work-search");
    y.style.display = "block";
}