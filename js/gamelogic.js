//variabili globali
var pixel = "px";	
var altDiv = 450, largDiv = 700;
var grafica;
var idUfo = 'ufoId';

function inizializza(){
	var welcome = document.getElementById('gamewindow');	//schermata di welcome che anticipa il gioco vero e proprio
	welcome.setAttribute('style',"background:url('../media/backgrounds/lev0.png')");	//invece di .style per non avere errori dal validatore
	welcome.setAttribute('onclick','avviaGioco();');
}

function avviaGioco(){
				 grafica = new Grafica();
				 grafica.avvia();
}

function Grafica(){		//livello logico di grafica
				 this.gioco = new Gioco();

				 this.divGioco = document.getElementById("gamewindow");
				 this.divGioco.removeAttribute('onclick');
				
				 this.bground = new Array();		//array degli sfondi di gioco
				 for(var i = 1; i < 9; i++){
				 		 this.bground[i] = new String('../media/backgrounds/lev'+i+'.png');	
				 }
				 this.divGioco.setAttribute('style',"background:url('"+ this.bground[this.gioco.level] +"')");


				 //creazione scritte di gioco
	 			 this.levelPar = document.createElement('p');
	 			 this.scorePar = document.createElement('p');
	 			 this.killsPar = document.createElement('p');
	 			 this.levelPar.id = 'livello';
	 			 this.scorePar.id = 'punteggio';
	 			 this.killsPar.id = 'uccisioni';
	 			 this.levelText = document.createTextNode('LEVEL: 1');
	 			 this.scoreText = document.createTextNode('SCORE: 0');
	 			 this.killsText = document.createTextNode('KILLS: 0');
	 			 this.levelPar.appendChild(this.levelText);
	 			 this.scorePar.appendChild(this.scoreText);
	 			 this.killsPar.appendChild(this.killsText);
	 			 this.divGioco.appendChild(this.levelPar);
	 			 this.divGioco.appendChild(this.scorePar);
	 			 this.divGioco.appendChild(this.killsPar);
				 
				 this.timer = null;	//timer di rendering
				 this.tempodead = null;	//timer sul rendering nemici morti
				 
				 //numero di chiamate di render() prima di visualizzare il nemico attesaNemico/tempoRender
				 this.numChiamate = 0;
				 this.contaChiamate = 0;
				 this.contaEnemyInMov = 0;
				 //tempo di ritardo tra un enemy e un altro e' tempoRender (fisso) + tempo casuale
				 this.maxIntervNextEnemy = [5000, 4000, 2000, 2000, 2000, 2000, 1200]; 
				 this.tempoRender = 50;
				 this.passo = [10, 10 , 12 , 12 , 12 , 12 , 13 ];	//passo di movimento del nemico
				 this.tempoExplode = 165;
				 
				 for (var i=0; i<this.gioco.numEnemy; i++){		//inserisci nello sfondo di gioco i nemici
				 		 this.divGioco.appendChild(this.gioco.vetEnemy[i].imgDiv);
				 }
				 
				 this.calcolaRitardoNextEnemy = calcolaRitardoNextEnemy;	//metodo calcolaRitardoNextEnemy()
				 this.cambiaLivello = cambiaLivello;	//metodo cambiaLivello()
				 this.avvia = avvia;	//metodo avvia()
				 this.aggiornaPunti = aggiornaPunti; //metodo aggiornaPunti()
				 this.gameover = gameover;	//metodo gameover()
				 
}

function avvia(){
				 this.timer = setInterval('render()', this.tempoRender);
				 this.tempodead = setInterval('fall()', this.tempoExplode);
}

function Gioco(){	//livello logico di gioco vero e proprio
				 this.level = 0; //0: welcome screen, 1 -> 7 livelli effettivi di gioco, 8 gameover
				 this.numMaxLevel = 9; 
				 this.score = 0;
				 this.killed = 0;
				 
				 this.vetEnemy = null;
				 this.numEnemy = 0;
				 this.vetNumEnemy = [5,10,15,20,25,30,35];	//quanti nemici per ogni livello
				 this.fuoriGioco = 0; //numero di nemici ormai fuori gioco
				 
				 this.nextLevel = nextLevel;	//metodo nextLevel()
				 
				 this.nextLevel();
}

function nextLevel(){
				 this.level++;
				 if(this.level == this.numMaxLevel - 1){	//finiti i livelli
				 	grafica.gameover();
				 }
				 else{
				 	this.killed = 0;
				 	this.fuoriGioco = 0;
				 	this.numEnemy = this.vetNumEnemy[this.level-1];
					this.vetEnemy = new Array();
					for (var i=0; i < this.numEnemy; i++){
						this.vetEnemy[i] = new Enemy(i);	//passo un intero che verra impiegato per creare un id per ogni nemico
						}
					}
}

function Enemy(i){
		         this.imgDiv = document.createElement('div');
				 this.img = document.createElement('img');
				 this.imgDiv.appendChild(this.img);
				 this.img.src='../media/sprites/ufo/ufo0.png';
				 this.img.alt = 'UFO';
				 this.largEnemy = 46;
				 this.altEnemy = 42;
				 this.DX = (Math.round(Math.random()) == 1);	//stabilisce se parte da dx o da sx dello schermo di gioco
				 this.img.style.left = !this.DX ? (-this.largEnemy + pixel) : (largDiv + pixel);	
				 this.img.style.top = (Math.random()*(altDiv-this.altEnemy)) + pixel;	//da quale altezza parte
				 var ran = Math.random();
				 this.traiettoria = ( (ran < 0.3) ? -1 : (ran < 0.6) ? 0 : 1);	//il tipo di traiettoria che seguira
				 this.img.style.visibility='hidden';
				 this.img.style.position= 'absolute';
				 this.img.onmousedown = hit;	//uccisione del nemico
				 this.img.ondragstart = new Function('return false;'); //per evitare il dragging delle immagini
				 this.isComparso = false;	//booleano per indicare se il nemico é mandato a schermo di gioco

				 this.dead = false;
				 this.contaDead = 1;
				 this.numDead = 8;
				 this.scomparso = false;
				 this.img.id = idUfo + i;	//mi serve in in hit() per ritornare all'Enemy colpito
}

function calcolaRitardoNextEnemy(){	//calcola il numero di chiamate a render() random da effettuare per un nemico
				 this.numChiamate = Math.round(((Math.random() * this.maxIntervNextEnemy[this.gioco.level - 1]) + this.tempoRender )/ this.tempoRender);
				 this.contaChiamate = 0;
}

function render(){
	with(grafica){
		if (contaEnemyInMov < gioco.numEnemy){	
  			if (contaChiamate == numChiamate){     //e' il momento di renderizzare il nemico a schermo
  				gioco.vetEnemy[contaEnemyInMov].isComparso = true;
  				gioco.vetEnemy[contaEnemyInMov].img.style.visibility = 'visible';
  				contaEnemyInMov++;
  				calcolaRitardoNextEnemy();
  				}
  			else{
  				contaChiamate++;
  				}
		}
						
		for (var i=0; i < gioco.vetEnemy.length; i++){
			if (gioco.vetEnemy[i].isComparso){	//solo quelli renderizzati vanno messi in movimento
				if(parseInt(gioco.vetEnemy[i].img.style.top) >= (altDiv - gioco.vetEnemy[i].altEnemy)){
					gioco.vetEnemy[i].traiettoria = 0;
					}
				else if(parseInt(gioco.vetEnemy[i].img.style.top) <= 0){
					gioco.vetEnemy[i].traiettoria = -1;
					}

			//in base alla traiettoria assegnata: scendi, sali, nulla (orizzontale)
				if(gioco.vetEnemy[i].traiettoria == -1){
					gioco.vetEnemy[i].img.style.top = (parseInt(gioco.vetEnemy[i].img.style.top) + 1) + pixel;								
					}
				else if(gioco.vetEnemy[i].traiettoria == 0){
					gioco.vetEnemy[i].img.style.top = (parseInt(gioco.vetEnemy[i].img.style.top) - 1) + pixel;								
					}

				if (!gioco.vetEnemy[i].DX){	//compare da sx e si muove verso dx
					gioco.vetEnemy[i].img.style.left = (parseInt(gioco.vetEnemy[i].img.style.left) + passo[gioco.level - 1]) + pixel;
					if(parseInt(gioco.vetEnemy[i].img.style.left) > largDiv){	//esce dalla schermata di gioco
						gioco.vetEnemy[i].img.style.visibility = 'hidden';
						gioco.vetEnemy[i].isComparso = false;
						gioco.fuoriGioco += 1;
						}
				}
				else{ //compare da dx e si muove verso sx
					gioco.vetEnemy[i].img.style.left = (parseInt(gioco.vetEnemy[i].img.style.left) - passo[gioco.level - 1]) + pixel;
					if(parseInt(gioco.vetEnemy[i].img.style.left) < -gioco.vetEnemy[i].largEnemy){ //esce dalla schermata di gioco
						gioco.vetEnemy[i].img.style.visibility = 'hidden';
						gioco.vetEnemy[i].isComparso = false;
						gioco.fuoriGioco += 1;
						}
				}
		}
		
		if(gioco.fuoriGioco == gioco.numEnemy){	//sono tutti fuori: e'giunto il momento di cambiare livello
			cambiaLivello();
			}
							
		}
	}
}

function hit(e){	//quando viene cliccato un ufo
	//parte grafica
	e = (!e) ? window.event : e; //explorer:dom standard
	var immagine = e.target != null ? e.target : e.srcElement;	//dom standard:explorer
	immagine.onmousedown = null;	//per disabilitare la possibilita di uccidere piu volte un nemico

	immagine.src = '../media/sprites/ufo/ufo1.png';
	var rexp = /\d+/;
	var id = parseInt(immagine.id.match(rexp));
	grafica.gioco.vetEnemy[id].dead = true;

	grafica.aggiornaPunti();	//parte logica, vedi sotto
}

function aggiornaPunti(){
	with(grafica){
		gioco.score += 100;
		gioco.killed++;
		var rexp = /\d+/;
		var num = parseInt(scoreText.nodeValue.match(rexp)) + 100;
		scoreText.nodeValue = 'SCORE: ' + num;
		num = parseInt(killsText.nodeValue.match(rexp)) + 1;
		killsText.nodeValue = 'KILLS: ' + num;
	}
}

function fall(){	//funzione chiamata periodicamente per renderizzare l'animazione dei nemici colpiti
	with(grafica){
		for(var i = 0; i < gioco.vetEnemy.length; i++){
			if(gioco.vetEnemy[i].dead && !gioco.vetEnemy[i].scomparso){	
				if(gioco.vetEnemy[i].contaDead < gioco.vetEnemy[i].numDead - 1)	{
					gioco.vetEnemy[i].img.src = '../media/sprites/ufo/ufo' + (gioco.vetEnemy[i].contaDead++) + '.png';
				}
				else{
					gioco.vetEnemy[i].scomparso = true;
					gioco.vetEnemy[i].img.style.visibility = 'hidden';
				}
			}
		}
	}
}

function cambiaLivello(){ //resets, inizializzazioni da fare quando si cambia un livello
	with(grafica){
		clearInterval(timer);
		clearInterval(tempodead);
		if(raggiuntaSoglia()){	//se sono stati annientati almeno il 70% dei nemici nel livello vai al successivo, else gameover
			divGioco.setAttribute('style',"background:url('"+ this.bground[gioco.level + 1] +"')");

			killsText.nodeValue = 'KILLS: 0';
			for(var i = 0; i < gioco.numEnemy; i++){	//RIMOZIONE IMG NEMICI, uso lastChild per non eliminare i text nodes (primi 3 figli)
					divGioco.removeChild(divGioco.lastChild);
			}
			contaEnemyInMov = 0;
			gioco.nextLevel();
			
			if(gioco.level != 8){
				levelText.nodeValue = 'LEVEL: ' + gioco.level;
 				for (var i=0; i< gioco.numEnemy; i++){		//inserisci nello sfondo di gioco i nemici
				 		 divGioco.appendChild(gioco.vetEnemy[i].imgDiv);
					 }
				avvia();	//si riparte
			}
			else{
				levelText.nodeValue = '';
			}
		}
		else{
			gameover();
		}

	}
}

function raggiuntaSoglia(){
	var soglia = (grafica.gioco.vetNumEnemy[grafica.gioco.level - 1] * 70) / 100;	//70%
	if(grafica.gioco.killed >= soglia){	//soglia minima raggiunta
		return true;
	}
	else return false;
}

function gameover(){	
	with(grafica){
		levelText.nodeValue = '';
		killsText.nodeValue = '';
		divGioco.setAttribute('style',"background:url('"+ bground[gioco.numMaxLevel - 1] +"')");
		ajaxHandler();	//se score supera il record attuale viene aggiornato il campo relativo nel DB
	}
}


//AJAX
function ajaxHandler(){
	var xmlHttp;
	try{	
		xmlHttp = new XMLHttpRequest();
	}
	catch(e){
		try{
			xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
		}
		catch(e){
			try{	
				xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
			}
			catch(e){
				window.alert('Il tuo browser non supporta AJAX');
				return;
			}
		}
	}


var textResp = document.createTextNode('');
grafica.divGioco.appendChild(textResp);

	xmlHttp.onreadystatechange = mostraVideo;  
	function mostraVideo() { 
     if (xmlHttp.readyState == 4) {  //operazione completata
     	if (xmlHttp.status == 200) {  //HTTP response corretta
     	textResp.nodeValue = xmlHttp.responseText;
      	return;
      	} 
     else {  
        window.alert('Errore di comunicazione con il server.');
        return;
      	}  
      }  
  	}  

  	var data = 'score=' + grafica.gioco.score;
		xmlHttp.open('POST','updatescore.php',true);
		xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xmlHttp.send(data);	

}