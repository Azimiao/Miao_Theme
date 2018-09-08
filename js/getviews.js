var ajaxPath = "http://localhost.azimiao.com/wp-admin/admin-ajax.php";
function GetViewsNum(){
    console.log("GetViewsNum");
    var mData = document.getElementsByName("viewsNum");
    for(var i = 0; i < mData.length;i++){
        var tempID = mData[i].id;
        console.log(tempID);
        var tempIDNum = tempID.substring(9);
        console.log(tempIDNum);
        Test(tempID,tempIDNum,mData[i]);
    }
}

function GetViewsNumSingle(){
    ele = document.getElementById("viewsNum");
    if(ele){
        console.log("GetViewsNumSingle");
        jQuery.ajax(
        {  
            type: "GET",  
            url: ajaxPath,  
            data: {action:"SetVisitors",post_id:ele.attributes["name"].value},  
            dataType: "json",  
            success: function(data)
            {  
                ele.innerHTML =data;
            }  
        })  
    }
    
  }


function Test(tempID,tempIDNum,mElement = null){
    jQuery.ajax({
            type:"GET",
            url:ajaxPath,
            data:{action:"GetVisitors",post_id:tempIDNum},
            dataType:"json",
            success:function(data){
                if(mElement == null){
                    $("#" + tempID).html(data);
                    return;
                }
                mElement.innerHTML = data;
            }
        })
}