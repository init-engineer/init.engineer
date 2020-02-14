<?php

namespace App\Http\Controllers\Frontend\Leaderboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Leaderboard\ReadLeaderboardRequest;

/**
 * Class LeaderboardController.
 */
class LeaderboardController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param ReadLeaderboardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show2019YuuChien(ReadLeaderboardRequest $request)
    {
        return view('frontend.leaderboard.2019.yuu-chien');
    }

    /**
     * Display the specified resource.
     *
     * @param ReadLeaderboardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show2019FizzyElt(ReadLeaderboardRequest $request)
    {
        return view('frontend.leaderboard.2019.fizzy-elt');
    }

    /**
     * Display the specified resource.
     *
     * @param ReadLeaderboardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function show2019DongGuaLemon(ReadLeaderboardRequest $request)
    {
        return view('frontend.leaderboard.2019.dong-gua-lemon');
    }
}
