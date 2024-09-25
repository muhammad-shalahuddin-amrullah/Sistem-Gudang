<?php

namespace App\Http\Controllers\Api;

use App\Models\items;
use App\Models\mutations;
use App\Models\ItemMutations;
use App\Models\MutationTypes;
use App\Models\User;
use App\Models\Locations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class HistoryItemMutationsController extends Controller
{
    public function index()
    {
        $item = ItemMutations::join('items', 'item_mutations.item_id', '=', 'items.id')
            ->join('mutations', 'item_mutations.mutation_id', '=','mutations.id')
            ->join('mutation_types','mutations.mutation_type_id', '=','mutation_types.id')
            ->join('users','mutations.user_id', '=', 'users.id')
            ->join('locations', 'items.location_id', '=', 'locations.id')
            ->orderBy('items.item_name', 'asc')
            ->orderBy('mutations.date', 'desc')
            ->select('item_mutations.*', 'items.item_name','mutations.date')
            ->get();
    
        return response()->json($item);
    }

    public function show($itemId)
    {
        $item = ItemMutations::join('items', 'item_mutations.item_id', '=', 'items.id')
            ->join('mutations', 'item_mutations.mutation_id', '=','mutations.id')
            ->join('mutation_types','mutations.mutation_type_id', '=','mutation_types.id')
            ->join('users','mutations.user_id', '=', 'users.id')
            ->join('locations', 'items.location_id', '=', 'locations.id')
            ->where('items.id', $itemId)
            ->orderBy('mutations.date', 'desc')
            ->select('item_mutations.*', 'items.item_name','mutations.date')
            ->get();
    
        return response()->json($item);
    }
}
