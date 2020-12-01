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
            Column::make(__('Ads Banner'), 'ads_banner')
                ->format(function(Ads $model) {
                    return $this->image($model->getBanner(), $model->name, ['class' => 'img-fluid rounded', 'style' => 'max-width: 220px;']);
                }),
            Column::make(__('Creator'), 'creator')
                ->format(function(Ads $model) {
                    return $this->html($model->getProfileHtml());
                }),
            Column::make(__('Number max'), 'number_max')
                ->searchable()
                ->sortable(),
            Column::make(__('Number min'), 'number_min')
                ->searchable()
                ->sortable(),
            Column::make(__('Incidence'), 'incidence')
                ->format(function(Ads $model) {
                    return $this->html(($model->incidence / 100) . '%');
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->format(function(Ads $model) {
                    return $this->html(view('backend.social.ads.includes.active', ['ads' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('PaymentStatus'), 'payment')
                ->format(function(Ads $model) {
                    return $this->html(view('backend.social.ads.includes.payment', ['ads' => $model]));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Started At'), 'started_at')
                ->format(function(Ads $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                        </div>',
                        $model->started_at->toDateString(),
                        $model->started_at->diffForHumans()
                    ));
                })
                ->searchable()
                ->sortable(),
            Column::make(__('Ended At'), 'ended_at')
                ->format(function(Ads $model) {
                    return $this->html(sprintf(
                        '<div style="position: inherit;">
                            <strong style="font-weight: 600; font-size: 16px; color: #597a96; display: inherit;">%s</strong>
                            <span style="font-size: 12px; font-weight: 400; color: #aab8c2;">%s</span>
                        </div>',
                        $model->ended_at->toDateString(),
                        $model->ended_at->diffForHumans()
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
