<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Auth\Models\User;
use App\Domains\Companie\Models\Companies;
use App\Domains\Social\Models\Cards;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class CompanieSelfTable.
 */
class CompanieSelfTable extends DataTableComponent
{
    /**
     * @var User
     */
    public $user;

    /**
     * Livewire Datatable default sort column.
     */
    public string $defaultSortColumn = 'id';

    /**
     * Livewire Datatable default sort direction.
     */
    public string $defaultSortDirection = 'desc';

    /**
     * @param User $user
     */
    public function mount(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Logo')),
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Area'), 'area')
                ->sortable(),
            Column::make(__('Description'), 'description')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Companies::where('model_id', $this->user->id)
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'frontend.companie.includes.row';
    }
}
