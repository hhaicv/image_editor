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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- TUI Color Picker -->
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.css">
    <script src="https://uicdn.toast.com/tui-color-picker/latest/tui-color-picker.js"></script>

    <!-- TUI Image Editor -->
    <link rel="stylesheet" href="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.css">
    <script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>

    <style>
        /* Custom styling for image preview */
        .tui-image-editor {
            background-image: url('/storage/musicians/remove-bg.png') !important;
        }

        #preview-image {
            padding: 10px;
            border: 1px dashed rgb(195, 195, 195);
            border-radius: 4px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            width: 380px;
            height: 250px;
            object-fit: cover;
            position: relative;
        }

        .action-buttons {
            position: absolute;
            bottom: 10px;
            right: 60px;
            display: none;
            gap: 5px;
        }

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

            <div class="row align-items-start">
                <div class="col-4 preview-container" style="position: relative;">
                    <div style="width: 380px; height: 250px;">
                        <a>
                            <img id="preview-image" src="{{ asset('storage/musicians/white.png') }}" alt="">
                        </a>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="deleteImage()">
                                <i class="bi bi-x-circle"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <input type="file" id="imageInput" name="profile_picture" accept="image/*" style="display: none;"
                        onchange="previewImage(event)">
                    <button type="button" class="btn btn-secondary" id="uploadButton"
                        onclick="document.getElementById('imageInput').click();">
                        <i class="bi bi-upload"></i>
                    </button>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <img id="modal-image" src="{{ asset('storage/musicians/white.png') }}"
                            alt="Image for editing" style="display: none">
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

    <script src="https://uicdn.toast.com/tui-image-editor/latest/tui-image-editor.js"></script>
    <script>
        let editor;

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const previewImage = document.getElementById('preview-image');
                previewImage.src = reader.result;
                previewImage.style.display = 'block';
                document.querySelector('.action-buttons').style.display = 'flex';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // function previewImage(event) {
        //     const file = event.target.files[0];

        //     // Kiểm tra loại file
        //     if (!file.type.startsWith('image/')) {
        //         alert('Please upload an image file.');
        //         return;
        //     }

        //     const reader = new FileReader();
        //     reader.onload = function() {
        //         const img = new Image();
        //         img.onload = function() {
        //             // Tạo một canvas để vẽ hình ảnh
        //             const canvas = document.createElement('canvas');
        //             const ctx = canvas.getContext('2d');

        //             // Đặt kích thước cho canvas (thay đổi kích thước nếu cần)
        //             const MAX_WIDTH = 2000; // Kích thước tối đa
        //             const MAX_HEIGHT = 1500;

        //             let width = img.width;
        //             let height = img.height;

        //             // Tính toán tỉ lệ
        //             if (width > height) {
        //                 if (width > MAX_WIDTH) {
        //                     height *= MAX_WIDTH / width;
        //                     width = MAX_WIDTH;
        //                 }
        //             } else {
        //                 if (height > MAX_HEIGHT) {
        //                     width *= MAX_HEIGHT / height;
        //                     height = MAX_HEIGHT;
        //                 }
        //             }

        //             // Đặt kích thước cho canvas
        //             canvas.width = width;
        //             canvas.height = height;

        //             // Vẽ hình ảnh đã điều chỉnh kích thước vào canvas
        //             ctx.drawImage(img, 0, 0, width, height);

        //             // Chuyển đổi canvas thành base64
        //             const compressedImage = canvas.toDataURL(file.type);

        //             // Cập nhật hình ảnh xem trước
        //             const previewImage = document.getElementById('preview-image');
        //             previewImage.src = compressedImage;
        //             previewImage.style.display = 'block';
        //             document.querySelector('.action-buttons').style.display = 'flex';
        //         };

        //         img.src = reader.result;
        //     };

        //     reader.readAsDataURL(file);
        // }


        function deleteImage() {
            const previewImage = document.getElementById('preview-image');
            previewImage.src = '{{ asset('storage/musicians/white.png') }}'; // Reset to default image
            previewImage.style.display = 'block';
            document.querySelector('.action-buttons').style.display = 'none';

            // Reset input file
            const dataTransfer = new DataTransfer();
            document.getElementById('imageInput').files = dataTransfer.files;
        }

        // Thêm sự kiện cho modal
        document.getElementById('staticBackdrop').addEventListener('show.bs.modal', function(event) {
            const previewImage = document.getElementById('preview-image'); // Lấy thẻ hình ảnh xem trước
            const modalImage = document.getElementById('modal-image'); // Lấy thẻ hình ảnh trong modal
            modalImage.src = previewImage.src; // Cập nhật đường dẫn hình ảnh trong modal

            // Nếu editor đã được khởi tạo, hãy hủy nó
            if (editor) {
                editor.destroy();
            }

            // Gọi hàm khởi tạo trình chỉnh sửa hình ảnh
            initImageEditor(modalImage.src);
        });

        function initImageEditor(imageUrl) {
            editor = new tui.ImageEditor('#tui-image-editor-container', {
                includeUI: {
                    loadImage: {
                        path: imageUrl,
                        name: 'SampleImage',
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


        }
        // Khi người dùng nhấn nút Remove Background
        document.getElementById('remove-background').addEventListener('click', function() {
            if (editor) {
                // Lấy ảnh đã chỉnh sửa từ editor
                const editedImage = editor.toDataURL();
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
                formData.append('file', file, 'image.png'); // Thêm file vào FormData
                fetch('https://nhhoang.shop/api/action/ai/remove-background/', {
                        method: 'POST',
                        mode: 'no-cors',
                        headers: {
                            'accept': 'application/json',
                        },
                        body: formData // Gửi FormData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error removing background');
                        }
                        return response.json(); // Nhận dữ liệu hình ảnh dạng JSON
                    })
                    .then(data => {
                        // Kiểm tra nếu 'data' và 'image' tồn tại
                        if (data && data.image) {
                            const base64Image = data.image; // Lấy dữ liệu base64
                            const imageUrl = `data:image/png;base64,${base64Image}`;

                            // Cập nhật TUI Image Editor với hình ảnh mới đã xóa nền
                            editor.loadImageFromURL(imageUrl, 'Edited Image')
                                .then(() => {
                                    // Hiển thị hình ảnh đã xóa nền ở phần xem trước trên form
                                    document.getElementById('preview-image').src = imageUrl;
                                    alert('Hình ảnh được xóa nền thành công!!!');
                                });
                        } else {
                            throw new Error('Image data not found in the response');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove background. Please try again.');
                    });
            }
        });

        document.getElementById('save-image').addEventListener('click', function() {
            if (editor) {
                const editedImage = editor.toDataURL();

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

                // Tạo một đối tượng file từ Blob
                const file = new File([blob], 'edited-image.png', {
                    type: mimeString
                });

                // Cập nhật input file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                document.getElementById('imageInput').files = dataTransfer.files;

                // Hiển thị hình ảnh mới trong phần preview
                document.getElementById('preview-image').src = editedImage;

                // Đóng modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                modal.hide();
            }
        });
    </script>
</body>

</html>
