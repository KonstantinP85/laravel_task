<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>One news</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    <div class="row no-gutters mt-3">
        <div class="col-3">
            <a class = "btn btn-primary" href="{{ url('news') }}">
                Вернуться к списку новостей
            </a>
        </div>
    </div>
    <div class="row no-gutters mt-3">
        <div class="col-3">
            {{ $news->image }}
        </div>
        <div class="col-3">
            <div>
                {{ $news->title }}
            </div>
            <div>
                {{ $news->description }}
            </div>
        </div>
    </div>
    <div class="row no-gutters mt-3">
        {{ $news->content }}
    </div>
</div>
<div class="container-fluid">
    <div>
        <h4>Подобные новости</h4>
    </div>
    <div class="col-4">
        <ul>
            @foreach ($similarNews as $oneSimilarNews)
                <li>
                    <a href="{{ url('news/' . $oneSimilarNews->id) }}">
                        {{ $oneSimilarNews->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
</body>
</html>
