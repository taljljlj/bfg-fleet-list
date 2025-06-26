<div class="card-ship-armaments card-box-container">
    <table>
        <thead>
        <tr>
            <th>Armament</th>
            <th>Speed/Range</th>
            <th colspan="2">Firepower</th>
        </tr>
        </thead>
        <tbody>
        @foreach($armaments as $armament)
            @if($armament->placement != 'Starboard')
                <tr class="firearc-{{ $armament->fire_arc_short }}">
                    <td>{{ ($armament->placement === 'Port' ? 'Pt|Sb' : $armament->placement) . ' ' . $armament->type }}</td>
                    @if($armament->pivot->range_speed)
                        <td>{{ $armament->pivot->range_speed }}cm</td>
                    @elseif($armament->pivot->misc)
                        <td>{{ $armament->pivot->misc }}</td>
                    @else
                        <td>N/A</td>
                    @endif
                    @if($armament->placement === 'Port')
                        <td>{{ $armament->pivot->firepower }}</td>
                        <td>{{ $armament->pivot->firepower }}</td>
                    @else
                        <td colspan="2">{{ $armament->pivot->firepower }}</td>
                    @endif
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
