<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the station.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        $this->authorize('manage_station');

        $stationQuery = Station::query();
        $stationQuery->where('name', 'like', '%'.request('q').'%');
        $stations = $stationQuery->paginate(25);

        return view('stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new station.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Station);

        return view('stations.create');
    }

    /**
     * Store a newly created station in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Station);

        $newStation = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $newStation['creator_id'] = auth()->id();

        $station = Station::create($newStation);

        return redirect()->route('stations.show', $station);
    }

    /**
     * Display the specified station.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\View\View
     */
    public function show(Station $station)
    {
        return view('stations.show', compact('station'));
    }

    /**
     * Show the form for editing the specified station.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\View\View
     */
    public function edit(Station $station)
    {
        $this->authorize('update', $station);

        return view('stations.edit', compact('station'));
    }

    /**
     * Update the specified station in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $station
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Station $station)
    {
        $this->authorize('update', $station);

        $stationData = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $station->update($stationData);

        return redirect()->route('stations.show', $station);
    }

    /**
     * Remove the specified station from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $station
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Station $station)
    {
        $this->authorize('delete', $station);

        $request->validate(['station_id' => 'required']);

        if ($request->get('station_id') == $station->id && $station->delete()) {
            return redirect()->route('stations.index');
        }

        return back();
    }
}