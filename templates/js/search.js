let searchForm = document.querySelector('.search-block');
let search = document.querySelector('.search');
let backSearch = document.querySelector('.back-search');
let ajaxSearch = document.querySelector('.ajax-search');

search.onfocus = () => {
  searchForm.classList.add('search-focus');
  if (document.body.clientWidth < 767) {
    window.scrollTo(0, 0);
    document.body.style.overflow = 'hidden';
  };
  setTimeout(() => searchForm.classList.add('full-height'), 300);
};

backSearch.onclick = () => {
  search.value = '';
  ajaxSearch.innerHTML = '';
};

search.onblur = () => {
  setTimeout(() => {
    if (search.value == '') {
      searchForm.classList.remove('full-height');
      setTimeout(() => {
        searchForm.classList.remove('search-focus');
        document.body.style.overflow = 'auto';
      }, 300);
    };
  }, 300);
};

if (window.location.href == document.body.dataset.domen) document.body.classList.add('main-page');

$(".search-block .search").on("input",(e) => {
  var text=$(".search-block .search").val()
  if (text.length > 2) {
    $(".search-block .loader").css("display","block")
    $.ajax({
      type: "post",
      url: "/ajax/search/ajax",
      data: ({"title":text,"token":$("#token").text(), "type":$('#type').val()}),
      dataType: "text",
      success: function (response) {
        response = JSON.parse(response);
        console.log(response[0].title);
        let ajaxContent = "";
        if (response[0].count != 0) {
          for (var i = 0; i < response.length; i++) {
            ajaxContent += `<div class="ajax-block">
              <a href="${response[i].src}">
                <div class="search-name">${response[i].title}</div>
                <div class="search-img"><img src="${response[i].img}"></div>
              </a>
            </div>
            `
          };
          $(".ajax-search").html(ajaxContent);
          $(".search-block .loader").css("display", "none");
          $(".search-block .cross").css("display", "block");
          $(".ajax-search").css("display", "grid");
        } else {
          $('.ajax-block').remove();
        };
      }
    });
  } else {
    $(".ajax-search").css("display","none");
    $(".search-block .loader").css("display","none");
    $(".search-block .cross").css("display","none");
  };
});

$(".search-block .cross").click(() => {
  $(".ajax-search").css("display","none");
  $(".search-block .cross").css("display","none");
});
