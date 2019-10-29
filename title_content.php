<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/title_content.css">
<script src="js/jquery-3.3.1.min.js"></script>
<div id="titleContent">
    <div class="row">
        <div class="col-sm-5">
            <div class="image">
                <img src="images/Image (8).jpg"  alt="">
            </div>
        </div>
        <div class="col-sm-7">
            <h1 class="">Ван пис</h1>
            <p>One Piece</p>
                    <div class="info">
                        <ul>
                            <li>
                                <span class="">Жанры:</span>
                                <span class="info_right">fdsfds,fdsfds,fdsfs</span>
                            </li>
                            <li>
                                <span>Год:</span>
                                <span class="info_right">2019</span>
                            </li>
                            <li>
                                <span>Эпизоды:</span>
                                <span class="info_right">13 из 24</span>
                            </li>
                            <li>
                                <span>Автор:</span>
                                <span class="info_right">nGnL</span>
                            </li>
                            <li>
                                <span>День выхода:</span>
                                <span class="info_right">Воскресение</span>
                            </li>
                        </ul>
                    </div>
                    <div class="poryadok_prosm">
                        <p>порядок просмотра</p>
                        <ol>
                            <li><a href="#">Tv-1</a></li>
                            <li><a href="#">Tv-1</a></li>
                            <li><a href="#">Tv-1</a></li>
                            <li><a href="#">Tv-1</a></li>
                            
                        </ol>
                    </div>                    
        </div>
    </div>
    <hr>
    <div class="opis">
        <h4>Описание <span>аниме </span> <span>«Пламенная бригада пожарных»</span></h4>
        <div class="divopis divopisafter slice" >
            <p class="opisslide opistext">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit, quas? Voluptate porro rem officia nihil fugit vitae quae quod quasi a, laboriosam aliquid eius libero sit temporibus natus, rerum exercitationem!
            Placeat magni laborum quis saepe ipsam. Architecto, illum reprehenderit dignissimos mollitia nam ex quis ad suscipit qui at alias impedit consequatur fugiat autem hic eligendi temporibus nostrum possimus culpa consectetur?
            Quo pariatur sint et totam maiores dolor consequuntur, distinctio dolorum facere possimus in necessitatibus reiciendis at aliquam nihil quia voluptate alias iure, saepe quidem sunt dignissimos perferendis velit? Alias, aperiam.
            Quo laudantium, doloremque voluptate. Corrupti culpa aspernatur sint illo, voluptatum repellendus vel! Vel pariatur iusto possimus animi reprehenderit quod unde. Tenetur temporibus maxime, molestias aliquid perferendis minus?
            Veritatis ad aperiam est quod perferendis eos? Tempora nam quidem consectetur autem quaerat iure odio distinctio optio consequatur, doloremque quod corporis et nemo corrupti fugiat repellendus harum nobis cum minima.
            Fugit corrupti, voluptatibus porro dicta tempora ipsam repellat rerum veniam provident, accusamus beatae quod ipsa a necessitatibus impedit. Dolore, ea aperiam. Corrupti, repudiandae. Quo voluptatibus, voluptates nostrum necessitatibus nulla libero.
            Dicta, repellat aliquid veritatis doloribus nostrum non labore ipsam fugiat beatae esse ut provident, aperiam quos ducimus saepe inventore animi voluptatem vitae harum incidunt deleniti iste totam libero. Eaque, vel.
            Esse hic perspiciatis, excepturi soluta distinctio explicabo porro harum ratione minima, reprehenderit eaque voluptates consectetur temporibus accusamus nobis iste, voluptas recusandae laborum id fugit in. Rem eum explicabo voluptatum saepe? vero facilis vel tempore doloribus?</p>
        </div>
        <div class="slice-btn">
            <span  id="alltext">Раскрыть</span>
        </div>
        <script>
            $("#alltext").click(function (){
                $(".divopis").toggleClass("divopisafter");
                if(!$(".divopis").hasClass("divopisafter")){
                    $(".divopis").css("height",(parseInt($(".opisslide").css("height"))+"px"))
                    $("#alltext").html("Закрыть")
                }else{
                    $(".divopis").css("height",200)
                    $("#alltext").html("Раскрыть")

                }
                // alert((parseInt($(".opisslide").css("height"))+80)+"px")
            })
        </script>
    </div>
</div>
