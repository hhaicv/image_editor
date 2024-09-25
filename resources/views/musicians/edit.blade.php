<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cập nhật</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <h1>Cập nhật</h1>
    <form action="{{ route('musicians.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInput" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
        </div>
        <div class="mb-3">
            <label for="exampleInput" class="form-label">profile_picture</label>
            <input type="file" class="form-control" name="profile_picture">
            <img width="100px" src="{{ Storage::url($data->profile_picture) }}" alt="">
        </div>
        <div class="mb-3">
            <label for="exampleInput" class="form-label">birth_date</label>
            <input type="date" class="form-control" name="birth_date" value="{{ $data->birth_date }}">
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">instrument</label>
            <input type="text" class="form-control" name="instrument" value="{{ $data->instrument }}">
        </div>
        <div class="mb-3">
            <label for="exampleInput" class="form-label">biography</label>
            <input type="text" class="form-control" name="biography" value="{{ $data->biography }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('musicians.index') }}" class="btn btn-success">Danh sách</a>
    </form>
</body>

</html>
