<?php

namespace App\Console\Commands;

use App\Motion;
use App\Result;
use Illuminate\Console\Command;

class TallyVotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'votes:tally';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tally the votes for any motion who has finished voting but has not had its votes tallied yet';

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
        $motions = Motion::where('time_of_vote', '<', \DB::raw('NOW()'))->doesnthave('results')->get();
        
        foreach ($motions as $motion) {
            $votes = $motion->votes;
            
            $tally = [];
            foreach($votes as $vote) {
                if (isset($tally[$vote->vote_value])) {
                    $tally[$vote->vote_value] += $vote->party->getSeatsAtTime($motion->time_of_vote);
                }
                else {
                    $tally[$vote->vote_value] = $vote->party->getSeatsAtTime($motion->time_of_vote);
                }
            }
            
            foreach($tally as $value => $seats) {
                $result = new Result;
                $result->motion_id = $motion->id;
                $result->vote_value = $value;
                $result->seats = $seats;
                $result->save();
            }
        }
    }
}
