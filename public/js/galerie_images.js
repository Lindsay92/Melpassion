//========== gestion des titres photos

var titres = document.querySelectorAll(".titre");
    
    for (var i=0; i<titres.length; i++)
        {
        titres.forEach(titre => {
            titre.style.color = "black";
            titre.style.fontFamily = "Ephesis";
            // titre.style.fontWeight = "bold";
            titre.style.fontSize = "30px";
        });
        }

//========== gestion du curseur sur les images

var images = document.querySelectorAll(".photos");
    for (var l=0; l<images.length; l++)
        {
        images.forEach(image=> {
            image.style.cursor = "pointer";
        });
        }


//========== gestion des petites images pour les avoirs en grandes


let galImages = document.querySelectorAll('#singleGallery img');
//  console.log(galImages); //apparition d'une nodeList (8)  pour 8 et donc images lenght = 8

for (let i=0; i < galImages.length; i++){
    let image = galImages[i];
    image.addEventListener('click', showSinglePict, false); //event ebling
    // image.addEventListener('click', () => {alert("bye")}, false);
}

// console.log('galImages');
function showSinglePict(e){ //gestionnaire d'evt est showSinglePict, donc je donne un nom à cet evt ds la fonction donc "e"
    // alert('bonjour');
    console.log(e);//au click de l'image = evt click qui apparait ds la console où on y trouve pleins de propriété
    //la propriété target est un objet, objet qui a généré cet evt ctd sur l'image sur laquelle j'ai cliqué
    let image = e.target; //ctd à l'image sur laquelle j'ai cliqué pour executer cette function showSinglePict
    //let : déclare des variables dt la portée est spécifique au bloc de code ds laquelle on déclare la variable
    //là visible que dans la boucle for et l'autre que ds la boucle gallerie
    let imageContainer = document.getElementById('voile');
    let bigImage = imageContainer.querySelector("img"); //recherhe img dans l'élément div avec id "voile"
    bigImage.src = image.src; //1er src est vide on donne la mm src à l'image agrandie que la petite image qui est au niveau de la galerie
    imageContainer.classList.toggle('visible');//methode Toogle : allumer si c'est éteint ou éteindre si c'est allumé
    //si la classe visible est présente sur l'evt on la retire et si la classe visible est pas pst sur l'evt alors on la met
    //visible n'est pas pst sur l'élément voile côté html donc je l'ajoute avec la méthode toggle
    imageContainer.addEventListener('click', closeSinglePict, false);
    console.log(imageContainer);
}

function closeSinglePict(){
    let imageContainer = document.getElementById('voile'); //récupère imageContainer
    imageContainer.classList.toggle('visible'); //cette methode toggle va retirer la classe visible
}



