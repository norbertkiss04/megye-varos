<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Megye Varos gyak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Megye és Város Kezelő</h1>

    <div class="row">
        <div class="col-md-6">
            <select class="form-select" id="form">
                <option value="" disabled selected>Válasszon</option>
                @foreach($megyek as $megye)
                    <option value="{{ $megye->id }}">{{ $megye->nev }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-4">
        <h3>Városok: <span id="result"></span></h3>
        <div class="contx"></div>
    </div>

    <div id="addVarosContainer" class="mt-4 d-none">
        <h3>Új Város Hozzáadása</h3>
        <form id="addVarosFormInner">
            <div class="mb-3">
                <label for="varosName" class="form-label">Város neve</label>
                <input type="text" class="form-control" id="varosName" name="nev" required>
            </div>
            <input type="hidden" id="selectedMegyeId" name="megye_id">
            <button type="submit" class="btn btn-success">Hozzáadás</button>
            <button type="button" id="cancelAddVaros" class="btn btn-secondary">Mégse</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('app.js') }}"></script>
</body>
</html>
