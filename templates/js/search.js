let searchForm = document.querySelector('.search-block');
let search = document.querySelector('.search');

search.onfocus = () => {
  searchForm.classList.add('search-focus')
  document.body.style.overflow = 'hidden';
  setTimeout(function () {
    searchForm.classList.add('full-height')
  }, 300);
};

search.onblur = () => {
  setTimeout(function () {
    if (search.value == '') {
      searchForm.classList.remove('full-height')
      setTimeout(function () {
        searchForm.classList.remove('search-focus')
        document.body.style.overflow = 'auto';
      }, 1000);
    };
  }, 500);
};

if (window.location.href == 'http://animehub/') {
  searchForm.style.top = '180px';
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
