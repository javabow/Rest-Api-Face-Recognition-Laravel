@include('template.header')
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Tables Data Training</h1>
          <p class="mb-4">Data training yang sudah di input akan masuk ke dalam file dataset-faces.dat dan masuk ke dalam list ini.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List Data Training Encoded Faces</h6>
              <a href="/training/add" class="btn btn-primary float-right">Tambah Training +</a>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No. Index</th>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mahasiswa as $datamhs)
                      <tr style="text-align: center;">
                        <td>{{ $datamhs['id'] }}</td>
                        <td>{{ $datamhs['nim'] }}</td>
                        <td>{{ $datamhs['nama'] }}</td>
                        <td>
                          <a href="/training/edit/{{ $datamhs['id'] }}" class="btn btn-warning">Edit</a>
                          <a href="/training/delete/{{ $datamhs['id'] }}/{{ $datamhs['nim'] }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @if(Session::has('message'))
          <!-- Notification Result Modal-->
          <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <!-- <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div> -->
                <div class="modal-body">
                  <center>
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                      {{ Session::get('message') }}
                    </div>
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </center>
                </div>
                <!-- <div class="modal-footer">
                  
                </div> -->
              </div>
            </div>
          </div>
          <script type="text/javascript">
              $(window).on('load',function(){
                  $('#resultModal').modal('show');
              });
          </script>
          @endif
@include('template.footer')
