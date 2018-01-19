
// Submit form (when changing amount or category)
$(document).ready(function(){
   $('#articleAmount').change(function(){
       $('#blogFilter').click();
    });

   $('#category').change(function(){
       $('#blogFilter').click();
    });
});
