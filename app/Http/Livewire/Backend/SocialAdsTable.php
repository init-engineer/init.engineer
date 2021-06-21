<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Ads;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class SocialAdsTable.
 */
class SocialAdsTable extends DataTableComponent
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
            $query = Ads::onlyTrashed();
        } else if ($this->status === 'deactivated') {
            $query = Ads::where('active', false);
        } else {
            $query = Ads::where('active', true);
        }

        return $query
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term))
            ->when($this->getFilter('type'), fn ($query, $type) => $query->where('type', $type))
            ->when($this->getFilter('active'), fn ($query, $active) => $query->where('active', $active === 'yes'));
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'type' => Filter::make(__('Type'))
                ->select([
                    '' => 'Any',
                    Ads::TYPE_ALL => __('Draw All'),
                    Ads::TYPE_BANNER => __('Draw Banner'),
                    Ads::TYPE_CONTENT => __('Draw Content'),
                ]),
            'active' => Filter::make(__('Active'))
                ->select([
                    '' => __('Any'),
                    'yes' => __('Yes'),
                    'no' => __('No'),
                ]),
            'render' => Filter::make(__('Render'))
                ->select([
                    '' => __('Any'),
                    'yes' => __('Rainbow'),
                    'no' => __('Grayscale'),
                ]),
            'payment' => Filter::make(__('Payment Status'))
                ->select([
                    '' => __('Any'),
                    'yes' => __('Yes'),
                    'no' => __('No'),
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'), 'type')
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->sortable(),
            Column::make(__('Probability'), 'probability')
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->sortable(),
            Column::make(__('Render'), 'render')
                ->sortable(),
            Column::make(__('Payment Status'), 'payment')
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
        return 'backend.social.ads.includes.row';
    }
}
