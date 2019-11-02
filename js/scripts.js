function getProducts(value) {
    if(value==="s") {
        $("#s_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=samsung&cat=s");
    }
    else if(value==="note") {
        $("#note_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=samsung&cat=note");
    }
    else if(value==="other") {
        $("#other_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=samsung&cat=other");
    }
    else if(value==="apple") {
        $("#app_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=apple");
    }
    else if(value==="htc") {
        $("#htc_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=htc");
    }
    else if(value==="lg") {
        $("#lg_contents").html("<div class='text-center'><img src='images/loader.gif'/></div>").delay(5000).load("get_pro.php?brand=lg");
    }
}
function addToCart(id) {
    var QueryString="action=add&id="+id;
    $("#add_"+id).html("إضافة إلى السلة"+" <i class='fa fa-spinner fa-spin'></i>");
    jQuery.ajax({
        url:"cart.php",
        data:QueryString,
        type:"POST",
        success:function (response) {
            if(response==="success")
            {
                $("#add_"+id).removeClass("btn-primary").addClass("btn-success").html("تمت الأضافة"+" <i class='fa fa-check'></i>");
                var counter=$("#countCart");
                counter.text(parseInt(counter.text())+1)
            }
            else if(response==="error")
            {

            }
            else if(response==="increased"){
                $("#add_"+id).removeClass("btn-primary").addClass("btn-success").html("تمت الأضافة"+" <i class='fa fa-check'></i>");
                $("#qun").modal('show');
            }
        },
        error:function () {}
    });
}
function quanChanged(id) {
    var quan=$("#quan_"+id);
    var price=$("#pri_"+id);
    var total=$("#tot_"+id);
    var totals=$("#CartTotal");
    var count=$("#countCart");
    var tr=$("#tr_"+id);
   var QueryString="action=add&id="+id+"&qun="+quan.val();
   jQuery.ajax({
       url:"cart.php",
       data:QueryString,
       type:"post",
       success:function (data) {
           if (data==="deleted"){
               $("#confirmRemove").modal('show');
               $(document).on("click","#remove",function () {
                   count.text(parseInt(count.text())-1);
                   totals.text(parseInt(totals.text())-parseInt(total.text()));
                   tr.fadeOut('slow');
                   $("#confirmRemove").modal('hide');
               });
           }else if(data==="increased"){
               totals.text(parseInt(totals.text())-parseInt(total.text()));
               total.text(parseInt(price.text())*parseInt(quan.val()));
               totals.text(parseInt(totals.text())+parseInt(total.text()));
           }
           else {
               price.text(data);
           }
       },
       error:function () {}
   });
}
function removeItem(id) {
    var price=$("#pri_"+id);
    var total=$("#tot_"+id);
    var totals=$("#CartTotal");
    var count=$("#countCart");
    var tr=$("#tr_"+id);
    var QueryString="action=delete&id="+id;
    jQuery.ajax({
        url:"cart.php",
        data:QueryString,
        type:"post",
        success:function (data) {
            if (data==="deleted"){
                $("#confirmRemove").modal('show');
                $(document).on("click","#remove",function () {
                    count.text(parseInt(count.text())-1);
                    totals.text(parseInt(totals.text())-parseInt(total.text()));
                    tr.fadeOut('slow');
                    $("#confirmRemove").modal('hide');
                });
                $(document).on("click","#cancel",function () {
                   $("#confirmRemove").modal('hide');
                });
            }
            else {
                price.text(data);
            }
        },
        error:function () {}
    });
}
function EmptyCart() {
    var QueryString="action=remove_all";
    jQuery.ajax({
        url:"cart.php",
        data:QueryString,
        type:"post",
        success:function (data) {
            if (data==="done"){
                $("#cartList").slideUp('slow');
                $("#cont").removeClass("hide");
                $("#countCart").text(0);
            }
            else {
                $("#CartTotal").text(data);
            }
        },
        error:function () {}
    });
}
function startDetails(id) {
    var modal=$("#detailsModal");
    $("#detailsBody").html("<div class='text-center'><img src='images/loader.gif'/></div>");
    modal.modal('show');
    jQuery.ajax({
        url:"details.php",
        data:"id="+id,
        type:"post",
        success:function (response) {
            $("#detailsBody").html(response);
        },
        error:function () {}
    });
}
$(document).ready(function () {
    $(window).scroll(function () {
        if($(this).scrollTop()>250){
            $("#scrollTop").removeClass("hidden").fadeIn(500);
        }else {
            $("#scrollTop").addClass("hidden").fadeOut(500);
        }
    });
});
function ShowPic(img) {
    var QueryString="action=get_pic&id="+img;
    $("#ShowPic").modal('show');
    $("#productPic").html("<div class='text-center'><img src='images/loader.gif'/></div>");
    jQuery.ajax({
        url:"cart.php",
        data:QueryString,
        type:"post",
        success:function (response) {
            $("#productPic").html(response);
        },
        error:function () {}
    });
}
function buy() {
    jQuery.ajax({
        url:"cart.php",
        data:"action=check",
        type:"post",
        success:function (response) {
            if(response==="success"){
                EmptyCart();
            }
            else if(response==="error") {
                location.href="../signin.php";
            }
        },
        error:function () {}
    });
}
$(window).on('load', function () {
    //loading Elements
    $(".loading-overlay .spinner").fadeOut(1000, function () {
        //Shoo The Scroll
        $("body").css("overflow", "auto");
        $(this).parent().fadeOut(2000, function () {
            $(this).remove();
        });
    });
});