<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Comments;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialCommentsTable.
 */
class SocialCommentsTable extends DataTableComponent
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
            $query = Comments::onlyTrashed();
            if (isset($this->cards)) {
                $query->where('card_id', $this->cards->id);
            }
        } else if ($this->status === 'deactivated') {
            $query = Comments::where('active', false);
            if (isset($this->cards)) {
                $query->where('card_id', $this->cards->id);
            }
        } else {
            $query = Comments::where('active', true);
            if (isset($this->cards)) {
                $query->where('card_id', $this->cards->id);
            }
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
            Column::make(__('Platform'), 'platform')
                ->sortable(),
            Column::make(__('Author'), 'user_name')
                ->sortable(),
            Column::make(__('Content'), 'content')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.social.comments.includes.row';
    }
}
