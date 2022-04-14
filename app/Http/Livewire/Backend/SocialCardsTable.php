<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Cards;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class SocialCardsTable.
 */
class SocialCardsTable extends DataTableComponent
{
    /**
     * Livewire Datatable default sort column.
     */
    public string $defaultSortColumn = 'id';

    /**
     * Livewire Datatable default sort direction.
     */
    public string $defaultSortDirection = 'desc';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        // The class set on the table when using bootstrap
        'bootstrap.classes.table' => 'table table-striped',

        // Whether or not the table is wrapped in a `.container-fluid` or not
        'bootstrap.container' => false,
    ];

    /**
     * @param string $status
     *
     * @return void
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if ($this->status === 'deleted') {
            $query = Cards::onlyTrashed();
        } else if ($this->status === 'deactivated') {
            $query = Cards::where('active', false);
        } else {
            $query = Cards::where('active', true);
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'))
            ->when($this->getFilter('blockade'), fn ($query, $blockade) => $query->where('blockade', $blockade === 'yes'));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->sortable(),
            Column::make(__('Author'), 'model.name')
                ->searchable()
                ->sortable(),
            Column::make(__('Picture'), 'picture')
                ->sortable(),
            Column::make(__('Content'), 'content')
                ->sortable(),
            Column::make(__('Platform'), 'platform'),
            Column::make(__('Created At'), 'created_at')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.social.cards.includes.row';
    }
}
