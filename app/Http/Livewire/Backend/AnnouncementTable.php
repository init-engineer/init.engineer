<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Announcement\Http\Controllers\Backend\AnnouncementController;
use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class AnnouncementTable.
 */
class AnnouncementTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     *
     * The initial field to be sorting by.
     */
    public $sortField = 'message';

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
    public function mount($status = 'enabled'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        if ($this->status === 'deleted') {
            return Announcement::onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return Announcement::where('enabled', false);
        }

        return Announcement::where('enabled', true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Message'), 'message')
                ->format(function (Announcement $model) {
                    return view('backend.announcement.includes.message', ['announcement' => $model]);
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Area'), 'area')
                ->format(function (Announcement $model) {
                    return view('backend.announcement.includes.area', ['announcement' => $model]);
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Enabled Status'), 'enabled')
                ->format(function (Announcement $model) {
                    return $this->html(view('backend.announcement.includes.status', ['announcement' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Starts At'), 'starts_at')
                ->format(function (Announcement $model) {
                    if ($model->starts_at) {
                        return $this->html(sprintf(
                            '<div style="position: inherit;">
                                <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                                <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                            </div>',
                            $model->starts_at->toDateString(),
                            $model->starts_at->diffForHumans(),
                        ));
                    }

                    return '';
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Ends At'), 'ends_at')
                ->format(function (Announcement $model) {
                    if ($model->ends_at) {
                        return $this->html(sprintf(
                            '<div style="position: inherit;">
                                <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                                <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                            </div>',
                            $model->ends_at->toDateString(),
                            $model->ends_at->diffForHumans()
                        ));
                    }

                    return '';
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Announcement $model) {
                    return view('backend.announcement.includes.actions', ['announcement' => $model]);
                }),
        ];
    }
}
