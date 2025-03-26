<?php

$radius = 80;
// TODO backend:
// round up % value to integer
// HSL(..., 50%, 60%)

$colorList = ["#cc7766", "#99cc66", "#66ccaa", "#66aacc", "#8866cc"];
$progressList = [
    [
        "description" => "Books read",
        "achieved" => 1,
        "goal" => 5,
        "prct" => 20,
    ],
    [
        "description" => "Pages read",
        "achieved" => 90,
        "goal" => 100,
        "prct" => 90,
    ],
    [
        "description" => "Daily challenges completed",
        "achieved" => 15,
        "goal" => 30,
        "prct" => 50,
    ],
    [
        "description" => "Minutes spent reading",
        "achieved" => 53,
        "goal" => 200,
        "prct" => 26,
    ],
];
?>

<!-- 
if the member is registered for an event -> display the progress bar
else
1) if an event is in progress, set up a button for him to participate
2) otherwise display a text "No event currently"
-->

<h3 class="section-title">My progress</h3>
<div class="progress-bar-container">
    @foreach ($progressList as $i => $progress)
    <div class="progress-container" style="--clr:{{$colorList[$i]}};--num:{{ $progress['prct'] }};--radius:{{$radius}}">
        <div class="outer">
            <div class="inner">
                <div class="progress">
                    <h2 id="number-{{$i}}">{{ $progress["prct"] }}</h2>
                    <p>{{ $progress["achieved"] }} / {{ $progress["goal"] }} </p>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="{{$radius*2}}" height="{{$radius*2}}">
            <!-- 
                <defs>
                    <linearGradient id="GradientColor">
                        <stop offset="0%" stop-color="#DA22FF" />
                        <stop offset="100%" stop-color="#9733EE" />
                    </linearGradient>
                </defs> 
                 -->
            <circle cx="{{$radius}}" cy="{{$radius}}" r="{{$radius - 10}}" stroke-linecap="round" />
        </svg>
        <div class="description">
            {{ $progress["description"] }}
        </div>
    </div>
    @endforeach
</div>

<x-dashboard.member.book-add-read />

<button class="button">Show the content of challenge</button>