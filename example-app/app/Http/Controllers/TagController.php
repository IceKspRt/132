<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    //
    public function index()
    {
        $tag = Tags::all();
        return view('tags.index', compact('tag'));
    }


    public function store(Request $request)
    {
        $tag = new Tags;
        $tag->tag_name = $request->input('label_name');
        $tag->save();
        // DB::table('oeis_tags')->where('tag_id',$tag_id)->delete();
        // DB::statement('SET @new_id = 0;');
        // DB::statement('UPDATE oeis_tags SET tag_id = @new_id:=new_id+1');
        // DB::statement('ALTER TABLE oeis_tags AUTO_INCREMENT = 1;');
        return redirect('/tags');
    }


    public function edit(Tags $tag)
    {
        return view('tags.edit-modal', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'tag_name' => 'required|string|max:255',
        ]);

        $tag = Tags::findOrFail($id);
        $tag->update($data);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy($tag_id)
    {
        $tag = Tags::find($tag_id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag Deleted Successfully');
    }
}
