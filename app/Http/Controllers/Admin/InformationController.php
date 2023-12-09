<?php

namespace App\Http\Controllers\Admin;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Information::query())
                ->addColumn('action', function ($information) {
                    return '<ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="" data-bs-original-title="Edit">
                        <a href="javascript:;"
                            onclick="load_detail(\'' . route('admin.informations.show', $information->id) . '\')"
                            class="text-primary d-inline-block edit-item-btn">
                            <i class="ri-eye-fill fs-16"></i>
                        </a>
                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="" data-bs-original-title="Edit">
                        <a href="javascript:;"
                            onclick="load_input(\'' . route('admin.informations.edit', $information->id) . '\')"
                            class="text-primary d-inline-block edit-item-btn">
                            <i class="ri-pencil-fill fs-16"></i>
                        </a>
                    </li>
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="" data-bs-original-title="Remove">
                        <a href="javascript:;"
                            onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('admin.informations.destroy', $information->id) . '\');"
                            class="text-danger d-inline-block remove-item-btn">
                            <i class="ri-delete-bin-5-fill fs-16"></i>
                        </a>
                    </li>
                </ul>';
                })
                ->addColumn('image', function ($information) {
                    $url = asset('images/informations/' . $information->image);
                    return '<img src="' . $url . '" width="100px" height="100px">';
                })
                ->addColumn('description', function ($information) {
                    return substr($information->description, 0, 100) . '...';
                })
                ->rawColumns(['action', 'image', 'description'])
                ->make(true);
        }
        return view('pages.admin.informations.main');
    }

    public function create()
    {
        return view('pages.admin.informations.input', ['data' => new Information]);
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Judul harus diisi',
            'title.regex' => 'Judul harus berupa huruf atau angka',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB',
            'description.required' => 'Deskripsi harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z0-9 .\-]+$/',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('title')
                ]);
            } elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description')
                ]);
            } elseif ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('image')
                ]);
            }
        }

        $information = new Information;
        $information->title = $request->title;
        $information->description = $request->description;
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/informations'), $fileName);
        $information->image = $fileName;
        $information->user_id = auth()->user()->id;
        $information->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menambahkan data'
        ]);
    }

    public function show(Information $information)
    {
        return view('pages.admin.informations.show', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('pages.admin.informations.input', ['data' => $information]);
    }

    public function update(Request $request, Information $information)
    {
        $messages = [
            'title.required' => 'Judul harus diisi',
            'title.regex' => 'Judul harus berupa huruf atau angka',
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'Gambar harus berupa gambar',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB',
            'description.required' => 'Deskripsi harus diisi',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z0-9 .\-]+$/',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('title')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('title')
                ]);
            } elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description')
                ]);
            } elseif ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('image')
                ]);
            }
        }

        $information->title = $request->title;
        $information->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            unlink(public_path('images/informations/' . $information->image));
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/informations'), $fileName);
            $information->image = $fileName;
        }
        $information->user_id = auth()->user()->id;
        $information->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil mengubah data'
        ]);
    }

    public function destroy(Information $information)
    {
        unlink(public_path('images/informations/' . $information->image));
        $information->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menghapus data'
        ]);
    }
}
