<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Cards;
use App\Domains\Social\Models\Comments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialCommentsTable.
 */
class SocialCommentsTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     *
     * The initial field to be sorting by.
     */
    public $sortField = 'id';

    /**
     * @var string
     *
     * The initial direction to sort.
     */
    public $sortDirection = 'desc';

    /**
     * @var integer
     *
     * Amount of items to show per page.
     */
    public $perPage = 10;

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

            return $query;
        }

        if ($this->status === 'deactivated') {
            $query = Comments::where('active', false);
            if (isset($this->cards)) {
                $query->where('card_id', $this->cards->id);
            }

            return $query;
        }

        $query = Comments::where('active', true);
        if (isset($this->cards)) {
            $query->where('card_id', $this->cards->id);
        }

        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->searchable()
                ->sortable(),
            Column::make(__('Platform'), 'platform')
                ->format(function (Comments $model) {
                    return $this->html(sprintf(
                        '<div class="d-flex text-muted">
                            <img src="%s" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

                            <div class="pl-2 pt-1 mb-0 w-100">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-gray-dark">%s</strong>
                                </div>
                                <span class="d-block">%s</span>
                            </div>
                        </div>',
                        asset('img/icon/' . $model->platform->type . '.png'),
                        $model->platform->name,
                        ucfirst($model->platform->type),
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Author'), 'user_name')
                ->format(function (Comments $model) {
                    return $this->html(sprintf(
                        '<div class="d-flex text-muted">
                            <img src="%s" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

                            <div class="pl-2 pt-1 mb-0 w-100">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-gray-dark">%s</strong>
                                </div>
                                <span class="d-block">%s</span>
                            </div>
                        </div>',
                        $model->user_avatar,
                        $model->user_name,
                        $model->user_id,
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Content'), 'content')
                ->format(function (Comments $model) {
                    return $this->html(sprintf(
                        '<p style="max-width: 320px;" data-toggle="tooltip" data-placement="bottom" title="%s">%s</p>',
                        $model->content,
                        Str::limit($model->content, 72, '...'),
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Comments $model) {
                    return view('backend.social.comments.includes.actions', ['comments' => $model]);
                }),
        ];
    }
}
