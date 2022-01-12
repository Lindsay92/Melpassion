// jQuery(function(){
//     $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200 ) { 
                $('#scrollUp').css('right','10px');
            } else { 
                $('#scrollUp').removeAttr( 'style' );
            }
        });
//     });
// });


// $('.imageEffect').on('mouseover', function(){
//     $('.imageEffect').css('box-shadow','0px 0px 8px 2px #000000');
// });

// magesGalerie.forEach(img =>{
//     img.addEventListener("click", function(){
//         //on retrouve le numéro que porte l'image dans la liste représentée par la 
//         for(var i=0; i<imagesGalerie.length; i++){
//             console.log("Pour i=",i, "image html=", imagesGalerie[i]);
            