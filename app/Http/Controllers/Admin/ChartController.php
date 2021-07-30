<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Chart;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Order;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $restaurant->id) {
            abort(403);
        }
        // Get orders grouped by month
        $groups = Order::where('restaurant_id', $restaurant->id)
                  ->selectRaw('EXTRACT(YEAR_MONTH FROM created_at) as month, count(*) as total')
                  ->groupBy('month')
                  ->pluck('total', 'month')->all();
        // Prepare the data for returning with the view
        $keys = array_keys($groups);
        // dd($keys);
        $months = [];
         foreach ($keys as $item){
            // dump($item);
            $months[] = $item % 100;
        }
        // dd($months);

        // dd($groups);
        $chart = new Chart;
            $chart->labels = $months;
            $chart->dataset = (array_values($groups));
            // dd($chart);
            return view('admin.charts.index', compact('chart'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
