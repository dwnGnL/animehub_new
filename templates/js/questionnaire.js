let questionnairePanelItem = document.querySelectorAll('.questionnaire-panel-item');
let questionnaireLength = document.querySelectorAll('.questionnaire-length');
let questionnairePanelItemShadow = document.querySelectorAll('.questionnaire-panel-item-shadow');
let questionnairePanel = document.querySelector('.questionnaire-panel');
let questionnaireGeneralChoose = document.querySelector('.questionnaire-general-choose');
let sumQuestionnaire = 0;


function countVote(){
  sumQuestionnaire = 0;
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
};

questionnairePanelItem.forEach((elem, index) => {
  elem.onclick = () => {
    if (questionnairePanel.classList.contains('questionnaire-done')) return;
    $.ajax({
      type: "POST",
      url: "/ajax/add/vote",
      data: {"id_answer":questionnairePanelItem[index].querySelector('.questionnaire-item').id,"id_quest":$(".question").attr("id"),"token":$("#token").text()},
      dataType: "text",
      success: function (response) {
        response=JSON.parse(response);

        if (response.status=="500") {
          showMessage("Error",'Вы уже голосовали',error)
          return
        } else if (response.status=="401"){
          showMessage("Error",'Требуется авторизация',error)
          return
        } else {
          var n = questionnairePanelItem[index].querySelector('.questionnaire-length').getAttribute("data-length");
          questionnairePanelItem[index].querySelector('.questionnaire-length').setAttribute("data-length",++n);

          questionnairePanel.classList.add('questionnaire-done');
          questionnairePanelItem[index].classList.add('questionnaire-choose');
          for (var i = 0; i < questionnairePanelItemShadow.length; i++) {
            questionnairePanelItemShadow[i].style.width = questionnaireLength[i].dataset.length / (sumQuestionnaire / 100) + '%';
            questionnaireLength[i].innerHTML = questionnaireLength[i].dataset.length + ' человек';
          };
          countVote();
          console.log("Все хорошо");
        };
      }
    });
  };
});

countVote();
