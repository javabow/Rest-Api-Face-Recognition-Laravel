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

                        <input type="hidden" name="id_admin" value="{{ Auth::id() }}">

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
                            <b>Gambar Thumbnail <span style="color: red;font-weight: bold;">.jpg ONLY !!</span></b><br/>
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
                            <input type="submit" class="btn btn-success" value="Simpan" data-toggle="modal" data-target="#spinnerModal" data-backdrop="static" data-keyboard="false">
                        </div>

                    </form>
                    <div class="modal" tabindex="-1" role="dialog" id="spinnerModal">
                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                            <span class="fa fa-spinner fa-spin fa-3x w-100" style="color: white;"></span>
                        </div>
                    </div>
                </div>
            </div>
@include('template.footer')
