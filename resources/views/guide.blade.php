<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Javabow</title>
    </head>
    <body>
        <div class="container">
            <div class="row">

            @foreach ($guide as $content)
            <div class="col-xs-12 col-md-3">
                <div class="card h-100">
                    <a href="#"><img src="https://www.javabow.com/img/{{ $content['image'] }}" class="card-img-top" width="100%" style="height: 200px;"></a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="#">{{ $content['judul'] }}</a></h3>
                        <p>{{ $content['date'] }}</p>
                        <p>Summary</p>
                    </div>
                    <div class="card-footer">
                        <a href="guide/{{ $content['url'] }}" class="btn btn-sm btn-secondary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </body>
</html>