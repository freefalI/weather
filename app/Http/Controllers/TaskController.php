<?php

namespace App\Http\Controllers;

use App\Task;
use App\WeatherCharacteristic;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the task.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $query = Task::query();
        $query->where('description', 'like', '%' . request('q') . '%');
        $tasks = $query->with('problemType')->paginate(25);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Station);

        return view('stations.create');
    }

    /**
     * Store a newly created task in storage.
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
     * Display the specified task.
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
//        dump($weatherData);
        stop_measure('render1');
        start_measure('render3', 'Time for rendering3');

//        $res =Humidity::where('station_id',$station->id)->get();
//        $res =AtmospherePressure::where('station_id',$station->id)->get();
//        $res =AirTemperature::where('station_id',$station->id)->get();
//        $res =RoadTemperature::where('station_id',$station->id)->get();
//        $res =Precipitation::where('station_id',$station->id)->get();
//        stop_measure('render3');
        $dataForCharts = [];
        return view('stations.show', ['station'=>$station,'measureData'=>$weatherData]);
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
