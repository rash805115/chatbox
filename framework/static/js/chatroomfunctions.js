window.onload = chatLoad;

var emoticonImages = {};
emoticonImages[":)"] = "emoticonimages/smile.png";
emoticonImages[":("] = "emoticonimages/sad.gif";
emoticonImages[";)"] = "emoticonimages/wink.bmp";
emoticonImages[":D"] = "emoticonimages/laugh.gif";
emoticonImages[":'("] = "emoticonimages/cry.gif";
emoticonImages["(heart)"] = "emoticonimages/heart.png";
emoticonImages["^_^"] = "emoticonimages/flirt.png";
emoticonImages[":*"] = "emoticonimages/kiss.png";
emoticonImages[":p"] = "emoticonimages/tease.png";
emoticonImages[":P"] = "emoticonimages/tease.png";

function chatLoad()
{
	    var user = document.getElementById("useriduser").innerHTML;
	    var id = document.getElementById("groupiduser").innerHTML;
		var path = "http://localhost/chatbox/framework/chatroom/" + id;

		$.post(path, {groupid:id, userid:user}, function(data)
		{
		        var a = renderChatData(data);
				$('#chatdata').html(a);
				$('#chatdata').scrollTop($('#chatdata').prop("scrollHeight"));
		        setTimeout("chatLoad();", 1000);
	    });
}

function renderChatData(chatData)
{
		chatData = chatData.split(" ");
		
		for(var i = 0; i < chatData.length; i++)
		{
			if(chatData[i] in emoticonImages)
			{
					var fullImageFilePath = "http://localhost/chatbox/framework/file/images/" + emoticonImages[chatData[i]];
					chatData[i] = "<img src='" + fullImageFilePath + "' />";
			}
		}
		
		chatData = chatData.join(" ");
		return chatData;
}