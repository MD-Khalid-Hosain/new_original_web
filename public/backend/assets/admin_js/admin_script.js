$(document).ready(function () {

    //current password is correct or not start
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'post',
            url:'/admin/check-current-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp == "false"){
                    $("#check_current_pwd").html("<font color= red>Password is Incorrect</font>")
                } else if (resp == "true"){
                    $("#check_current_pwd").html("<font color= green>Password is Correct</font>")
                }
            },error:function(){
                alert("error");
            }
        });
        //current password is correct or not end

        //new password and confirm password is matching or not
        $('#confirm_pwd').keyup(function (){
            var new_pwd = $('#new_pwd').val();
            var confirm_pwd = $('#confirm_pwd').val();

            if (new_pwd != confirm_pwd){
                $("#showError").html("<font color= red>Password is not match</font>");
            }else{
                $("#showError").html("<font color= green>Password matched </font>");
            }

        });
    });

     $('#admin_confirm_pwd').keyup(function (){
            var new_pwd = $('#admin_new_pwd').val();
            var confirm_pwd = $('#admin_confirm_pwd').val();

            if (new_pwd != confirm_pwd){
                $("#adminShowError").html("<font color= red>Password is not match</font>");
            }else{
                $("#adminShowError").html("<font color= green>Password matched </font>");
            }

        });


    //Admin status active or inactive
    $(".adminStatus").click(function(){
        var status = $(this).text();
        var admin_id = $(this).attr("admin_id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:'/update-admin-status',
            data:{status:status,admin_id:admin_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#admin-"+admin_id).html("<a class='adminStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#admin-"+admin_id).html("<a class='adminStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Admin status active or inactive end
    //Section status active or inactive
    $(".updateSectionStatus").click(function(){
        var status = $(this).text();
        var section_id = $(this).attr("section_id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:'/admin/update-section-status',
            data:{status:status,section_id:section_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Section status active or inactive end

    //Sub Section status active or inactive
    $(".updateSubSectionStatus").click(function(){
        var status = $(this).text();
        var subSection_id = $(this).attr("subSection_id");


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //ajax setup
        $.ajax({
            type:'post',
            url:'/admin/update-subSection-status',
            data:{status:status,subSection_id:subSection_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#subSection-"+subSection_id).html("<a class='updateSubSectionStatus' href='javascript:void(0)' style='color:red'>Inactive</a>");
                }else if(resp['status']==1){
                      $("#subSection-"+subSection_id).html("<a class='updateSubSectionStatus' href='javascript:void(0)'  style='color:green'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });
    //Sub Section status active or inactive end


    //confirm deletion of record

    /*$(".confirmDelete").click(function(){
        var name = $(this).attr("name");
        if(confirm("Are you sure to delete this "+name+"?")){
            return true;
        }
        return false;
    });*/

    //confirm deletion of record with sweetAlert start
    $(".confirmDelete").click(function(){
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href= "/admin/delete-"+record+"/"+recordid;
            }
        });


    });
    //confirm deletion of record with sweetAlert end



});
