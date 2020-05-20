<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Dashboard Guide</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    Dashboard Guide Javabow
                    <br/>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <a href="/elo/add" class="btn btn-primary">Artikel Baru +</a>
                    <br/>
                    <br/>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($elo as $p)
                            <tr>
                                <td>{{ $p->judul }}</td>
                                <td>{{ $p->type }}</td>
                                <td>{{ $p->date }}</td>
                                <td>
                                    <a href="/elo/edit/{{ $p->id }}" class="btn btn-warning">Edit</a>
                                    <a href="/elo/delete/{{ $p->id }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $elo->links() }}
                </div>
            </div>
        </div>
    </body>
</html>