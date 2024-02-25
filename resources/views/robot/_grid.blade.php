<div class="flex flex-row flex-row-reverse">
    @for ($i = $xMax; $i >= $xMin ; $i--)
    <div class="flex flex-col">
        @for ($j = $yMax; $j >= $yMin; $j--)
        @if ($i == $xLocation && $j == $yLocation)
        <div class="m-2 p-4 bg-red-400">{{ $i }} {{ $j }}</div>
        @elseif (isset($pathHistory) && in_array([$i, $j], $pathHistory))
        <div class="m-2 p-4 bg-green-400">{{ $i }} {{ $j }}</div>
        @else
        <div class="m-2 p-4 bg-indigo-400">{{ $i }} {{ $j }}</div>
        @endif
        @endfor
    </div>
    @endfor
</div>
