
 $(document).ready(function() {

    $("#searc-hbar").keyup(function() {

        var name = $('#searc-hbar').val();
       
        if (name == "") {

            $("#display").html("");
        }

        else {
      
            $.ajax({
               
                type: "POST",
              
                url: "serch-p.php",
              
                data: {
                
                    search: name
                },
              
                success: function(html) {
                 
                    $("#display").html(html).show();
                }
            });
        }
    });
 });
 $(document).ready(function() {

    $("#email").keyup(function() {

        var name = $('#email').val();
       
        if (name == "") {

            $("#display-email-c").html("");
        }

        else {
      
            $.ajax({
               
                type: "POST",
              
                url: "validate-em-uc.php",
              
                data: {
                
                    search: name
                },
              
                success: function(html) {
                 
                    $("#display-email-c").html(html).show();
                }
            });
        }
    });
 });
 $(document).ready(function() {
     
    $("#notification-fo-lt").on("click",function() {
        $("#display-notification-fo-lt").toggle();
        $.ajax({
            type: "POST",
            url: "show-not-em-uc.php",
            data: {
                show_n: true
            },
            success: function(html) {  
                $("#display-notification-fo-lt").html(html);
            }
        });

    });
    // $(".view_c_repo_rt").siblings(".col-sm-5.offset-5.pt-2.border.mt-n3").hide();
    $(".view_c_repo_rt").on("click",function() {
        $(this).show();
        $(this).siblings(".col-sm-5.offset-5.pt-2.border.mt-n3").toggle();
        // $(".col-sm-5.offset-5.pt-2.border.mt-n3").toggle();

    });
 });