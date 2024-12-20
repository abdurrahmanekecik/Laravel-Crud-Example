<!DOCTYPE html>
<html>
<head>
    <title>Items</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="form-group mb-3">
        <label for="category_id">Kategori</label>
        <select class="form-control" id="category_id" name="category_id" disabled>

                <option >{{ $item->category->name }}</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="name">Adı</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" disabled>
    </div>




    <div class="form-group mb-3">
        <label>Durumu</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="status_active" disabled name="status" value="1" {{ $item->status == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_active">Aktif</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="status_passive" disabled name="status" value="0" {{ $item->status == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_passive">Pasif</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="status_pending" disabled name="status" value="2" {{ $item->status == 2 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_pending">Beklemede</label>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="image">Görseli</label>
        <div>
            <img src="{{ asset('images/' . $item->image) }}" alt="Item Image" class="img-fluid">
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="summernote">Açıklama</label>
        <textarea class="form-control" id="summernote" name="description" disabled>{{ $item->description }}</textarea>
    </div>


    <button onclick="window.print()" class="btn btn-primary mt-3">Yazdır
    </button>
</div>

</body>
</html>
