<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceTypesDataTable;
use App\Device;
use App\DeviceType;
use Illuminate\Http\Request;
use Validator;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DeviceTypesDataTable $dataTable)
    {
        return $dataTable->render('admin.devicetypes');
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
        $validator = Validator::make($request->all(), [
            'devicetype_name' => 'required'
        ]);
        if ($validator->passes()) {
            try {
                $devicetype = new DeviceType([
                    'name' => $request->get('devicetype_name')
                ]);
                $devicetype->save();
                return response()->json([
                    'success' => true,
                    'insert' => $devicetype->id
                ]);
            }
            catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
        }
        else {
            return response()->json([
                'success' => false,
                'error' => implode('\n', $validator->errors()->all())
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceType  $devicetype
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceType $devicetype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceType  $devicetype
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceType $devicetype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceType  $devicetype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceType $devicetype)
    {
        $validator = Validator::make($request->all(), [
            'edit_devicetype_name' => 'required'
        ]);
        if ($validator->passes()) {
            try {
                $devicetype->name = $request->get('edit_devicetype_name');
                $devicetype->save();
                return response()->json(['success' => true]);
            }
            catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }
        }
        else {
            return response()->json([
                'success' => false,
                'error' => implode('\n', $validator->errors()->all())
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceType  $devicetype
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceType $devicetype)
    {
        try {
            $devicetype->delete();
            return response()->json(['success' => true]);
        }
        catch(\Exception $e) {
            return response()->json(['success' => false, 'error' => $e]);
        }
    }
}
