<?php

namespace App\Http\Livewire;

use App\Models\Car;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Automile\AutomileJournal;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class JournalTable extends DataTableComponent
{
    protected $model = AutomileJournal::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchStatus(false);
        $this->setFiltersVisibilityDisabled();
        $this->setColumnSelectStatus(false);
        $this->setFilterPillsStatus(false);
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setComponentWrapperAttributes(['id' => 'journal-table']);
    }

    public function builder(): Builder
    {
        return AutomileJournal::query()->whereDate('start_at', '>', Carbon::now()->subYears(2));
    }

    public function bookingSelected($id, $value)
    {
        $journal = AutomileJournal::Find($id);

        if ($value == -1) {
            $journal->deprecated = true;
            $journal->booking_id = null;
        } else {
            $journal->booking_id = $value;
        }
        $journal->save();
    }

    public function bookingDisconnect($id)
    {
        $journal = AutomileJournal::Find($id);
        $journal->booking_id = null;
        $journal->deprecated = false;
        $journal->save();
    }

    public function bookingRematch($id)
    {
        $journal = AutomileJournal::find($id);
        $journal->matchBooking();
        $journal->save();
    }

    public function mount()
    {
        $this->setFilter('start', Carbon::now()->subMonths(4)->format('Y-m-d'));
        $this->setFilter('slut', Carbon::now()->format('Y-m-d'));
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("bilID", "car_id")
                ->hideIf(true),
            Column::make('Bokningsid', 'booking_id')
                ->hideIf(true),
            Column::make('Avskriven', 'deprecated')
                ->hideIf(true),
            Column::make('Bil', 'car.name')
                ->sortable()
                ->secondaryHeaderFilter('bil'),
            Column::make("Startplats", "start_place")
                ->sortable(),
            Column::make("Slutplats", "end_place")
                ->sortable(),
                Column::make('Distans', 'distance'),
            Column::make("Start", "start_at")
                ->sortable()
                ->secondaryHeaderFilter('start'),
            Column::make("Slut", "end_at")
                ->sortable()
                ->secondaryHeaderFilter('slut'),
            Column::make('Bokning', 'booking_id')
                ->format(
                    function ($value, $row, Column $column) {
                        if ($row->deprecated) {
                            return view('automilejournals.booking-select', ['row' => $row, 'options' => []])->render();
                        }
                        $bookings = Booking::where('car_id', $row->car_id)
                        ->where('status', Booking::STATUS_BOOKED)
                            ->whereBetween(DB::raw('?'), [
                                DB::raw('DATE_ADD(start_at, INTERVAL -2 DAY)'),
                                DB::raw('DATE_ADD(end_at, INTERVAL 2 DAY)')
                            ])
                            ->whereBetween(DB::raw('?'), [
                                DB::raw('DATE_ADD(start_at, INTERVAL -2 DAY)'),
                                DB::raw('DATE_ADD(end_at, INTERVAL 2 DAY)')
                            ])
                            ->orderBy('start_at')
                            ->setBindings([$row->car_id, Booking::STATUS_BOOKED, $row->start_at, $row->end_at])
                            ->get();
                        $options = ['' => 'Välj bokning', -1 => 'Markera Bortskriven'];
                        foreach ($bookings as $booking) {
                            $options[$booking->id] = $booking->start_at . " - " . $booking->end_at . " (" . $booking->owner->id . ": " . $booking->owner->name . ")";
                        }
                        return view('automilejournals.booking-select', ['row' => $row, 'options' => $options])->render();
                    }
                )
                ->html()
                ->secondaryHeaderFilter('bokning'),
            LinkColumn::make('Medlem', 'booking.owner.id')
                ->title(function ($row) {
                    return ($row->booking_id == null) ? 'n/a' : $row->booking->owner->id . " " . $row->booking->owner->name;
                })
                ->location(fn ($row) => ($row->booking == null) ? '#' : route('members.show', $row->booking->owner)),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Bil')
                ->options([
                        '' => 'Alla',
                    ] + Car::Where('statistics', true)->pluck('name', 'id')->toArray())
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('car_id', $value);
                }),
            DateFilter::make('Start')
                ->config([
                    'min' => '2018-01-01',
                    'max' => (new Carbon())->format('Y-m-d'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('start_at', '>=', (new Carbon($value))->format('Y-m-d'));
                }),
            DateFilter::make('Slut')
                ->config([
                    'min' => '2018-01-01',
                    'max' => (new Carbon())->format('Y-m-d'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('start_at', '<=', (new Carbon($value))->addDay()->format('Y-m-d'));
                }),
            SelectFilter::make('Bokning')
                ->options([
                    '' => 'Alla',
                    '-1' => 'Bortskrivna',
                    '0' => 'Okopplade',
                    '1' => 'Kopplade',
                ])
                ->filter(function (Builder $builder, string $value) {
                    switch($value) {
                        case '-1' :
                            $builder->where('automile_journals.deprecated', true);
                            break;
                        case '0':
                            $builder->where('automile_journals.deprecated', false)->whereNull('booking_id');
                            break;
                        case '1':
                            $builder->where('automile_journals.deprecated', false)->whereNotNull('booking_id');
                            break;
                        default:
                    }
                }),
        ];
    }
}
