"use strict";
var	G_state = 0;
var	G_relod_after = 2;
var	G_num_errors = 0;
var	G_show_help = 0;
var	G_max_errors_allowed = 5;
var	G_verbose = 0;

/*
window.onclick = e => {
	 console.log(e.target);
	 console.log(e.target.tagName);
	 console.log(e.target.innerText);
} 
*/

function msg(s, show_help) {
	if (show_help) {
		console.log(s);
	}
}

/*
   TBD
var input = document.getElementById("id_password_repondre");
input.addEventListener("keyup", function(event) {
	event.preventDefault();
	if (event.keyCode === 13) {
		document.getElementById("id_password_repondre").click();
	}
});
*/

function sm(event) {
	//console.log(event.target.id);
	//console.log(event.target.tagName);
	//console.log(event.target.innerText);
	
	var c = {};
	var p = {};
	var cluster_img;
	var	elt_id = event.target.id;

	msg("sm(): state: " + G_state, G_verbose);
	msg("sm(): " + elt_id, G_verbose);
	switch (G_state) {
		case 0:
			if (elt_id == "id_parler") {
				showHide("id_welcome_message", "show");
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);
			}
			break;
		case 1:
			if (elt_id == "id_input_password") {
				showPasswordBox();
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);
			}
			break;
		case 2:
			if (elt_id == "id_password_repondre") {
				if (checkPassword()) {
					msg("state: " + G_state + "-->" + (++G_state), G_verbose);
				}
			}
			break;
		case 3:
			if (elt_id == "id_text_repondre") {
				if (checkBonjourInputMessage()) {
					msg("state: " + G_state + "-->" + (++G_state), G_verbose);
				}
			}
			break;
		case 4:
			if (elt_id == "id_text_repondre") {
				if (checkJeVousEcouteMessage()) {
					msg("state: " + G_state + "-->" + (++G_state), G_verbose);
					setOnClickTo("id_architecture", showAfterClickArchitecture);
				}
			}
			break;			
		case 5:
			if (elt_id == "id_architecture") {
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);	
				c = { "id_brik": badChoice, "id_avancer": badChoice, "id_prendre": badChoice, "id_regarder": badChoice, "id_utiliser": removeMurAndShowTowel };
				setOnClickToAll(c);
				setInnerText("id_span", "detruisez le mur ...");
				setValue("id_text_message", "");
			} 
			break;
		case 6:
			if (elt_id == "id_utiliser" && (G_num_errors < 5)) {
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);	
				msg("correct", G_verbose);

				setInnerText("id_span", "prenez la serviette... cela devient chaud...");
				setValue("id_text_message", "");

				c = { "id_brik": doNoThing, "id_towel": badChoice, "id_avancer": badChoice, "id_prendre": takeServiette, "id_regarder": badChoice, "id_utiliser": badChoice };
				setOnClickToAll(c);
				G_show_help = 0;
				msg("help est desactive maintenant.", 1);
			}
			checkNumErrors();
			break;
		case 7:
			if (elt_id == "id_prendre" && (G_num_errors < 5)) {
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);	

				setInnerText("id_span", "c est tres tres chaud...\nregardez dans la serviette, on ne sait jamais...");
				setValue("id_text_message", "");

				c = { "id_brik": doNoThing, "id_towel": badChoice, "id_avancer": badChoice, "id_prendre": badChoice, "id_regarder": bravo, "id_utiliser": badChoice };
				setOnClickToAll(c);
				G_show_help = 0;
				msg("help est desactive maintenant.", 1);
			}
			checkNumErrors();
			break;
		case 8:
			if (elt_id == "id_regarder" && (G_num_errors < 5)) {
				msg("state: " + G_state + "-->" + (++G_state), G_verbose);	
				cluster_img = document.getElementById("id_cluster");
				cluster_img.src = "resources/dontpanic.jpg";
			}
			checkNumErrors();
			break;
		case 9:
				//displayThanksImage();
				thanksToMessageAndUnSetAllOnClick();
				sleep(2000);
				reloadDocument();
			break;
		default: 
			break;
	}
}


function showWelcomeMessage(value) {
	showHide("id_welcome_message", "show");
}

function showPasswordBox() {
	showHide("id_password_form", "show");
	showHide("id_password", "show");
}

function checkPassword() {
	var password = getValue("id_input_password");
	var p = {};
	var text = "";

	if (password == "42")  {
		p = {
			"id_password_form": "hide",
			"id_password": "hide",
			"id_text_form": "show",
			"id_text": "show",
			"id_cluster": "show"
		};
		showHideAll(p);

		text = "oui\n";
		text += "non et attendre un instant\n";
		msg(text, 1);
		return (true);
	} else {
		alert("desole. essayez a nouveau...!!"); 
		setValue("id_input_password", "");
		return (false);
	}
}

function checkBonjourInputMessage() {
	var message = getValue("id_text_message");
	if (message.toLowerCase() == "oui")  {
		setInnerText("id_span", "je vous ecoute...");
		setValue("id_text_message", "");
		msg("je cherche mon livre\n", 1);
		return (true);
	} else if (message.toLowerCase() == "non") {
		/* rien a faire */
		setInnerText("id_span", "ok");
		reloadDocument();
		return (false);
	} else {
		alert("pas compris!!"); 
		setValue("id_text_message", "");
		return (false);
	}
}

function checkJeVousEcouteMessage() {
	var message = getValue("id_text_message");

	if (message == "je cherche mon livre")  {
		setInnerText("id_span", "utilisez la loupe et trouvez le mot 'architecture'\n ensuite cliquez dessus");
		showHide("id_loupe", "show");
		return (true);
		
	} else {
		alert("pas compris!!"); 
		setValue("id_text_message", "");
		return (false);
	}
}

function showAfterClickArchitecture() {
	var p = {};
	var c = {};

	alert("bien vu :=)");
	p = {
		"id_brik": "show",
		"id_avancer": "show",
		"id_prendre": "show",
		"id_regarder": "show",
		"id_utiliser": "show"
	};
	showHideAll(p);
	document.getElementById("id_regarder").classList.add("cadrerouge");
}

function removeMurAndShowTowel() {
	var p = {};
	p = {
		"id_brik": "hide",
		"id_towel": "show",
	};
	showHideAll(p);
}

function badChoice() {
	G_num_errors++;
	msg("faux!! num errors: " + G_num_errors, G_verbose); 
}

function takeServiette() {
	var c = {};

	setInnerText("id_span", "c est tres tres chaud...\nregardez dans la serviette, on ne sait jamais...");
	c = {
		"id_prendre": "badChoice",
		"id_regarder": "badChoice",
	};
	setOnClickToAll(c);
}


function bravo() {
	var p = {};
	var c = {};

	p = {
		"id_book": "show",
		"id_towel": "hide",
	};
	showHideAll(p);
	document.getElementById("id_regarder").classList.add("cadrerouge");

	setInnerText("id_span", "bravo...");
	setValue("id_text_message", "");
}

function thanksToMessageAndUnSetAllOnClick() {
	var p = {};
	var c = {};

	msg("thanksToMessageAndUnSetAllOnClick()", G_verbose);
	p = {
		"id_loupe": "hide",
		"id_book": "hide",
		"id_towel": "hide",
		"id_brik": "hide",
		"id_avancer": "hide",
		"id_prendre": "hide",
		"id_regarder": "hide",
		"id_utiliser": "hide",
		"id_cluster": "hide",
	};
	showHideAll(p);
	document.getElementById("id_regarder").classList.remove("cadrerouge");
	c = {
		"id_regarder": doNoThing,
	};
	setOnClickToAll(c);

	setInnerText("id_span", "scenario inspire de amottier, merci a lui...");
	setValue("id_text_message", "");
	displayThanksImage();
}

function doNoThing() {
}

function retryAgain() {
	var	cluster_img;
	var	c = {};
	G_num_errors = 0;

	// TBD setOnClickTo("id_day_of_the_42", showHelpOnConsole);
	showHelpOnConsole();
	switch (G_state) {
		case 6:
			msg("cliquez sur les outils...\n", G_show_help);
			setInnerText("id_span", "detruisez le mur ...");
			c = { "id_brik": badChoice, "id_avancer": badChoice, "id_prendre": badChoice, "id_regarder": badChoice, "id_utiliser": removeMurAndShowTowel };
			setOnClickToAll(c);
			break;
		case 7:
			msg("cliquez sur la main...\n", G_show_help);
			setInnerText("id_span", "prenez la serviette... cela devient chaud...");
			c = { "id_brik": doNoThing, "id_towel": badChoice, "id_avancer": badChoice, "id_prendre": takeServiette, "id_regarder": badChoice, "id_utiliser": badChoice };
			setOnClickToAll(c);
			break;
		case 8:
			msg("cliquez sur l oeil...\n", G_show_help);
			setInnerText("id_span", "c est tres tres chaud...\nregardez dans la serviette, on ne sait jamais...");
			c = { "id_brik": doNoThing, "id_towel": badChoice, "id_avancer": badChoice, "id_prendre": badChoice, "id_regarder": bravo, "id_utiliser": badChoice };
			setOnClickToAll(c);
			break;
		default: 
			break;
	}
	cluster_img = document.getElementById("id_cluster");
	cluster_img.src = "resources/cluster.jpg";
}

function checkNumErrors() {
	var	cluster_img;
	var message = "";
	var c = {};
	if (G_num_errors >= G_max_errors_allowed) {
		cluster_img = document.getElementById("id_cluster");
		cluster_img.src = "resources/monkey.jpg";

		// ne m affiche pas monkey alert("num errors >= " + G_max_errors_allowed);

		message	= "faux!! nombre d'erreurs '" + G_num_errors + "' depassant le maximum autorise.\n\n"; 
		message += "recommencez avec l'aide: cliquez sur 'day of the 42'\n\n"; 
		message += "et examinez la console"; 
		setInnerText("id_span", message);

		c = { "id_brik": badChoice, "id_avancer": badChoice, "id_prendre": badChoice, "id_regarder": badChoice, "id_utiliser": badChoice };
		setOnClickToAll(c);
		setOnClickTo("id_day_of_the_42", retryAgain);
	}
}

function displayThanksImage() {
	var cluster_img = document.getElementById("id_cluster");
	var p = {};

	p = {
		"id_cluster": "show",
	};
	showHideAll(p);
	cluster_img.src = "resources/thanks.jpg";
	cluster_img.style.borderRadius = "50%";
	cluster_img.style.width = "200px";
	cluster_img.style.height = "200px";
	cluster_img.style.margin = "0 auto";
	cluster_img.style.display = "block";
}

function showHelpOnConsole() {
	G_show_help = 1;
	msg("help est active maintenant.", G_show_help);
}

function showHide(id, ac) {
	//console.log(id);
	//console.log(ac);
	var elt = document.getElementById(id);
	//console.log(elt);
	if (ac == "show") {
		document.getElementById(id).classList.remove("hidden");
	} else if (ac == "hide") {
		document.getElementById(id).classList.add("hidden");
	}
}

function showHideAll(p) {
	var key = "";
	for (key in p) {
		if (p.hasOwnProperty(key)) {
			//console.log(key + " -> " + p[key]);
			showHide(key, p[key]);
		}
	}
}

function getValue(id) {
	var elt = document.getElementById(id);
	return (elt.value);
}

function setValue(id, value) {
	var elt = document.getElementById(id);
	elt.value = value;
}

function getInnerText(id) {
	var elt = document.getElementById(id);
	return (elt.innerText);
}

function setInnerText(id, value) {
	var elt = document.getElementById(id);
	elt.innerText = value;
}

function getOnClickTo(id, f) {
	var elt = document.getElementById(id);
	return (elt.onclick);
}

function setOnClickTo(id, f) {
	var elt = document.getElementById(id);
	elt.onclick = f;
	//elt.setAttribute("onclick", f + "()");
}

function setOnClickToAll(c) {
	var key = "";
	for (key in c) {
		if (c.hasOwnProperty(key)) {
			//console.log(key + " -> " + c[key]);
			setOnClickTo(key, c[key]);
		}
	}
}

function reloadDocument() {
	setInterval('window.location.reload()', G_relod_after * 1000);
}

function sleep(miliseconds) {
	var currentTime = new Date().getTime();

	while (currentTime + miliseconds >= new Date().getTime()) {
	}
}

