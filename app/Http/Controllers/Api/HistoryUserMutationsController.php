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

class HistoryUserMutationsController extends Controller
{
    public function index()
    {
        $mutations = Mutations::join('item_mutations','mutations.id', '=', 'item_mutations.mutation_id')
            ->join('items', 'item_mutations.item_id', '=', 'items.id')
            ->join('mutation_types','mutations.mutation_type_id', '=','mutation_types.id')
            ->join('locations', 'items.location_id', '=', 'locations.id')
            ->join('users','mutations.user_id', '=', 'users.id')
            ->orderBy('users.name', 'asc')
            ->orderBy('mutations.date', 'desc')
            ->select('users.name as user_name', 'users.email', 'items.item_name','mutation_types.mutation_type_name', 'item_mutations.qty','mutations.date', 'locations.location_name')
            ->get();

        return response()->json($mutations);
    }

    public function show($userId)
{
    $mutations = Mutations::join('item_mutations','mutations.id', '=', 'item_mutations.mutation_id')
        ->join('items', 'item_mutations.item_id', '=', 'items.id')
        ->join('mutation_types','mutations.mutation_type_id', '=','mutation_types.id')
        ->join('locations', 'items.location_id', '=', 'locations.id')
        ->join('users','mutations.user_id', '=', 'users.id')
        ->where('users.id', $userId)
        ->orderBy('mutations.date', 'desc')
        ->select('users.name as user_name', 'users.email', 'items.item_name','mutation_types.mutation_type_name', 'item_mutations.qty','mutations.date', 'locations.location_name')
        ->get();

    return response()->json($mutations);
}
}
