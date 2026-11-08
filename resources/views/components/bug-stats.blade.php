@props([
    'bug',
    'showValues' => false,
])

<x-stat-meter label="Armor" :value="$bug->armor" :min="80" :max="150" :display="$showValues ? $bug->armor : null" />
<x-stat-meter label="Engine" :value="$bug->engine" :min="5200" :max="5700" :display="$showValues ? $bug->engine : null" />
<x-stat-meter label="Top speed" :value="$bug->topSpeed" :min="55" :max="60" :display="$showValues ? $bug->topSpeed.' m/s' : null" />
<x-stat-meter label="Boost" :value="$bug->boost" :min="3400" :max="3800" :display="$showValues ? $bug->boost : null" />
