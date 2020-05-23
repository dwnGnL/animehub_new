@extends('voyager::master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/plagin/chosen.min.css')}}">
    <div class="container">
        <h1 class="page-title">Добавление Мерчанта</h1>
        <form action="{{route('voyager.merchant.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="name" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="slug">Псевдоним</label>
                <input type="text" name="slug" id="slug" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cat">Категория</label>
                <select name="cat" id="cat" class="form-control">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="term">Срок рассрочки</label>
                <input type="text" name="term" id="term" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="file" accept="image/*" name="image" required>
            </div>
            <div class="form-group">
                <label for="">Платеж</label>
                <select multiple class="form-control">
                    @foreach($payments as $payment)
                    <option>{{$payment->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="text" name="payments" hidden id="platez">
            <div id="address">
                <div class="form-group address">
                    <label for="adres">Адрес 1</label>
                    <input type="text" name="address1" id="adres" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="time-work">Время работы 1</label>
                    <input type="text" name="time_work1" id="time-work" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="coor">Координаты 1</label>
                    <input type="text" name="coor1" id="coor" class="form-control" placeholder="192323б,900232" required>
                </div>
            </div>
            <button class="btn btn-primary" type="button" id="addAddress">+</button>
            <div class="form-group text-center">
                <input type="button" class="btn btn-success" value="Сохранить" id="go">
            </div>

        </form>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="{{asset('js/plagin/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('js/main/merchant.js')}}"></script>
    <script>
        $('select').chosen();
    </script>
@endsection
