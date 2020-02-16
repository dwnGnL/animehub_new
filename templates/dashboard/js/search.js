
let search = document.querySelector('.search');
let backSearch = document.querySelector('.back-search');
let ajaxSearch = document.querySelector('.ajax-search');

search.onfocus = () => {
    search.classList.add('search-focus');
    if (document.body.clientWidth < 767) {
        window.scrollTo(0, 0);
        document.body.style.overflow = 'hidden';
    };
    setTimeout(() => search.classList.add('full-height'), 300);
};

backSearch.onclick = () => {
    search.value = '';
    ajaxSearch.innerHTML = '';
};

search.onblur = () => {
    setTimeout(() => {
        if (search.value == '') {
            search.classList.remove('full-height');
            setTimeout(() => {
                search.classList.remove('search-focus');
                document.body.style.overflow = 'auto';
            }, 300);
        };
    }, 300);
};

if (window.location.href == document.body.dataset.domen) document.body.classList.add('main-page');

$(".search").on("input",(e) => {
    var text=$(".search").val()
    if (text.length > 2) {
        $(".loader").css("display","block")
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
                        ajaxContent += `<div class="ajax-block row">
           
                <div class="search-name col-md-6" style="height: 70px" title="${response[i].onlyTitle}">${response[i].onlyTitle} </div>
                <div class="search-name col-md-6" style="height: 70px" title="${response[i].onlyTitle}" tv="${response[i].onlyTv}">${response[i].title}</div>
             
            </div>
            `
                    };
                    $(".ajax-search").html(ajaxContent);
                    $(".loader").css("display", "none");
                    $(".cross").css("display", "block");
                    $(".ajax-search").css("display", "grid");
                    ajaxSelect();
                } else {
                    $('.ajax-block').remove();
                };
            }
        });
    } else {
        $(".ajax-search").css("display","none");
        $(".loader").css("display","none");
        $(".cross").css("display","none");
    };
});

$(".cross").click(() => {
    $(".ajax-search").css("display","none");
    $(".cross").css("display","none");
});

function ajaxSelect(){
    $('.search-name').click(function () {
        if ($(this).attr('tv')){
            $('.tv').val($(this).attr('tv'))
        }
        var title =  $(this).attr('title');

        $('#titleForSave').val(title);
        $(".ajax-search").css("display","none");
        $(".loader").css("display","none");
        $(".cross").css("display","none");
    });
}
