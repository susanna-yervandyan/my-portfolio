// $(function(){
//     $('#btn_add').on("click",function(){
//         let name = $('#inp').val();
//         //console.log(name)
//         $.ajax({
//             url: "../controller/add_cat.php",
//             method: "post",
//             dataType: "html",
//             data: {
//                 name, action: 'add'
//             },
//             success: function(x){
//                 if (x === "error") {
//                     $("#p_mess").html('Failed to add category');
//                 } else {
//                     location.reload();
//                 }
//             }
//         });
//     });

$(function() {
        $('#btn_add').on("click", function() {
            let name = $('#inp').val();
            let file_data = $('#cat_img').prop('files')[0]; // Get the image file
            
            // Create a FormData object to send both name and image
            let formData = new FormData();
            formData.append("name", name);
            formData.append("cat_img", file_data); // Append the image file
            formData.append("action", 'add'); // The action for adding a category
    
            $.ajax({
                url: "../controller/add_cat.php",
                method: "post",
                data: formData,  // Send FormData
                contentType: false,  // Required for FormData
                processData: false,  // Required for FormData
                success: function(x) {
                    if (x === "error") {
                        $("#p_mess").html('Failed to add category');
                    } else {
                        location.reload();
                    }
                }
            });
        });
    

    
    $('.btn_upd').on("click",function(){
        let id = $(this).parents("tr").attr('id');
        let text = $(this).parents("tr").find(".name_category").text();

        console.log(text);
        $.ajax(
        {
            url:"../controller/add_cat.php",
            method:"post",
            dataType:"html",
            data:{
                id,
                text,
                action:"update"
            },
            success:function(){
               //location.reload();
               $(this).parent().prev().text(text);
            }
        });
    });
    $('.btn_del').on("click",function(){
        let id = $(this).parents("tr").attr('id');
        $.ajax(
        {
            url:"../controller/add_cat.php",
            method:"post",
            data:{
                id,
                action:"delete"
            },
            success:function(){
                $(`#${id}`).remove();
            }
        }
        )
    });
});












