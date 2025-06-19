@php
$xp = Auth::user()->xp;
$level = Auth::user()->level;
$min = 2;
$max = 300;

while ($level-- != 0) {
    $min *= 1.15;
    $max *= 1.25;
}
    $xp -= $min;
    $max -= $min;

@endphp
<progress id="level" value="{{ $xp }}" max={{ $max }}> 32% </progress>

