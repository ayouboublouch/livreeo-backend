<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractController;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Illuminate\Pagination\LengthAwarePaginator;

class CitiesController extends AbstractController
{
    public function index()
    {
        $this->getAuthUser();
        
        $query = City::query();

        if ($keyword = request()->get('keyword')) {
            $query->where('name', 'LIKE', "%$keyword%");
        }

        /**
         * @var LengthAwarePaginator
         */
        $paginator = $query->paginate();

        $paginator->setCollection(
            CityResource::collection($paginator->getCollection())->collection
        );
        
        return $this->successResponseWithData([
            'cities' => $paginator,
        ]);
    }

    public function store()
    {
        $this->getAuthUser();

        $data = $this->getValidatedData([
            'name' => 'required|string',
        ]);

        $city = City::create($data);

        return $this->successResponseWithData([
            'city' => new CityResource($city)
        ]);
    }

    public function update(City $city)
    {
        $this->getAuthUser();

        $data = $this->getValidatedData([
            'name' => 'required|string',
        ]);

        $city->update($data);

        return $this->successResponseWithData([
            'city' => new CityResource($city)
        ]);
    }

    public function destroy(City $city)
    {
        $this->getAuthUser();

        $city->delete();

        return $this->successResponseWithData();
    }
}

