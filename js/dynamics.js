
$(document).ready(function(){
   $('#articleAmount').change(function(){
       $('#amountPerPage').click();
    });

   $('#category').change(function(){
       $('#amountPerPage').click();
    });
});

// Script to open and close sidebar
function w3_open() {
    document.getElementById("sidebar").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("sidebar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
