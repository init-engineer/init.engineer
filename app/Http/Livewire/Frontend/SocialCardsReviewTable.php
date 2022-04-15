<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Social\Models\Cards;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialCardsReviewTable.
 */
class SocialCardsReviewTable extends DataTableComponent
{
    /**
     * Livewire Datatable default sort column.
     */
    public string $defaultSortColumn = 'created_at';

    /**
     * Livewire Datatable default sort direction.
     */
    public string $defaultSortDirection = 'desc';

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
            Column::make(__('Vote')),
            Column::make(__('Created At'), 'created_at')
                ->sortable(),
        ];
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Cards::whereDate('created_at', '>=', Carbon::now()->subDays(14))
            ->active(false)
            ->blockade(false)
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'frontend.social.cards.includes.review';
    }
}
