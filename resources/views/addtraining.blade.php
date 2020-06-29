@include('template.header')
            <div class="card mt-5">
                <div class="card-header text-center">
                    Add Data Training Mahasiswa
                </div>
                <div class="card-body">
                    <a href="/training" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    
                    <form method="post" action="/training/input" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label><b>NIM</b></label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="nim" class="form-control" placeholder="NIM Mahasiswa">

                            @if($errors->has('nim'))
                                <div class="text-danger">
                                    {{ $errors->first('nim')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label><b>Nama</b></label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa">

                            @if($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama')}}
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <b>Gambar Thumbnail</b><br/>
                            <input type="file" name="gambar">
                            <img src="" id="img" class="img" height="300px" width="300px">
                            <script>
                                $(':input[type=file]').change( function(event) {
                                    var tmppath = URL.createObjectURL(event.target.files[0]);
                                    $(this).next("img").attr('src',tmppath);
                                });
                            </script>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>

                    </form>

                </div>
            </div>
@include('template.footer')