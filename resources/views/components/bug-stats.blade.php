@props([
    'armor',
    'engine',
    'speed',
    'boost',
    'showValues' => false,
])

<x-stat-meter label="Armor" :value="$armor" :min="80" :max="150" :display="$showValues ? $armor : null" />
<x-stat-meter label="Engine" :value="$engine" :min="5200" :max="5700" :display="$showValues ? $engine : null" />
<x-stat-meter label="Top speed" :value="$speed" :min="55" :max="60" :display="$showValues ? $speed.' m/s' : null" />
<x-stat-meter label="Boost" :value="$boost" :min="3400" :max="3800" :display="$showValues ? $boost : null" />
