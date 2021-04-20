<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Cards;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialCardsTable.
 */
class SocialCardsTable extends TableComponent
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
            return Cards::onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return Cards::where('active', false);
        }

        return Cards::where('active', true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('ID'), 'id')
                ->format(function (Cards $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">#%s</span>
                        </div>',
                        $model->id,
                        base_convert($model->id, 10, 36),
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Author'), 'model.name')
                ->format(function (Cards $model) {
                    return $this->html(sprintf(
                        '<a href="%s" class="d-flex text-muted">
                            <img src="%s" class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="48" height="48">

                            <div class="pl-2 pt-1 mb-0 w-100">
                                <div class="d-flex justify-content-between">
                                    <strong class="text-gray-dark">%s</strong>
                                </div>
                                <span class="d-block">%s</span>
                            </div>
                        </a>',
                        route('admin.auth.user.show', ['user' => $model->model]),
                        $model->model->avatar,
                        $model->model->name,
                        $model->model->email,
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Picture'), 'picture')
                ->format(function (Cards $model) {
                    return $this->html(sprintf(
                        '<img src="%s" width="128" height="72" class="img-fluid rounded" style="max-width: 128px; max-height: 72px; object-fit: cover;" alt="%s">',
                        $model->getPicture(),
                        $model->content,
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Content'), 'content')
                ->format(function (Cards $model) {
                    return $this->html(sprintf(
                        '<p style="max-width: 320px;">%s</p>',
                        Str::limit($model->content, 191, '...'),
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Active Status'), 'active')
                ->format(function (Cards $model) {
                    return $this->html(view('backend.social.cards.includes.active', ['cards' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Blockade Status'), 'blockade')
                ->format(function (Cards $model) {
                    return $this->html(view('backend.social.cards.includes.blockade', ['cards' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Created At'), 'created_at')
                ->format(function (Cards $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                        </div>',
                        $model->created_at->toDateString(),
                        $model->created_at->diffForHumans(),
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Cards $model) {
                    return view('backend.social.cards.includes.actions', ['cards' => $model]);
                }),
        ];
    }
}
