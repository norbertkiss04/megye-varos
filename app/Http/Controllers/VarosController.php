<?php

namespace App\Http\Controllers;

use App\Models\Varos;
use Illuminate\Http\Request;

class VarosController extends Controller
{
    public function getVarosbyMegye ($id){
        $varosok = Varos::where('megye_id', $id)->get();
        return ['varosok' => $varosok];
    }

    public function delete($id) {
        $article = Varos::findOrFail($id);
        if($article)
            $article->delete();
        else
            return response()->json(error);
        return response()->json(null);
    }

    public function modify(Request $request, $id) {
        $newName = $request->input('newName');
        $updated = Varos::whereId($id)->update(['nev' => $newName]);
        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Update successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Update failed'], 500);
        }
    }

    public function store(Request $request) {

        $varos = Varos::create([
            'nev' => $request->input('nev'),
            'megye_id' => $request->input('megye_id')
        ]);

        return response()->json(['success' => true, 'message' => 'Varos added successfully', 'varos' => $varos]);
    }
}
