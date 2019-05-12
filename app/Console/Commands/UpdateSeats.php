<?php

namespace App\Console\Commands;

use App\Barkas\Bestelling;
use App\SeatBase;
use App\Multiplier;
use App\Party;
use Illuminate\Console\Command;

class UpdateSeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seats:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update seats';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parties = Party::all();

        $party_bestellingen = [];

        foreach ($parties as $party) {
            $bestellingen = Bestelling::whereHas('bon', function ($q) use($party) {
                $q->whereDate('Bon_Datum', '=', '2019-5-8')
                    ->whereHas('debiteur', function ($q) use($party) {
                        $q->where('Debiteur_Naam', 'like', '%'.$party->name.'%');
                    });
            })->with(['prijs' => function($q) {
                $q->select('Prijs_ID','Prijs_Naam');
            }])->get();
            $party_bestellingen[] = [$party, $bestellingen];
        }

        $totaal = 0;
        $party_zuips = [];
        foreach ($party_bestellingen as $party_bestelling) {
            echo '<b>'.$party_bestelling[0]->name.'</b>'.'<br>';
            $party = $party_bestelling[0];
            $party_totaal = 0;
            foreach ($party_bestelling[1] as $bestelling) {
                $multiplier = Multiplier::where('product', $bestelling->prijs->Prijs_Naam)
                    ->first();
                if(isset($multiplier)) {
                    $aantal = $bestelling->Bestelling_AantalS +
                        $bestelling->Bestelling_AantalSI +
                        $bestelling->Bestelling_AantalS225 +
                        $bestelling->Bestelling_AantalS50 +
                        $bestelling->Bestelling_AantalS80;
                    $party_totaal += $multiplier->value * $aantal;
                }
            }
            //TODO: SeatMod toepassen
            //TODO: min(0) max(party_totaal)
            $party_zuips[] = [$party, $party_totaal];
            $totaal += $party_totaal;
        }

        foreach ($party_zuips as $party_zuip) {
            $party = $party_zuip[0];
            if($totaal == 0) {
                $amount = 0;
            } else {
                $amount = round(750*$party_zuip[1]/$totaal,0,PHP_ROUND_HALF_DOWN);
            }
            $seatbase = new Seatbase;
            $seatbase->party_id = $party->id;
            $seatbase->seats = $amount;
            $seatbase->entry_added = Carbon::now();
            echo $seatbase->id;
            $seatbase->save();
            echo $seatbase->id;
            echo '<br>';
        }

    }
}
