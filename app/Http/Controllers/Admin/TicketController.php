<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tickets = Ticket::join('categories', 'tickets.category_id', '=', 'categories.id')
                ->select('tickets.*', 'categories.name as category_name')
                ->orderBy('id', 'desc')
                ->get();
            return DataTables::of($tickets)
                ->addColumn('action', function ($ticket) {
                    return '<ul class="list-inline hstack gap-2 mb-0">
                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                    <a href="javascript:;"
                        onclick="load_detail(\'' . route('admin.tickets.show', $ticket->id) . '\')"
                        class="text-primary d-inline-block edit-item-btn">
                        <i class="ri-eye-fill fs-16"></i>
                    </a>
                <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-placement="top" title="" data-bs-original-title="Edit">
                    <a href="javascript:;"
                        onclick="load_input(\'' . route('admin.tickets.edit', $ticket->id) . '\')"
                        class="text-primary d-inline-block edit-item-btn">
                        <i class="ri-pencil-fill fs-16"></i>
                    </a>
                </li>
                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                    data-bs-placement="top" title="" data-bs-original-title="Remove">
                    <a href="javascript:;"
                        onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('admin.tickets.destroy', $ticket->id) . '\');"
                        class="text-danger d-inline-block remove-item-btn">
                        <i class="ri-delete-bin-5-fill fs-16"></i>
                    </a>
                </li>
            </ul>';
                })
                ->addColumn('price', function ($ticket) {
                    return 'Rp. ' . number_format($ticket->price, 2, ',', '.');
                })
                ->rawColumns(['action', 'price'])
                ->make(true);
        }
        return view('pages.admin.tickets.main');
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.admin.tickets.input', ['data' => new Ticket, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $messages = array(
            'category_id.required' => 'Kategori tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok tidak boleh kosong',
            'cover.required' => 'Cover tidak boleh kosong',
            'cover.image' => 'Cover harus berupa gambar',
            'cover.mimes' => 'Format cover harus jpg, jpeg, png, svg, gif',
            'cover.max' => 'Ukuran cover tidak boleh lebih dari 2MB',
        );
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);


        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('category_id')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('category_id')
                ]);
            } else if ($errors->has('price')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('price')
                ]);
            } else if ($errors->has('stock')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('stock')
                ]);
            } else if ($errors->has('cover')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $errors->first('cover')
                ]);
            }
        }

        $cover = $request->file('cover');
        $cover_name = time() . '.' . $cover->getClientOriginalExtension();
        $cover->move(public_path('images/tickets'), $cover_name);

        $data = new Ticket;
        $data->category_id = $request->category_id;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->stock = $request->stock;
        $data->cover = $cover_name;
        $data->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Tiket berhasil disimpan',
        ]);
    }

    public function show(Ticket $ticket)
    {
        return view('pages.admin.tickets.show', ['data' => $ticket]);
    }

    public function edit(Ticket $ticket)
    {
        $categories = Category::all();
        return view('pages.admin.tickets.input', ['data' => $ticket, 'categories' => $categories]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $messages = array(
            'category_id.required' => 'Kategori tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok tidak boleh kosong',
            'cover.required' => 'Cover tidak boleh kosong',
            'cover.image' => 'Cover harus berupa gambar',
            'cover.mimes' => 'Format cover harus jpg, jpeg, png, svg, gif',
            'cover.max' => 'Ukuran cover tidak boleh lebih dari 2MB',
        );

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('category_id')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('category_id'),
                ]);
            } else if ($errors->has('price')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('price'),
                ]);
            } else if ($errors->has('stock')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('stock'),
                ]);
            } else if ($errors->has('cover')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('cover'),
                ]);
            }
        }

        if ($request->hasFile('cover')) {
            unlink(public_path('images/tickets/' . $ticket->cover));
            $cover = $request->file('cover');
            $cover_name = time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('images/tickets'), $cover_name);
            $ticket->cover = $cover_name;
        }

        $ticket->category_id = $request->category_id;
        $ticket->description = $request->description;
        $ticket->price = $request->price;
        $ticket->stock = $request->stock;
        $ticket->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Tiket berhasil diubah',
        ]);
    }

    public function destroy(Ticket $ticket)
    {
        unlink(public_path('images/tickets/' . $ticket->cover));
        $ticket->delete();

        return response()->json([
            'alert' => 'success',
            'message' => 'Tiket berhasil dihapus',
        ]);
    }
}
