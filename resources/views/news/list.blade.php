<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutters mt-3">
            <div class="col-3">
                <form action="news" method="GET">
                    <select name ="cityId" class="form-control">
                        <option value="">Изменить город</option>
                        @foreach ($cities as $city)
                        <option value={{ $city->id }} >{{ $city->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success btn-sm mt-3">Сохранить</button>
                </form>
            </div>
        </div>
        <div class="row no-gutters mt-3">
            <div class="col-3">
                <form action="news" method="GET">
                    <input type="text" name="search" class="form-control">
                    <button type="submit" class="btn btn-success btn-sm mt-3">Найти</button>
                </form>
            </div>
        </div>
        <div class="row no-gutters mt-3">
            <div class="col-3">
                <a class = "btn btn-danger btn-sm" href="{{ url('/') }}">
                    На главную
                </a>
                <a class = "btn btn-danger btn-sm ml-3" href="{{ url('/news') }}">
                    Сбросить фильтры
                </a>
            </div>
        </div>
        </br>
        <div class="row no-gutters mt-3">
            <div class="col-8">
                @if(is_null($selectCity))
                    <h4>Все новости</h4>
                @else
                    <h4>Новости {{ $selectCity->name }}</h4>
                @endif
                <table class="table table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>Дата/время</th>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Добавить в избранное</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($news as $oneNews)
                        <tr>
                            <td>{{ $oneNews->created_at }}</td>
                            <td>
                                <a href="{{ url('news/' . $oneNews->id) }}">
                                    {{ $oneNews->title }}
                                </a>
                            </td>
                            <td>{{ $oneNews->description }}</td>
                            <td>
                                @if(!array_key_exists($oneNews->id, $favoriteClientNewsIdArray))
                                <form action="addFavorite" method="GET">
                                    <input name="favoriteNewsId" type="hidden" value={{ $oneNews->id }}>
                                    <button type="submit" class="btn btn-success btn-sm">Добавить</button>
                                </form>
                                @else
                                    Уже добавлена!
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
