<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Platform;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialPlatformCardsTable.
 */
class SocialPlatformCardsTable extends DataTableComponent
{
    /**
     * @var string
     */
    public $status;

    /**
     * @var Cards
     */
    public $cards;

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
     * @param Cards $cards
     *
     * @return void
     */
    public function mount($status = 'active', $cards = null): void
    {
        $this->status = $status;

        if (isset($cards)) {
            $this->cards = Cards::find($cards);
        }
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if ($this->status === 'deleted') {
            return Platform::onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return Platform::where('active', false);
        }

        return Platform::where('active', true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Type'), 'type')
                ->sortable(),
            Column::make(__('Active'), 'active'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.social.platform.cards.includes.row';
    }
}
