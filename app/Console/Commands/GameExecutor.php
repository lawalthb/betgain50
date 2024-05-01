<?php

namespace App\Console\Commands;

use App\Events\CrashPoint;
use App\Events\RemainTimeChanged;
use App\Events\WinnerNumberGenerated;
use App\Models\Bets;
use App\Models\Games;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start executing the game';

    private $time = 5;
    private $point = 1;
    private $crashgame;
    private $chartData =  [0.01];
    private $label = [1, 1];
    private $user_id;
    private $current_game_id;
    private $new_game_id;
    private $record;


    /**
     * Execute the console command.
     */

    public function _contruct($crashgame,)
    {
        $this->crashgame = $crashgame;
        $this->crashgame  = mt_rand(100, 10000) / 100;
    }

    public function handle()
    {


        while (true) {

            broadcast(new CrashPoint(number_format($this->point, 2),  $this->current_game_id));
            $this->point += 0.09;
            sleep(0.5);
            // Fetch data from your database or any other source

            $this->chartData[] = $this->point;
            // Generate labels (e.g., sequential numbers)
            $this->label = range(1, count($this->chartData));

            if ($this->point >= $this->crashgame) {
                //save Games record

                broadcast(new RemainTimeChanged($this->time));

                sleep(7);
                $this->point = 1;
                $this->crashgame =  mt_rand(100, 1000) / 100;
                $this->chartData =  [0.01];
                $this->label = [1, 1];
                // save new game to db
                $this->record = Games::create([
                    'status' => 'active',
                    'multiplier' => $this->crashgame,
                    'start_at' => Carbon::now(),

                ]);
                //update previous game to crashed
                $arrayColours = ['warning', 'danger', 'info', 'success'];

                $randomColorIndex = array_rand($arrayColours);
                $randomColor = $arrayColours[$randomColorIndex];
                $record = Games::orderBy('id', 'desc')->skip(1)->take(1)->first();
                if ($record) {
                    $record->status = 'crashed';
                    $record->color = $randomColor;
                    $record->crashed_at = Carbon::now();
                    $record->save();
                } else {
                    return 'No second-to-last record found.';
                }
                // check and update status if user wins
                Log::info($record->id);

                $usersThatBet =  Bets::where('game_id', $record->id)->get();

                // Log::info($usersThatBet);
                if ($usersThatBet) {
                    Log::info('current id: ' . $this->record->id);
                    Log::info('crash game id: ' . $this->crashgame);
                    $game_id2Check = $this->record->multiplier;
                    foreach ($usersThatBet as $bet) {
                        if ($bet->bet <= $game_id2Check) {
                            $win_amount = $bet->bet * $bet->stake_amount;
                            $tru = Bets::where('game_id', $record->id)->where('user_id', $bet->user_id)->update([
                                'status' => "win",
                                'win_amount' => $win_amount,
                            ]);
                            User::where('id', $bet->user_id)->update([
                                'wallet_balance' => \DB::raw("wallet_balance + $win_amount"),
                            ]);
                            Log::info('true ' . $tru);
                        } elseif ($bet->bet > $game_id2Check) {
                            $tru =  Bets::where('game_id', $record->id)->where('user_id', $bet->user_id)->update([
                                'status' => "lose"
                            ]);
                            Log::info('false ' . $tru . " user id:");
                        } else {
                            $tru = Bets::where('game_id', $record->id)->where('user_id', $bet->user_id)->update([
                                'status' => "none"
                            ]);
                            Log::info('Unknown ' . $tru);
                        }
                    }
                }
                $this->current_game_id = $record->id + 1;
                broadcast(new CrashPoint(number_format($this->point, 2), $this->current_game_id));
            }
        }
    }
}
