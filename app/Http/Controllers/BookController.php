<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;


class BookController extends Controller
{
    public function index()
    {
        return view('book', [
            // untuk memaparkan 10 rekod dalam satu halaman
            'books' => Book::orderBy('id', 'desc')->paginate(10)
        ]);

        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }        
        return view('yajra');
    }

    public function find()
    {
        return view('find');
    }

    public function show(Request $request)
    {
        // $id = $request->input('idbuku');
        $validated_data = $request->validate([
            'idbuku' => 'required|numeric'
        ]);

        //dapatkan value array shj
        foreach ($validated_data as $key) {
            $id = $key;
        } 

        $book = Book::find($id);
        if ($book) {
            return view(
                'show',
                [
                    'book' => $book
                ]
            );
        } else
            return redirect('/dashboard/find')->with(['status' => 'Sorry, Id not exist.']);
    }

    // fungsi untuk memaparkan borang
    public function create()
    {
        return view('create');
    }

    // fungsi untuk memproses data
    public function store(Request $request)
    {
        // menyimpan data dengan Model
        $validated_data = $request->validate([
            'title' => 'required|min:5|max:255',
            'author' => 'required|min:5|max:255',
            'price' => 'required|numeric'
        ]);

        Book::create($validated_data);
        return redirect('/dashboard/book')->with('status', 'New Record Successfully created!');
    }

    public function view(Request $request, $id)
    {     
        $data = Book::find($id);
        if ($data) {
            return view(
                'update',
                [
                    'data' => $data
                ]
            );
        } else
            return redirect('/dashboard/book');
    }

    public function save(Request $request)
    {
        // dapatkan id dari form yg dipost
        $id = $request->input('id');

        // buat validation atas input
        $validated_data = $request->validate([
            'title' => 'required|min:5|max:255',
            'author' => 'required|min:5|max:255',
            'price' => 'required|numeric'
        ]);

        // operasi kemaskini
        $success = Book::where('id',$id)->update($validated_data);
        
        if ($success) {
            return redirect('/dashboard/book')->with('status', 'Record Successfully updated!');
        }else
        return redirect('/dashboard/book')->with('status', 'Error updating record!');
    }

    public function delete($id)
    {
        $query = Book::find($id);
        $status = $query->delete();
        
        if ($status) {
            return redirect('/dashboard/book')->with('status', 'Record deleted!');
        }else
        return redirect('/dashboard/book')->with('status', 'Error deleting record!');
    }

    public function paparsoftdelete()
    {
        $user = DB::table('books')->whereNotNull('deleted_at')->get();

        if ($user) {
            return view(
                'softdelete',
                [
                    'soft' => $user
                ]
            );
        } else
            return redirect('/dashboard/book');
        
    }

    public function restore($id)
    {
        $query = Book::where('id',$id)->restore();

        if ($query) {
            return redirect('/dashboard/softdelete')->with('status', 'Record succcessfully restore!');
        }else
        return redirect('/dashboard/softdelete')->with('status', 'Error restoring the record!');
    }

    public function yajradt(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }        
        return view('yajra');
    }
}
