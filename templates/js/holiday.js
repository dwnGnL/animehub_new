let day = new Date();

if ((day.getDate() >= 15 && day.getMonth() == 11) || (day.getMonth() == 0)) {
  document.body.classList.add('new-year');
  if (document.body.clientWidth >= 992) document.body.classList.add('new-year-background');
};
