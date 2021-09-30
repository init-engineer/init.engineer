<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Auth\Models\User;
use App\Domains\Social\Models\Cards;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class SocialCardsSelfTable.
 */
class SocialCardsSelfTable extends DataTableComponent
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var array|string[]
     */
    public array $filterNames = [
        'active' => 'Active',
        'blockade' => 'Blockade',
    ];

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
    public function filters(): array
    {
        return [
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            'blockade' => Filter::make('Blockade')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->sortable(),
            Column::make(__('Picture')),
            Column::make(__('Content'), 'content')
                ->sortable(),
            Column::make(__('Active Status'), 'active')
                ->sortable(),
            Column::make(__('Blockade Status'), 'blockade')
                ->sortable(),
            Column::make(__('Created At'), 'created_at')
                ->sortable(),
            Column::make(__('Updated At'), 'updated_at')
                ->sortable(),
        ];
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Cards::where('model_id', $this->user->id)
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getFilter('blockade'), fn ($query, $blockade) => $query->where('blockade', $blockade === 'yes'));
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'frontend.social.cards.includes.self';
    }
}
