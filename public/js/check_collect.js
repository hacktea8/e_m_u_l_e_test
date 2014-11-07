 $('#addFav').click(function(){
  if(login_uid){alert('抱歉！您还未登录。请先登录!!');return false;}
  $.get("/index/addCollect/"+article_id, function(result){
   if(result.status==1){
    $('#addFavBtn').attr("src",img_url+"delfavorite.gif");
   }else{
    $('#addFavBtn').attr("src",img_url+"favorite.gif");
   }
  },'json');
 });
