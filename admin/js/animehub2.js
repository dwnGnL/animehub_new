var signin = document.querySelector('span#SIGNIN');
var shadow = document.getElementById('shadow');
var exit = document.getElementById('exit');
var hidden = document.getElementById('hidden');
var series_up = document.querySelector('.series_up');
var series_down = document.querySelector('.series_down');
var liked=document.getElementById('like'); 
var disliked=document.getElementById('dislike');
var check_like=0;
var check_dislike=0;

disliked.addEventListener('click',dislike);
liked.addEventListener('click',like);
exit.addEventListener('click',hide);
// shadow.addEventListener('click',hide);
signin.addEventListener('click',show);
series_up.addEventListener('click',upper);
series_down.addEventListener('click',downer);

function hide(){
    
    shadow.style.display='none';
    document.body.style.overflow = 'auto';
}


function show(){
    shadow.style.display='block';
    document.body.style.overflow = "hidden";

}

function upper(){
    var up = document.querySelector('#series div');
    up.scrollBy(0,-50);

}

function downer(){
  var up = document.querySelector('#series div');
  up.scrollBy(0,50);

}

function like(){
    if(check_like==0){
    liked.style.background='#49aff2';
    disliked.style.background='none';
    check_like=1;
    check_dislike=0;
}else{
  liked.style.background='none';
  check_like=0;
}

}

function dislike(){
  if(check_dislike==0){
  disliked.style.background='#49aff2';
  liked.style.background='none';
  check_like=0;
  check_dislike=1;
}else{
disliked.style.background='none';
check_dislike=0;
}

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