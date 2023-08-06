<?php

namespace App\Services;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeService
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    private $query;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = Episode::query();
    }

    public function get()
    {
        $this->setFiltersFromRequest();

        return $this->query->with('characters')->paginate(10)->withQueryString();
    }

    private function setFiltersFromRequest()
    {

        $name = $this->request->get('name', '');
        $this->setNameFilter($name);
        $createdFrom = $this->request->get('createdFrom', '');
        $this->setCreatedFromFilter($createdFrom);
        $createdTo = $this->request->get('createdTo', '');
        $this->setCreatedToFilter($createdTo);
        $orderBy = $this->request->get('orderBy', '');
        $this->orderByFilter($orderBy);

    }
    private function setNameFilter(?string $name)
    {
        if ($name) {
            $this->query->where('name', 'like', '%' . $name . '%');
        }
    }

    private function setCreatedFromFilter(?string $createdFrom)
    {
        if ($createdFrom) {
            $this->query->where('created', '>=', $createdFrom);
        }
    }

    private function setCreatedToFilter(?string $createdTo)
    {
        if ($createdTo) {
            $this->query->where('created', '<=',  $createdTo);
        }
    }

    private function orderByFilter(?string $orderBy)
    {
        if ($orderBy) {
            switch ($orderBy) {
                case "episode.asc":
                    $this->query->orderBy('episode', 'ASC');
                break;
                case "episode.desc":
                    $this->query->orderBy('episode', 'DESC');
                break;
                case "name.asc":
                    $this->query->orderBy('name', 'ASC');
                break;
                case "name.desc":
                    $this->query->orderBy('name', 'DESC');
                break;
                case "air.asc":
                    $this->query->orderBy('air_date', 'ASC');
                break;
                case "air.desc":
                    $this->query->orderBy('air_date', 'DESC');
                break;
                case "created.asc":
                    $this->query->orderBy('created', 'ASC');
                break;
                case "created.desc":
                    $this->query->orderBy('created', 'DESC');
                break;
            }
        }
    }
}
