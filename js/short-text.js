let name = document.querySelectorAll('.update-name');

for (var i = 0; i < name.length; i++) {
  if (name[i].innerHTML.length >= 13) {
    name[i].innerHTML = name[i].innerHTML.substr(0, 13) + '...';
  };
};
