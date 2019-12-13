/*
Редактор стилей каскад аз 1.
Автор проекта: Алексей Конан 2011 г. (www.akonan.ru).
Разрешено свободное использование приложения и его модификаций в некомерческих целях.
*/
function css(){
    img='img/css/';
    css='';
    document.write('<div class="css"><div class="css_control">');
    css_control(img);
    document.write('</div><div class="css_panel"><textarea hidden id="css_area"></textarea><p id="css_text" hidden>This is my nickname</p></div>');
    }
    function css_control(img){
    arr=Array(
    Array("Шрифт: ","font-family","Times;Arial;Courier;Cute Font;Squada One;Verdana;Georgia;algerian;amaze;Open Sans Condensed;Anton;Source Code Pro;Lobster;Dancing Script;Pacifico;Yanone Kaffeesatz;Shadows Into Light;Ruge Boogie;Amatic SC;arial;Barriecito;Caveat;arial black;calibri;cambria;candara","select"),
    // Array("Размер: ","font-size","8px;9px;10px;11px;12px;13px;14px;15px;16px;17px;18px;19px;20px;21px;22px;23px;24px;25px;26px;27px;28px;29px;30px;31px;32px;33px;34px;35px;36px;37px;38px;39px;40px","select"),
    // Array("Цвет: ","color","","input"),
    // "",
    // Array("жирный","font-weight","bold;normal","button","bold.png"),
    // Array("наклонный","font-style","italic;normal","button","italic.png"),
    // Array("подчёркнутый","text-decoration","underline;none","button","underline.png"),
    // "",
    // Array("заглавные буквы","text-transform","uppercase;none","button","upper.png"),
    // Array("строчные буквы","text-transform","lowercase;none","button","lower.png"),
    // "<div class=hr></div>",
    // Array("<b>Отступы между</b> буквами: ","letter-spacing","0;1px;2px;3px;4px;5px;6px;7px;8px;9px;10px;11px;12px;13px;14px;15px;16px;17px;18px;19px;20px","select"),
    // Array("словами: ","word-spacing","0;1px;2px;3px;4px;5px;6px;7px;8px;9px;10px;11px;12px;13px;14px;15px;16px;17px;18px;19px;20px","select"),
    // Array("строками: ","line-height","normal;8px;9px;10px;11px;12px;13px;14px;15px;16px;17px;18px;19px;20px;21px;22px;23px;24px;25px;26px;27px;28px;29px;30px;31px;32px;33px;34px;35px;36px;37px;38px;39px;40px","select")
    );
      for(i=0;i<arr.length;i++){
      if(arr[i][3]=="button")document.write('<button onclick="css_action(\''+arr[i][1]+'\', \''+arr[i][2]+'\')" type="button" style="width:24px;background-image:url('+img+arr[i][4]+')"></button>');
      else if(arr[i][3]=="input")document.write(arr[i][0]+' <input name="n1" type="text" onChange="css_action(\''+arr[i][1]+'\',\''+arr[i][2]+'\'+this.value)" onKeyup="css_action(\''+arr[i][1]+'\',\''+arr[i][2]+'\'+this.value)">');
      else if(arr[i][3]=="select"){
        oar=arr[i][2].split(";");
        opt="";
          for(j=0;j<oar.length;j++){
          opt+='<option value="'+oar[j]+'">'+oar[j]+'</option>';
          }
        document.write(arr[i][0]+'<select name="font" onchange="css_action(\''+arr[i][1]+'\',this.value)">'+opt+'</select>');
      }
      else document.write('<span class="css_sepor"></span>'+arr[i]);
      }
    }
    function css_action(p,v){
    v=v.split(";");
    a=document.getElementById("css_area");
    val=a.value.indexOf(p+":"+v[0]+";")==-1||v[1]==undefined?v[0]:v[1];
    reg=new RegExp(p+":[^;]*;", "gi");
    if(a.value.indexOf(p)==-1)a.value+=p+":"+val+";\r\n";
    else a.value=a.value.replace(reg,p+":"+val+";");
    css_ready();
    }
    function css_ready(){
      function css_upper(m){
      return m.toUpperCase().replace("-","");
      }
    v=document.getElementById("css_area").value;
    v=v.split(";");
      for(i=0;i<v.length;i++){
      v[i]=trim(v[i]);
      if(v[i]!=''){
      p=v[i].split(":");
      p[0]=p[0].replace(/-\w/g,css_upper);
          try{document.getElementById("css_text").style[p[0]]=trim(p[1]);
              document.querySelector("h3.login").style[p[0]]=trim(p[1]);
          }
        catch(c){continue;} 
        finally{}
      }
      }
    }
    function css_bgcolor(v){
    try{document.getElementById("css_text").style.backgroundColor=v;}
    catch(c){return false;} 
    finally{}
    }
    function css_text(){
    b=document.getElementById("css_text");
    txt=b.innerHTML;
    b.innerHTML='<textarea id="css_value" class="css_area">'+txt.replace(/<BR>/i,"\n")+'</textarea> <button onclick="css_txt()">готово</button>';
    document.getElementById("css_txt").disabled=1;
    }
    function css_txt(){
    document.getElementById("css_text").innerHTML=document.getElementById("css_value").value.replace("\n","<BR>");
    document.getElementById("css_txt").disabled=0;
    }
    function trim(s){
    return s.replace( /^\s+/g,'');
    }
    