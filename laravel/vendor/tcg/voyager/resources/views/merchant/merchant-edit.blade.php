@extends('voyager::master')

@section('content')
    <link rel="stylesheet" href="{{asset('css/plagin/chosen.min.css')}}">
    <div class="container">
        <h1 class="page-title">Добавление Мерчанта</h1>
        <form action="{{route('voyager.merchant.update', $merchant->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="name" id="title" class="form-control" value="{{$merchant->name}}" required>
            </div>
            <div class="form-group">
                <label for="slug">Псевдоним</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{$merchant->slug}}" required>
            </div>
            <div class="form-group">
                <label for="cat">Категория</label>
                <select name="cat" id="cat" class="form-control">
                    @foreach($categories as $category)
                        @if($category->id == $merchant->category->id)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="term">Срок рассрочки</label>
                <input type="text" name="term" id="term" class="form-control" value="{{$merchant->term}}" required>
            </div>
            <div class="form-group">
                <img src="{{asset($merchant->image)}}" alt="" width="100" height="100">
            </div>
            <div class="form-group">
                <input type="file" accept="image/*" name="image">
            </div>
            <div class="form-group">
                <label for="">Платеж</label>
                <select multiple id="payment" class="form-control">
                    @foreach($payments as $payment)
                    @foreach($merchant->payments as $value)
                        @if($payment->id == $value->id)
                            <option selected>{{$payment->name}}</option>
                        @else
                            <option >{{$payment->name}}</option>
                        @endif
                    @endforeach
                    @endforeach
                </select>
            </div>
            <input type="text" name="payments" hidden id="platez">
            <div id="address">
                @foreach($merchant->address as $key => $value)
                <div class="form-group address">
                    <label for="adres">Адрес {{$key + 1}}</label>
                    <input type="text" name="address{{$key + 1}}" id="adres" class="form-control" value="{{$value->address}}" required>
                </div>

                <div class="form-group">
                    <label for="time-work">Время работы {{$key + 1}}</label>
                    <input type="text" name="time_work{{$key + 1}}" id="time-work" value="{{$value->work_time}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="coor">Координаты {{$key + 1}}</label>
                    <input type="text" name="coor{{$key + 1}}" id="coor" class="form-control" value="{{$value->coordinates}}" placeholder="192323б,900232" required>
                </div>
                @endforeach
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
        $('#payment').chosen();
    </script>
@endsection

