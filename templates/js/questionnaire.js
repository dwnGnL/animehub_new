let questionnairePanelItem = document.querySelectorAll('.questionnaire-panel-item');
let questionnaireLength = document.querySelectorAll('.questionnaire-length');
let questionnairePanelItemShadow = document.querySelectorAll('.questionnaire-panel-item-shadow');


questionnairePanelItem.forEach((elem, index) => {
  elem.onclick = () => {
    let sumQuestionnaire = 0;
    let onePersent = 0;
    for (var i = 0; i < questionnaireLength.length; i++) {
      sumQuestionnaire += +questionnaireLength[i].innerHTML;
    };

    onePersent = sumQuestionnaire / 100;

    for (var i = 0; i < questionnairePanelItemShadow.length; i++) {
      questionnairePanelItemShadow[i].style.width = (questionnaireLength[i].innerHTML / onePersent) + '%';
    };
  };
});
