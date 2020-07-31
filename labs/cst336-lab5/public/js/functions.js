/*global functions */
$(document).ready(function(){
    $(".favoriteIcon").on("click",function(){
        
    let queryString = window.location.search;
    let urlParams = new UrlSearchParams(queryString);
    let keyword = UrlParams.get("keyword");
    
    let imageUrl= $(this).prev().attr("src");
        
        if ($(this).attr("src") == "img/favorite.png"){
            $(this).attr("src", "img/favorite_on.png");
            updateFavorite("add", imageUrl, keyword);
        }
        else{
            $(this).attr("src", "img/favorite.png");
            updateFavorite("delete", imageUrl);
        }
    });//favicon
    
    
    function updateFavorite(action, imageUrl, keyword){
        $.ajax({
            method: "get",
            url: "/api/updateFavorites",
            data: {
                "action":action,
                "imageUrl":imageUrl,
                "keyword": keyword
            },
            success: function(data, status){
                
            }
        });//ajax
    }//update fav
    
});//ready


