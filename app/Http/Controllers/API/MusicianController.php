<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMusicianRequest;
use App\Http\Requests\UpdateMusicianRequest;
use App\Models\Musician;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function index()
    {
        $data = Musician::query()->get();
        return response()->json($data, 200);
    }




    public function store(StoreMusicianRequest $request)
    {
        $data = $request->all();
        $res = Musician::query()->create($data);
        return response()->json($res, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          $data = Musician::query()->findOrFail($id);
          return response()->json($data, 200);

    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(UpdateMusicianRequest $request, string $id)
    {
        $model = Musician::query()->findOrFail($id);

        $data = $request->except('profile_picture');

        $res = $model->update($data);
        return response()->json($res, 201);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Musician::query()->findOrFail($id);
        $data->delete();
        return response()->json([
            'messages' =>'thành công'
        ], 200);

    }
}
