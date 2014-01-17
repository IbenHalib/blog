
$(document).ready(function(){
    var i=1;
    var j=1;
    $("#but1").click(function(){
    i++;
    $("#"+i).load("http://localhost/web/app_dev.php/showArticles/"+i);});

$("#butg1").click(function(){
    j++;
    $("#g"+i).load("http://localhost/web/app_dev.php/gues/posts/"+j);});

});
