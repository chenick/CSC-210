var animate;
var timer;
var turbotimer;
var i = 0;
var frameArray;

//Change font size based on user selection
function ChangeSize() {
	
    var selectedsize = "";
    var len = document.SizeForm.size.length;
    var j;
	
    for (j = 0; j < len; j++) {
		if (document.SizeForm.size[j].checked) {
			selectedsize = document.SizeForm.size[j].value;
			break;
		}
	}

    if (selectedsize == "small") {
		document.getElementById("displayarea").style.fontSize = "7pt";
	} 
    else if (selectedsize == "medium") {
		document.getElementById("displayarea").style.fontSize = "12pt";
	}
    else if (selectedsize == "large") {
		document.getElementById("displayarea").style.fontSize = "24pt";
	}
}		

//Change display area based on selected animation
function selectAnimation() {
	var temp = document.getElementById("animationtype");
	var animation = temp.options[temp.selectedIndex].value;
	var display = document.getElementById("displayarea");
	if (animation == "blank") {
		animate = "Blank";
	        display.value = ANIMATIONS[animate];
	}
	else if (animation == "exercise") {
	        animate = "Exercise";
                display.value = ANIMATIONS[animate];
	} 
	else if (animation == "juggler") {
	        animate = "Juggler";
                display.value = ANIMATIONS[animate];
	} 
	else if (animation == "bike") {
                animate = "Bike";
                display.value = ANIMATIONS[animate];
	} 
	else if (animation == "dive") {
		animate = "Dive";
                display.value = ANIMATIONS[animate];
	}
	else if (animation == "custom") {
		animate = "Custom";
                display.value = ANIMATIONS[animate];
	}
}

//Start and stop animations based on user clicking
function Start() {
	//document.getElementById("startButton").disbaled = true;
	//document.getElementById("stopButton").disabled = false;
	var rawString = document.getElementById("displayarea").value;
        frameArray = rawString.split("=====");
	setTimer();
}

//Added to support Extra Credit Turbo functionality
function setTimer() {
	timer = setInterval(playStrings, 200);
}

function playStrings() {
	if (i < frameArray.length) {	
		document.getElementById("displayarea").value = frameArray[i];
		i++;
	}
	else { i = 0; }
}

function Stop() {
	//document.getElementById("stopButton").disabled = true;
	//document.getElementById("startButton").disbaled = false;
	clearInterval(timer);
	clearInterval(turbotimer);
	document.getElementById("displayarea").value = ANIMATIONS[animate];
}

function Turbo() {
	if(document.getElementById("turbo").checked) {
		clearInterval(timer);
		turbotimer = setInterval(playStrings, 50);
	}
	else { 
		clearInterval(turbotimer);
		setTimer();
	}
}
