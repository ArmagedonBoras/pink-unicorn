<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Illuminate\Support\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class MemberTable extends DataTableComponent
{
    protected $model = Member::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityDisabled();
        $this->setColumnSelectStatus(false);
        $this->setFilterPillsStatus(false);
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setComponentWrapperAttributes(['id' => 'member-table']);
    }

    public function columns(): array
    {
        return [
            Column::make("Nr", "member_no")
                ->sortable(),
            Column::make('Namn', 'owner.name')
                ->sortable(),
            //Column::make('E-postadress', 'owner.email')
            //    ->hideif(true),
            Column::make('E-postadress')
              //  ->format(fn ($value, $row, Column $column) => Member::find($row->id)->email_link)
                ->html()
                ->sortable(),
            Column::make('(Mobil-) Telefon', 'customer.phone1')
                ->sortable(),
            Column::make('Alternativ telefon', 'customer.phone2')
                ->sortable(),
            Column::make('Senaste inloggning', 'last_login_at')
                ->sortable()
                ->format(fn ($value) => ($value == null) ? '' : Carbon::parse($value)->format('Y-m-d H:i')),
            Column::make('Utträde', 'resignation_at')
                ->sortable()
                ->format(fn ($value) => ($value == null) ? '' : Carbon::parse($value)->format('Y')),
        ];
    }
}
