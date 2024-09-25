<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm mới</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- TUI Color Picker -->
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">
    <script src="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.js"></script>

    <!-- TUI Image Editor -->
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.css">
    <script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>

    {{-- remove backgroup --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Custom styling for image preview */
        #preview-image {
            width: 100%;
            height: 100px;
        }

        /* Custom styling for TUI Image Editor container */
        #tui-image-editor-container {
            width: 100%;
            height: 550px !important;
        }

        .tui-image-editor-header {
            display: none !important;
        }
    </style>

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
    <h1>Thêm mới</h1>
    <!-- Form to submit data -->
    <form action="{{ route('musicians.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInput" class="form-label">Name</label>
            <input type="text" class="form-control" name="name">
        </div>

        <!-- Profile Picture Upload -->
        <div class="mb-3">
            <label for="exampleInput" class="form-label">Profile Picture</label>
            <div style="width: 220px">
                <a id="thumb-image" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img id="preview-image" src="{{ asset('storage/musicians/white.png') }}" alt="">
                </a>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Image</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" id="image-upload" class="form-control" accept="image/*"
                                name="profile_picture">
                            <div style="border: 1px solid rgb(195, 195, 195); margin-top: 20px; border-radius:5px">
                                @foreach ($imageUrls as $url)
                                    <img style="width: 172px; height: 120px; object-fit: cover;
                                border: 1px dashed rgb(195, 195, 195); padding: 10px; margin: 7px 4px;
                                border-radius: 4px;
                                box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);"
                                        src="{{ $url }}" alt="Image" />
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <!-- TUI Image Editor container -->
                                <div id="tui-image-editor-container"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-warning" id="remove-background">Remove
                                Background</button>
                            <button type="button" class="btn btn-primary" id="save-image">Save Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">Birth Date</label>
            <input type="date" class="form-control" name="birth_date">
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">Instrument</label>
            <input type="text" class="form-control" name="instrument">
        </div>

        <div class="mb-3">
            <label for="exampleInput" class="form-label">Biography</label>
            <input type="text" class="form-control" name="biography">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('musicians.index') }}" class="btn btn-success">Danh sách</a>
    </form>

    <!-- Modal for Image Editor -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" id="image-upload" class="form-control" accept="image/*"
                        name="profile_picture">
                    <div class="mt-3">
                        <!-- TUI Image Editor container -->
                        <div id="tui-image-editor-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning" id="remove-background">Remove Background</button>
                    <button type="button" class="btn btn-primary" id="save-image">Save Image</button>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    let imageEditor; // Khai báo biến để sử dụng TUI Image Editor

    // Khi người dùng chọn ảnh
    document.getElementById('image-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            // Khởi tạo TUI Image Editor sau khi ảnh được chọn
            imageEditor = new tui.ImageEditor('#tui-image-editor-container', {
                includeUI: {
                    loadImage: {
                        path: e.target.result,
                        name: 'SelectedImage'
                    },
                    theme: {},
                    menu: ['crop', 'flip', 'rotate', 'draw', 'shape', 'icon', 'text'],
                    // initMenu: 'filter',
                    uiSize: {
                        width: '100%',
                        height: '400px'
                    },
                    menuBarPosition: 'left'
                },
                cssMaxWidth: 700,
                cssMaxHeight: 500
            });
        };

        if (file) {
            reader.readAsDataURL(file); // Đọc file ảnh để hiển thị trong Image Editor
        }
    });
    // Khi người dùng nhấn nút Remove Background
    document.getElementById('remove-background').addEventListener('click', function() {
        if (imageEditor) {
            // Lấy ảnh đã chỉnh sửa
            const editedImage = imageEditor.toDataURL();

            // Chuyển đổi base64 thành Blob
            const byteString = atob(editedImage.split(',')[1]);
            const mimeString = editedImage.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);

            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            const file = new Blob([ab], {
                type: mimeString
            });

            const formData = new FormData();
            formData.append('image_file', file, 'image.png'); // Thêm file vào FormData

            // Gọi API remove.bg để xóa nền
            fetch('https://api.remove.bg/v1.0/removebg', {
                    method: 'POST',
                    headers: {
                        'X-Api-Key': 'yviauBjEZTU48PyczZrAG5Ki', // Thay YOUR_API_KEY bằng API key của bạn
                    },
                    body: formData // Gửi FormData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error removing background');
                    }
                    return response.blob(); // Nhận dữ liệu hình ảnh
                })
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    // Cập nhật TUI Image Editor với hình ảnh mới đã xóa nền
                    imageEditor.loadImageFromURL(url, 'Edited Image')
                        .then(() => {
                            // Hiển thị hình ảnh đã xóa nền ở phần xem trước trên form
                            document.getElementById('preview-image').src = url;
                        });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to remove background. Please try again.');
                });
        }
    });
    document.getElementById('save-image').addEventListener('click', function() {
        if (imageEditor) {
            // Lấy ảnh đã chỉnh sửa dưới dạng Data URL
            const editedImage = imageEditor.toDataURL();

            // Hiển thị ảnh đã chỉnh sửa ở phần xem trước
            document.getElementById('preview-image').src = editedImage;

            // Chuyển đổi base64 thành Blob
            const byteString = atob(editedImage.split(',')[1]);
            const mimeString = editedImage.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);

            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            const blob = new Blob([ab], {
                type: mimeString
            });

            // Tạo một file từ Blob để cập nhật input file
            const file = new File([blob], 'edited-image.png', {
                type: mimeString
            });

            // Tạo một đối tượng DataTransfer để chứa file đã chỉnh sửa
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Cập nhật input file với file đã chỉnh sửa
            document.getElementById('image-upload').files = dataTransfer.files;

            // Đóng modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
            modal.hide();
        }
    });
</script>

</html>
