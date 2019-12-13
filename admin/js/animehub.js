var signin = document.getElementById('SIGNIN');
var shadow = document.getElementById('shadow');
var exit = document.querySelector('.exit2');
var hidden = document.getElementById('hidden');
var series_up = document.querySelector('.series_up');
var series_down = document.querySelector('.series_down');
var liked=document.getElementById('like'); 
var disliked=document.getElementById('dislike');
var redact=document.getElementById('profil_redact');
var check_like=0;
var check_dislike=0;



      
    
// window.onload=function(){
    if(redact){
      redact.addEventListener('click',show_redact);
    }

    // if(disliked){
    //   disliked.addEventListener('click',dislike);
    // }

    // if(liked){
    //   liked.addEventListener('click',like);
    // }

    if(series_up){
      series_up.addEventListener('click',upper);
    }
    
    if(series_down){
     series_down.addEventListener('click',downer);
    }
    if(signin){
      signin.addEventListener('click',show);
    }
    if(exit){
      exit.addEventListener('click',hide);
    }

  // }




function hide(){
    
    shadow.style.display='none';
    document.body.style.overflow = 'auto';
}


function show(){
   
    shadow.style.display='block';
    document.body.style.overflow = "hidden";

}

function upper(){
    var up = document.querySelector('#series div div');
    up.scrollBy(0,-50);

}

function downer(){
  var up = document.querySelector('#series div div');
  up.scrollBy(0,50);

}

// function like(){
//     if(check_like==0){
//     liked.style.background='#49aff2';
//     disliked.style.background='none';
//     check_like=1;
//     check_dislike=0;
// }else{
//   liked.style.background='none';
//   check_like=0;
// }

// }

// function dislike(){
//   if(check_dislike==0){
//   disliked.style.background='#49aff2';
//   liked.style.background='none';
//   check_like=0;
//   check_dislike=1;
// }else{
// disliked.style.background='none';
// check_dislike=0;
// }

// }



function show_redact(){
  var elems = document.querySelectorAll('#avatars div img');
for (var i = 0; i < elems.length; i++) {
	elems[i].onclick = change_avatar;
}
  var elem= document.getElementsByClassName("red_prof");
  var elem2=document.getElementsByClassName("static_prof");

 for(i = 0; i < elem.length; i++) {
   elem[i].classList.toggle("open");
 }
 

 for(i = 0; i < elem2.length; i++){
   elem2[i].classList.style.display='none';
 }
}
function change_avatar(){
  var elem = document.getElementById("avatar");
  elem.src=this.src;
}


function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {

  var dropdowns = document.getElementsByClassName("dropdown-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
    var openDropdown = dropdowns[i];
    if (openDropdown.classList.contains('show')) {
      openDropdown.classList.remove('show');
    }
  }
}
} 