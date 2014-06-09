$('#adlink_button').height(document.body.offsetHeight - 312);
$('#adlink_button').click(function(){
cookie.set('ahref_click'+_action,'1',1/24);
$(this).hide();
});

