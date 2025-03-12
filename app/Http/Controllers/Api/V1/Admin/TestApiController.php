<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Http\Resources\Admin\TestResource;
use App\Test;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('test_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestResource(Test::with(['patients'])->get());
    }

    public function store(StoreTestRequest $request)
    {
        $test = Test::create($request->all());
        $test->patients()->sync($request->input('patients', []));

        return (new TestResource($test))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Test $test)
    {
        abort_if(Gate::denies('test_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TestResource($test->load(['patients']));
    }

    public function update(UpdateTestRequest $request, Test $test)
    {
        $test->update($request->all());
        $test->patients()->sync($request->input('patients', []));

        return (new TestResource($test))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Test $test)
    {
        abort_if(Gate::denies('test_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $test->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
