let parseAnimeName = document.querySelectorAll('.parse-anime-name');
let animeName = '';

parseAnimeName.forEach((elem, index) => {
  elem.oninput = () => {
    animeName = elem.value;
    console.log(animeName);
  };

  elem.onblur = () => {
    for (let i = 0; i < parseAnimeName.length; i++) {
      parseAnimeName[i].value = animeName;
      parseAnimeName[i].classList.add('checked');
      if (elem.value == '' || elem.value == ' ') parseAnimeName[i].classList.remove('checked');
    };
  };
});
