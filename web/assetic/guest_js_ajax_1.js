$(document).ready(function(){
    var i=1;
    $("#but1").click(function(){
        i++;
        $("#"+i).load("http://guest/posts/"+i);
    });
});
