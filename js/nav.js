$(document).ready(function(){
        $("#data1").hide();
        $("#data2").hide();
        $("#data3").hide();
        $("#data4").show();
        $("#data5").hide();
    $("#nav1").click(function(){
        $("#list1").attr("class","active");
        $("#list2").attr("class","");
        $("#list3").attr("class","");
        $("#list4").attr("class","");
        $("#list5").attr("class","");
        $("#data1").show();
        $("#data2").hide();
        $("#data3").hide();
        $("#data4").hide();
        $("#data5").hide();
    });
    $("#nav2").click(function(){
        $("#list1").attr("class","");
        $("#list2").attr("class","active");
        $("#list3").attr("class","");
        $("#list4").attr("class","");
        $("#list5").attr("class","");
        $("#data1").hide();
        $("#data2").show();
        $("#data3").hide();
        $("#data4").hide();
        $("#data5").hide();
    });
    $("#nav3").click(function(){
        $("#list1").attr("class","");
        $("#list2").attr("class","");
        $("#list3").attr("class","active");
        $("#list4").attr("class","");
        $("#list5").attr("class","");
        $("#data1").hide();
        $("#data2").hide();
        $("#data3").show();
        $("#data4").hide();
        $("#data5").hide();
    });
    $("#nav4").click(function(){
        $("#list1").attr("class","");
        $("#list2").attr("class","");
        $("#list3").attr("class","");
        $("#list4").attr("class","active");
        $("#list5").attr("class","");
        $("#data1").hide();
        $("#data2").hide();
        $("#data3").hide();
        $("#data4").show();
        $("#data5").hide();
    });
    $("#nav5").click(function(){
        $("#list1").attr("class","");
        $("#list2").attr("class","");
        $("#list3").attr("class","");
        $("#list4").attr("class","");
        $("#list5").attr("class","active");
        $("#data1").hide();
        $("#data2").hide();
        $("#data3").hide();
        $("#data4").hide();
        $("#data5").show();
    });
});