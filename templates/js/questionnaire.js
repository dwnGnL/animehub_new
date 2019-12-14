let questionnairePanelItem = document.querySelectorAll('.questionnaire-panel-item');
let questionnaireLength = document.querySelectorAll('.questionnaire-length');
let questionnairePanelItemShadow = document.querySelectorAll('.questionnaire-panel-item-shadow');
let questionnairePanel = document.querySelector('.questionnaire-panel');
let questionnaireGeneralChoose = document.querySelector('.questionnaire-general-choose');
let sumQuestionnaire = 0;

for (var i = 0; i < questionnaireLength.length; i++) {
  sumQuestionnaire += +questionnaireLength[i].dataset.length;
};

if (questionnairePanel.classList.contains('questionnaire-done')) {
  for (var i = 0; i < questionnairePanelItemShadow.length; i++) {
    questionnairePanelItemShadow[i].style.width = questionnaireLength[i].dataset.length / (sumQuestionnaire / 100) + '%';
    questionnaireLength[i].innerHTML = questionnaireLength[i].dataset.length + ' человек';
  };
};

questionnaireGeneralChoose.innerHTML = `Проголосовало ${sumQuestionnaire} человек`;

questionnairePanelItem.forEach((elem, index) => {
  elem.onclick = () => {
    if (questionnairePanel.classList.contains('questionnaire-done')) return;

    questionnairePanel.classList.add('questionnaire-done');
    questionnairePanelItem[index].classList.add('questionnaire-choose');

    for (var i = 0; i < questionnairePanelItemShadow.length; i++) {
      questionnairePanelItemShadow[i].style.width = questionnaireLength[i].dataset.length / (sumQuestionnaire / 100) + '%';
      questionnaireLength[i].innerHTML = questionnaireLength[i].dataset.length + ' человек';
    };
  };
});
