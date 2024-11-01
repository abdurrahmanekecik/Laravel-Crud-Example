<!DOCTYPE html>
<html>
<head>
    <title>Items</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .btn-status {
            width: 100%;
            padding: .25rem .5rem;
            font-size: .875rem;
        }
        .search-bar {
            max-width: 300px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Items</h2>
        <div class="d-flex">
            <input type="search" id="search-input" class="form-control me-2 search-bar" placeholder="Item Bilgisi Girin" onkeyup="searchTable()">
            <a href="{{ route('items.create') }}" class="btn btn-primary">Yeni Item Ekle</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori Adı</th>
                <th scope="col">Adı</th>
                <th scope="col">Görseli</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Durum</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody id="items-table-body">
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset('images/' . $item->image) }}" style="height: 150px; width: 150px;" class="img-thumbnail"></td>
                    <td>{!! Str::limit($item->description, 50) !!}</td>
                    <td>
                        @if($item->status == 2)
                            <span class="btn btn-warning btn-status">Beklemede</span>
                        @elseif($item->status == 1)
                            <span class="btn btn-success btn-status">Aktif</span>
                        @elseif($item->status == 0)
                            <span class="btn btn-danger btn-status">Pasif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-primary">Düzenle</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $items->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</div>

<script>
    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("search-input");
        filter = input.value.toLowerCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }
</script>

</body>
</html>
