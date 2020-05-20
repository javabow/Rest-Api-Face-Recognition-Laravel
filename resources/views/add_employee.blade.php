<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Tambah Artikel Guide</title>
        <!-- <link rel="stylesheet" type="text/css" href="https://www.javabow.com/plugin/simditor/site/assets/styles/simditor.css" />

        <script type="text/javascript" src="https://www.javabow.com/plugin/simditor/site/assets/scripts/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.javabow.com/plugin/simditor/site/assets/scripts/module.js"></script>
        <script type="text/javascript" src="https://www.javabow.com/plugin/simditor/site/assets/scripts/hotkeys.js"></script>
        <script type="text/javascript" src="https://www.javabow.com/plugin/simditor/site/assets/scripts/uploader.js"></script>
        <script type="text/javascript" src="https://www.javabow.com/plugin/simditor/site/assets/scripts/simditor.js"></script> -->

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.1.39/jodit.min.js"></script>

    </head>
    <body>

        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    Add Artikel Guide
                </div>
                <div class="card-body">
                    <a href="/elo" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                    <form method="post" action="/elo/input" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" placeholder="Judul Artikel">

                            @if($errors->has('judul'))
                                <div class="text-danger">
                                    {{ $errors->first('judul')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <b>Gambar Thumbnail</b><br/>
                            <input type="file" name="gambar">
                        </div>

                        <div class="form-group">
                            <label>Isi</label>
                            <textarea id="isiArtikel" name="isi" class="form-control" placeholder="Isi Artikel">
                                
                            </textarea>

                            <script>var editor = new Jodit('#isiArtikel', {
                                "enter": "BR",
                                height: 400,
                                "disablePlugins": "addnewline"
                            });
                            </script>
                            <!-- <script type="text/javascript">
                                var editor = new Simditor({
                                    textarea: $('#isiArtikel')
        
                                });
                            </script> -->

                             @if($errors->has('isi'))
                                <div class="text-danger">
                                    {{ $errors->first('isi')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" placeholder="Type">

                            @if($errors->has('type'))
                                <div class="text-danger">
                                    {{ $errors->first('type')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </body>
</html>