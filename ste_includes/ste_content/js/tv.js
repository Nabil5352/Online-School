var position = 0;
var playlist;
var video;

//page loaded

window.onload = function() {

	//basic settings
	
	video = document.getElementById("video");
	video.addEventListener("ended", nextVideo, false);
	
	video.src = playlist[position] ;
	video.load();
	
	//for control handler
	var controlLinks = document.querySelectorAll("a.control");
	for(var i=0; i<controlLinks.length; i++){
		controlLinks[i].onclick = handleControl;
	}
	
	var effectLinks = document.querySelectorAll("a.effect");
	for(var i=0; i<effectLinks.length; i++){
		effectLinks[i].onclick = setEffect;
	}
	
	var videoLinks = document.querySelectorAll("a.videoSelection");
	for(var i=0; i<videoLinks.length; i++){
		videoLinks[i].onclick = setVideo;
	}
	
	pushUnpushButtons("video1", []);
	pushUnpushButtons("normal", []);
		

}

function nextVideo() {
	position++;
	if(position >= playlist.length){
		position = 0;
	}
	
	video.src = playlist[position];
	video.load();
	video.play();
}

	//handleControl handler
	function handleControl(e){
		var id = e.target.getAttribute("id");
		
		if(id == "play"){
			pushUnpushButtons("play", ["pause"]);
		}
		else if(id == "pause"){
			pushUnpushButtons("pause", ["play"]);
		}
		else if(id == "loop"){
			if(isButtonPushed("loop")){
			pushUnpushButtons("", ["loop"]);
			}else{
			pushUnpushButtons("play", ["pause"]);
			}
		}
		else if(id == "mute"){
			if(isButtonPushed("mute")){
			pushUnpushButtons("", ["mute"]);
			}else{
			pushUnpushButtons("mute", []);
			}
		}
	}
	
	//setEffect handler
	function setEffect(e){
		var id = e.target.getAttribute("id");
		
		if(id == "normal"){
			pushUnpushButtons("normal", ["western", "noir", "scifi"]);
		} 
		else if(id == "western"){
			pushUnpushButtons("western", ["normal", "noir", "scifi"]);
		}
		else if(id == "noir"){
			pushUnpushButtons("noir", ["normal", "western", "scifi"]);
		}
		if(id == "scifi"){
			pushUnpushButtons("scifi", ["normal", "western", "noir"]);
		}
	}
	
	//setVideo handler
	var id = e.target.getAttribute("id");
	if(id = "video1"){
		pushUnpushButton("video1", ["video2"]);
	}
	else if(id = "video2"){
		pushUnpushButton("video2", ["video1"]);
	}
	
	//helper functions
	function pushUnpushButtons(idToPush, idArrayToUnpush){
		if(idToPush != ""){
			var anchor = document.getElementById(idToPush);
			var theClass = anchor.getAttribute("class");
			if(!theClass.indexOf("selected") >= 0){
				theClass = theClass + " selected";
				anchor.setAttribute("class", theClass);
				var newImage = "url(img/" + idToPush + "pressed.png)";
				anchor.style.backgroundImage = newImage;
			}
		}
		
		for(var i=0; i<idArrayToUnpush.length; i++){
			anchor = document.getElementById(idArrayToUnpush[i]);
			theClass = anchor.getAttribute("class");
			if(theClass.indexOf("selected")>=0){
				theClass = theClass.replace("selected", "");
				anchor.setAttribute("class", theClass);
				anchor.style.backgroundImage = "";
			}
		}

	}
	
	function isButtonPushed(id){
		var anchor = document.getElementById(id);
		var theClass = anchor.getAttribute("class");
		return (theClass.indexOf("selected") >= 0);
	}