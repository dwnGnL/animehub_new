
<link rel="stylesheet" href="<?=$uri?>templates/css/bootstrap.min.css">
    <style>
        .opros{
            width: 400px;
            margin: auto;
        }
        .form-control{
            width: 80%;
            margin: 10px auto;
        }
        .question.form-control{
            width: 100%;
            margin: 10px auto;
        }
    </style>
<form name="QA" method="post" action="<?=$app->urlFor('addQA')?>">
<div class="opros col-xl-12">
    <label>Вопрос</label>
    <input type="text" class="question form-control" name="q">
    <hr>
    <label >Ответы</label>
    <input type="text" hidden name="token" value="<?=$helper::generateToken()?>">
    <input type="text" class="form-control" name="a1">
    <input type="text" class="form-control" name="a2">
    <input type="text" class="form-control" name="a3">
    <input type="text" class="form-control" name="a4">
    <input name="saveQA" type="submit" value="Сохранить" class="btn btn-primary">

</div>

</form>