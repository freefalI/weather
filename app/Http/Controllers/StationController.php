<?php

namespace App\Http\Controllers;

use App\Services\Warnings\WarningService;
use App\Station;
use App\WeatherCharacteristic;
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
        foreach ( $stations as &$station) {
            $warningService = new WarningService($station->id);
            $warnings = $warningService->getWarnings();
            $status = 0;//all is ok
            if ($warnings) $status = 1; // danger
            $statusColors = [
                '#75ff0085',
                '#ff000085'
            ];
            $statusTexts = [
                'Safe conditions on the road',
                'Danger conditions on the road!',
            ];
            $station->status = $status ? 'Danger' : 'Safe';
            $station->statusColor = $statusColors[$status];
        }


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
        start_measure('render', 'Time for rendering');

        $res = WeatherCharacteristic::where('station_id', $station->id)->get();
        stop_measure('render');

        start_measure('render1', 'Time for rendering2');
        $weatherData = $res->groupBy('type');//->map(function ($val){return $val->toArray();});
    //    dump($weatherData->toArray());
        stop_measure('render1');
        start_measure('render3', 'Time for rendering3');

//        $res =Humidity::where('station_id',$station->id)->get();
//        $res =AtmospherePressure::where('station_id',$station->id)->get();
//        $res =AirTemperature::where('station_id',$station->id)->get();
//        $res =RoadTemperature::where('station_id',$station->id)->get();
//        $res =Precipitation::where('station_id',$station->id)->get();
//        stop_measure('render3');
        $dataForCharts = [];

        $warningService = new WarningService($station->id);
        $warnings= $warningService->getWarnings();
        $status = 0;//all is ok
        if($warnings)$status = 1; // danger
        $statusColors =[
            '#75ff0085',
            '#ff000085'
        ];
        $statusTexts =[
            'Safe conditions on the road',
            'Danger conditions on the road!',

        ];
//        dd($warnings);
        return view('stations.show', ['station'=>$station,'measureData'=>$weatherData,'warnings'=>$warnings,'statusColor'=>$statusColors[$status],'statusText'=>$statusTexts[$status]]);
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
