@extends('dashboard.dashboard')

@section('content')
<div class="row justify-content-center">
    <p class="text-center">List Terbaru minggu ini</p>
    @foreach ($features as $key => $items)
    <div class="card" style="width:400px;margin:10px">
        <img class="card-img-top" src="{{asset('img/Ayangkuuu.jpg')}}" style="height: 200px;width:auto" alt="Card image">
        <div class="card-body">
            <h4 class="card-title">{{$items['judul']}}</h4>
            <p class="card-text">{{$items['kategori']}}</p>
            <a href="#" class="btn btn-primary">Liat Buku</a>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <table class="table table-primary" id="buku">
        <thead>

        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
    var buku = <?php echo json_encode($buku); ?>;

    // console.log(buku);

    var dataBuku = $('#buku').DataTable({
        columns: [{
                title: 'ID',
                data: 'id'
            },
            {
                title: 'Judul',
                data: 'judul'
            },
            {
                title: 'Tahun Terbit',
                data: 'tahun_terbit'
            },
            {
                title: 'Penerbit',
                data: 'penerbit'
            },
            {
                title: 'Aksi',
                data: 'penerbit'
            },
            {
                title: 'Actions',
                render: function(data, type, row, meta) {
                    var buttons =
                        '<form action="#" method="GET" class="form-inline" style="display: inline;" target="_blank">' +
                        '<input type="hidden" name="jam" value="' + row.id + '">' +
                        '<button class="button button-green">Pinjam Buku</button>' +
                        '</form>';
                    return buttons;
                }
            }
        ],
    });

    dataBuku.clear().rows.add(buku).draw();
</script>

@endsection