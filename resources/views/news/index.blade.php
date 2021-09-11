<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Main</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    <div class="row no-gutters mt-3">
        <div class="col-3">
            <a class = "btn btn-primary" href="{{ url('news') }}">
                К списку всех новостей
            </a>
        </div>
    </div>
    <div class="row no-gutters mt-3">
        <div class="col-8">
            <h3>Актуальные новости</h3>
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                <tr>
                    <th>Дата/время</th>
                    <th>Название</th>
                    <th>Описание</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($favoriteNews as $oneFavoriteNews)
                    <tr>
                        <td>{{ $oneFavoriteNews->created_at }}</td>
                        <td>
                            <a href="{{ url('news/' . $oneFavoriteNews->id) }}">
                                {{ $oneFavoriteNews->title }}
                            </a>
                        </td>
                        <td>{{ $oneFavoriteNews->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if(count($favoriteClientNews)>0)
        <div class="col-8">
            <h3>Избранные новости</h3>
            <table class="table table-hover table-sm">
                <thead class="thead-light">
                <tr>
                    <th>Дата/время</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Удалить из избранного</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($favoriteClientNews as $oneFavoriteClientNews)
                    <tr>
                        <td>{{ $oneFavoriteClientNews->created_at }}</td>
                        <td>
                            <a href="{{ url('news/' . $oneFavoriteClientNews->id) }}">
                                {{ $oneFavoriteClientNews->title }}
                            </a>
                        </td>
                        <td>{{ $oneFavoriteClientNews->description }}</td>
                        <td>
                            <form action="delFavorite" method="GET">
                                <input name="favoriteNewsId" type="hidden" value={{ $oneFavoriteClientNews->id }}>
                                <button type="submit" class="btn btn-success btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <h5>Избранных новостей нет</h5>
            <a href="{{ url('news') }}">
                Выбрать
            </a>
        @endif
    </div>
</div>
</body>
</html>
