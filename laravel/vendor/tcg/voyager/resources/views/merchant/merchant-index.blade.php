@extends('voyager::master')

@section('content')

    <div class="container">
        <h1 class="page-title">Мерчанты</h1>
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="row" style="margin-bottom: 10px">
                   <div class="col-md-6">
                       <a href="{{route('voyager.merchant.create')}}" class="btn btn-success btn-add-new">
                           <i class="voyager-plus"></i>Добавить
                       </a>
                   </div>
                    <div class="col-md-6 text-right">
                        <label>Поиск<input type="search" class="form-control input-sm"></label>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Картинка</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($merchants as $merchant)
                    <tr id="{{$merchant->id}}">
                        <td><img src="{{asset($merchant->image)}}" style="height: 50px; width: 50px" alt="{{$merchant->name}}"></td>
                        <td>{{$merchant->name}}</td>
                        <td>{{$merchant->category->name}}</td>
                        <td>
                            <button class="btn btn-sm btn-danger pull-right delete" route="{{route('voyager.merchant.destroy', $merchant->id)}}" method="DELETE"  data-toggle="modal" data-target="#MyModal" ><i class="voyager-trash"></i></button>
                            <a href="{{route('voyager.merchant.edit', $merchant->id)}}" class="btn btn-sm btn-primary pull-right edit"><i class="voyager-edit"></i></a>
                            <a href="" class="btn btn-sm btn-warning pull-right view"><i class="voyager-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    {{$merchants->render()}}
                </div>

            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Удаление</h4>
                </div>
                <div class="modal-body">
                    <h3>Вы точно хотите удалить?</h3>
                </div>
                <div class="modal-footer">
                    <button method="" route="" class="btn btn-secondary" id="btnRemove" data-dismiss="modal">Да</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Модальное окно -->
    <script src="{{asset('insof/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/main/merchant.js')}}"></script>
@endsection
