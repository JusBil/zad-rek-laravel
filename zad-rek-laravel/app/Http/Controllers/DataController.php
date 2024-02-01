<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Helpers\DogsApi;
use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    private DogsApi $dogs_api;
    public function __construct()
    {
        $this->dogs_api = new DogsApi('special-key');
    }
    public function index(string $status = 'available') : View 
    {
        if (!in_array($status, ['available', 'pending', 'sold'])) return abort(404);

        $data = $this->dogs_api->getDogs($status);
        if (is_array($data)) return view('data/index', ['data' => $data]);
        return view('errors/api-error', ['error' => $data]);
    }

    public function add_form() : View 
    {
        return view('data/store');
    }
    public function update_form(Request $request) : View 
    {
        if (isset($request->id)) {
            $data = $this->dogs_api->getDog($request->id);
            if (is_array($data)) {
                return view('data/update', [
                    'id' => $request->id,
                    'dog' => $data
                ]);
            }
            return view('errors/api-error', ['error' => $data]);
        }
        return abort(404);
    }
    public function update(Request $request) : RedirectResponse 
    {
        if (!isset($request->id)) {
            return abort(404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->dogs_api->getDog($request->id);
        if (is_array($data)) {
            $update = $this->dogs_api->updateDog([
                'id' => $request->id,
                'name' => $request->name,
                'status' => $request->status,
            ]);

            if ((int)$update) {
                return redirect()->route('list_show')->withSuccess('dog updated');
            }
            return back()->withErrors([$update]);
        }
        return abort(404);

    }
    public function store(Request $request) : RedirectResponse 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $add = $this->dogs_api->addDog([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        if ((int)$add) {
            return redirect()->route('list_show')->withSuccess('dog added');
        }
        return back()->withErrors([$add]);
    }
    public function delete(Request $request) : RedirectResponse 
    {
        if (!isset($request->id)) {
            return abort(404);
        }
        $data = $this->dogs_api->getDog($request->id);
        if (is_array($data)) {
            $delete = $this->dogs_api->deleteDog($request->id);

            if ((int)$delete) {
                return redirect()->route('list_show')->withSuccess('dog deleted');
            }
            return back()->withErrors([$delete]);
        }
        return abort(404);
    }
}
