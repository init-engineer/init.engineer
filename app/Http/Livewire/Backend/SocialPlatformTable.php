<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Social\Models\Platform;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class SocialPlatformTable.
 */
class SocialPlatformTable extends DataTableComponent
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
            $query = Platform::onlyTrashed();
        } else if ($this->status === 'deactivated') {
            $query = Platform::where('active', false);
        } else {
            $query = Platform::where('active', true);
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
            'type' => Filter::make('Type')
                ->select([
                    '' => 'Any',
                    Platform::TYPE_LOCAL => 'Local',
                    Platform::TYPE_DISCORD => 'Discord',
                    Platform::TYPE_FACEBOOK => 'Facebook',
                    Platform::TYPE_PLURK => 'Plurk',
                    Platform::TYPE_TELEGRAM => 'Telegram',
                    Platform::TYPE_TUMBLR => 'Tumblr',
                    Platform::TYPE_TWITTER => 'Twitter',
                ]),
            'action' => Filter::make('Action')
                ->select([
                    '' => 'Any',
                    Platform::ACTION_INACTION => 'Inaction',
                    Platform::ACTION_PUBLISH => 'Publish',
                    Platform::ACTION_NOTIFICATION => 'Notification',
                ]),
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
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
            Column::make(__('Action'), 'action')
                ->sortable(),
            Column::make(__('Active'), 'active')
                ->sortable(),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.social.platform.includes.row';
    }
}
