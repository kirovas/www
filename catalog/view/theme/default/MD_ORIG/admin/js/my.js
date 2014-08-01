$(document).ready(function(){
   
   $('#cat_type').click(function(){
    var kat_id;
    kat_id = $(this).val();
        console.log(kat_id);
     $('#kat_id').val(kat_id); 
      
      
      
//Получаем параметры
  var kat_id_2;
kat_id_2 = $('#kat_id').val();
//alert(kat_id_2);
  // Отсылаем паметры
       $.ajax({
        
                type: "POST",
                url: "/admin/query/s_kat_sel.php",
                data: ({name:$('#kat_id').val()}),
                // Выводим то что вернул PHP
                success: function(html) {
 //предварительно очищаем нужный элемент страницы
                        $("#cat_type_1").empty();
//и выводим ответ php скрипта
                        $("#cat_type_1").append(html);
                }
        });


      

   });
   
   
   
  
   
   
   
  
});

