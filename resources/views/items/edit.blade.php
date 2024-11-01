<!DOCTYPE html>
<html>
<head>
    <title>Items</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <form id="updateForm" action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="form-group mb-3">
            <label for="category_id">Kategori</label>
            <select class="form-control" id="category_id" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="name">Adı</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}">
        </div>

        <div class="form-group mb-3">
            <label for="status">Durumu</label>
            <select class="form-control" id="status" name="status">
                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Pasif</option>
                <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Beklemede</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="image">Görseli</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($item->image)
                <img src="{{ asset('images/' . $item->image) }}" alt="Current Image" class="mt-2" style="width: 100px;">
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="summernote">Açıklama</label>
            <textarea class="form-control" id="summernote" name="description">{{ old('description', $item->description) }}</textarea>
        </div>

        <button type="button" onclick="confirmUpdate()" class="btn btn-primary mt-3">Güncelle</button>
    </form>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400
        });
    });


    function confirmUpdate() {
        alertify.confirm("Uyarı",
            "Bu işlemi yapmak istediğinizden emin misiniz?",
            function () {
                document.querySelector("#updateForm").submit();
            },
            function () {
                alertify.error("İşlem iptal edildi.");
            }
        ).set({
            labels: { ok: "Evet", cancel: "Hayır" },
            title: "Onay"
        });
    }

</script>

</body>
</html>
