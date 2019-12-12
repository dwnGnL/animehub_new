let searchForm = document.querySelector('.search-block');
let search = document.querySelector('.search');

search.onfocus = () => {
  searchForm.classList.add('search-focus');
  if (document.body.clientWidth < 767) document.body.style.overflow = 'hidden';
  setTimeout(() => searchForm.classList.add('full-height'), 300);
};

search.onblur = () => {
  setTimeout(() => {
    if (search.value == '') {
      searchForm.classList.remove('full-height');
      setTimeout(() => {
        searchForm.classList.remove('search-focus');
        document.body.style.overflow = 'auto';
      }, 1000);
    };
  }, 500);
};

searchPosition();

function searchPosition() {
  if (window.location.href == document.body.dataset.domen) {
    if (document.body.clientWidth > 580  && document.body.clientWidth < 767) searchForm.style.top = '42vw';
    if (document.body.clientWidth < 580  && document.body.clientWidth > 431) searchForm.style.top = '45vw';
    if (document.body.clientWidth < 430) searchForm.style.top = '48vw';
  };
};

$(".search-block .search").on("input",(e)=>{
  var text=$(".search-block .search").val()
  if (text.length>2) {
    $(".search-block .loader").css("display","block")
    $.ajax({
      type: "post",
      url: "/ajax/search/ajax",
      data: ({"title":text,"token":$("#token").text()}),
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
          }
          $(".ajax-search").html(ajaxContent)
          $(".search-block .loader").css("display", "none")
          $(".search-block .cross").css("display", "block")
          $(".ajax-search").css("display", "grid")
        } else {
          $('.ajax-block').remove();
        }
      }
    })
  } else {
    $(".ajax-search").css("display","none")
    $(".search-block .loader").css("display","none")
    $(".search-block .cross").css("display","none")
  }

})

$(".search-block .cross").click(()=>{
  $(".ajax-search").css("display","none")
  $(".search-block .cross").css("display","none")
})