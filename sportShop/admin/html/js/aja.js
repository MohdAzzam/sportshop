
$(document).ready(function () {
    $("#admin-email").change(function () {
        //get selected parent option
        var admin_email = $("#admin-email").val();
            // alert(admin_email);
        $.ajax(
            {
                type: "GET",
                url: "name.php?admin_email=" + admin_email,
                success: function (data) {

                    if (data != "") {
                        $("#s7").css("visibility", "hidden");
                        $("#la").css("visibility", "");
                        $("#save").prop("disabled", true);

                    } else {
                        $("#s7").css("visibility", "");
                        $("#la").css("visibility", "hidden");
                        $("#save").prop("disabled", false);
                    }

                }
            });
    });
    $("#cat-name").change(function () {
        //get selected parent option
        var cat_name = $("#cat-name").val();
       // alert(cat_name);

            $.ajax(
                {
                    type: "GET",
                    url: "name.php?cat_name=" + cat_name,

                    success: function (data) {
                        if (data != "") {

                            $("#not").css("visibility", "hidden");
                            $("#same").css("visibility", "");
                            $("#save").prop("disabled", true);

                        } else {

                            $("#not").css("visibility", "");
                            $("#same").css("visibility", "hidden");
                            $("#save").prop("disabled", false);
                        }

                    }
                });

    });

    $(".update-admin").click(function (){
        var id = $(this).attr("data-admin-id");
        var name = $(this).attr("data-admin-name");
        var email=$(this).attr("data-admin-email");
        var password = $(this).attr("data-admin-password");

        // $("#modal_category_title").text("Update Category");
        $("#modal_admin_id").val(id);
        // $("#modal_submit_btn").text("Update");
        $("#modal_admin_name").val(name);
        $("#modal_admin_email").val(email);

        $("#modal_admin_password").val(password);

    });
    $(".update-cat").click(function (){
        var id = $(this).attr("data-cat-id");
        var name = $(this).attr("data-cat-name");
        var image=$(this).attr("data-cat-image");
        // $("#modal_category_title").text("Update Category");
        $("#modal_cat_id").val(id);
        // $("#modal_submit_btn").text("Update");
        $("#modal_cat_name").val(name);
        $("#old_cat_name").val(name);
        var i=$("#old_cat_image").val(image);


    });




});
