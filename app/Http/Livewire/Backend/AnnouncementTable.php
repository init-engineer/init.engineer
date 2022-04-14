<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class AnnouncementTable.
 */
class AnnouncementTable extends DataTableComponent
{
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
            $query = Announcement::onlyTrashed();
        } else if ($this->status === 'deactivated') {
            $query = Announcement::where('enabled', false);
        } else {
            $query = Announcement::where('enabled', true);
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('area', $type))
            ->when($this->getFilter('enabled'), fn ($query, $active) => $query->where('enabled', $active === true));
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'type' => Filter::make(__('Area'))
                ->select([
                    '' => __('Any'),
                    Announcement::AREA_BACKEND => __('Backend'),
                    Announcement::AREA_FRONTEND => __('Frontend'),
                ]),
            'enabled' => Filter::make(__('Enabled Status'))
                ->select([
                    '' => __('Any'),
                    false => __('Enabled'),
                    true => __('Inenabled'),
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Message'), 'message')
                ->sortable(),
            Column::make(__('Area'), 'area')
                ->sortable(),
            Column::make(__('Enabled Status'), 'enabled')
                ->sortable(),
            Column::make(__('Starts At'), 'starts_at')
                ->sortable(),
            Column::make(__('Ends At'), 'ends_at')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.announcement.includes.row';
    }
}
