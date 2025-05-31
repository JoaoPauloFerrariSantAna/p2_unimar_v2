<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\BookModel;

class BookController extends Controller
{
	public function getBooks
	{
		return response()->json(BookModel::all());
	}

	public function detailBook(int $id)
	{
		$book = null;
		try
		{
			$book = BookModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("BOOK NOT FOUND");
		}
		return response()->json($book);
	}

	public function storeBook(Request $req)
	{
		$book			= new BookModel();
		$book->title	= $req->input("btitle", null);
		$book->summary	= $req->input("bsummary", null);
		$book->ispn		= $req->input("bispn", null);

		$book->save();
		return response()->json($book);
	}

	public function updateBook(Request $req, int $id)
	{			
		$book		= null;
		$newTitle	= $req->input("btitle", null);
		$newSummary = $req->input("bsummary", null);
		$newIspn	= $req->input("bispn", null);
		try
		{
			$book = bookModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("BOOK NOT FOUND");
		}
		if($newTitle != null) {
			$book->title = $newTitle;
		}
		if($newSummary != null) {
			$book->summary = $newSummary;
		}
		if($newIspn != null) {
			$book->ispn = $newIspn;
		}
		$book->save();
		return response()->json($book);
	}

	public function deleteBook(int $id)
	{
		$book = null;
		try
		{
			$book = BookModel::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			return response()->json("BOOK NOT FOUND");
		}
		$book->delete();
		return response()->json($book);
	}
}
