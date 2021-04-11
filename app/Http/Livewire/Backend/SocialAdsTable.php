<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Ads;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class SocialAdsTable.
 */
class SocialAdsTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped',
    ];

    /**
     * @param  string  $status
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
            return Ads::onlyTrashed();
        }

        if ($this->status === 'deactivated') {
            return Ads::where('active', false);
        }

        return Ads::where('active', true);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Probability'), 'probability')
                ->format(function(Ads $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 24px; color: #597a96; display: inherit;">%s</strong>
                        </div>',
                        ($model->probability / 100) . '%'
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->format(function(Ads $model) {
                    return $this->html(view('backend.social.ads.includes.active', ['ads' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Payment Status'), 'payment')
                ->format(function(Ads $model) {
                    return $this->html(view('backend.social.ads.includes.payment', ['ads' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Starts At'), 'starts_at')
                ->format(function(Ads $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                        </div>',
                        $model->starts_at->toDateString(),
                        $model->starts_at->diffForHumans()
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Ends At'), 'ends_at')
                ->format(function(Ads $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                        </div>',
                        $model->ends_at->toDateString(),
                        $model->ends_at->diffForHumans()
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Actions'))
                ->format(function (Ads $model) {
                    return view('backend.social.ads.includes.actions', ['ads' => $model]);
                }),
        ];
    }
}
