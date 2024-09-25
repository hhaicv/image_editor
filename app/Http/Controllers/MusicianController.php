<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use App\Http\Requests\StoreMusicianRequest;
use App\Http\Requests\UpdateMusicianRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MusicianController extends Controller
{

    const PATH_VIEW = 'musicians.';
    const PATH_UPLAOAD = 'musicians';
    public function index()
    {
        $data = Musician::query()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }


    public function create(){
        return view(self::PATH_VIEW . __FUNCTION__);
    }
    // public function create()
    // {
    //     // Lấy tất cả các tệp từ thư mục public/musicians
    //     $files = Storage::disk('public')->files(self::PATH_UPLAOAD);

    //     // Lọc các file hình ảnh dựa vào đuôi file
    //     $images = array_filter($files, function ($file) {
    //         return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
    //     });

    //     // Lấy URL đầy đủ của các hình ảnh
    //     $imageUrls = array_map(function ($image) {
    //         return Storage::url($image);
    //     }, $images);

    //     // Truyền các URL hình ảnh vào view
    //     return view(self::PATH_VIEW . 'create', compact('imageUrls'));
    // }

    // public function upload(){
    //     return view(self::PATH_VIEW . __FUNCTION__);
    // }
    // public function put(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $path = $request->file('image')->store('musicians'); // lưu vào thư mục storage/app/images

    //     return back()->with('success', 'Ảnh đã được tải lên thành công!')->with('path', $path);
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMusicianRequest $request)
    {
        $data = $request->except('profile_picture');
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = Storage::put(self::PATH_UPLAOAD, $request->file('profile_picture'));
        }

        $res = Musician::query()->create($data);
        if ($res) {
            return redirect()->back()->with('success', 'Bạn thêm thành công');
        } else {
            return redirect()->back()->with('danger', 'Bạn không thêm thành công');
        }
    }

    public function show(Musician $musician)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Musician::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMusicianRequest $request, string $id)
    {
        $model = Musician::query()->findOrFail($id);

        $data = $request->except('profile_picture');
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = Storage::put(self::PATH_UPLAOAD, $request->file('profile_picture'));
        }

        $cover = $model->profile_picture;
        $res = $model->update($data);

        if ($request->hasFile('profile_picture') && $cover && Storage::exists($cover)) {
            Storage::delete($cover);
        }
        if ($res) {
            return redirect()->back()->with('success', 'Bạn sửa thành công');
        } else {
            return redirect()->back()->with('danger', 'Bạn sửa không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Musician::query()->findOrFail($id);
        $data->delete();
        return back();
    }
}
