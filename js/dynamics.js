
$(document).ready(function(){
   $('#articleAmount').change(function(){
       $('#amountPerPage').click();
    });

   $('#category').change(function(){
       $('#amountPerPage').click();
    });
});

// Script to open and close sidebar
function openSidebar() {
    document.getElementById("sidebar").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}
 
function closeSidebar() {
    document.getElementById("sidebar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

// ELEMENT.locale(ELEMENT.lang.en)
// new Vue({
//   el: '#view',
  
// })
