<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container">
    <h1>Danh sách</h1>
    <a href="{{ route('musicians.create') }}" class="btn btn-primary float-end">Thêm mới</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">profile_picture</th>
                <th scope="col">birth_date</th>
                <th scope="col">instrument</th>
                <th scope="col">biography</th>
                <th scope="col">aciton</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td><img width="100px" src="{{ Storage::url($item->profile_picture) }}" alt=""></td>
                    <td>{{ $item->birth_date }}</td>
                    <td>{{ $item->instrument }}</td>
                    <td>{{ $item->biography }}</td>
                    <td><a href="{{ route('musicians.edit', $item->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('musicians.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có xóa kh?')"
                                class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
