<div class="card-ship-stats">
    <div class="stat-box card-box-container">
        <div class="stat-name">HP</div>
        <div class="stat-value">{{ $ship->hitpoints }}</div>
    </div>
    <div class="stat-box card-box-container">
        <div class="stat-name">Speed</div>
        <div class="stat-value">{{ $ship->pivot->speed ?? $ship->speed }}cm</div>
    </div>
    <div class="stat-box card-box-container">
        <div class="stat-name">Turns</div>
        <div class="stat-value">{{ $ship->pivot->turns ?? $ship->turns }}°</div>
    </div>
    <div class="stat-box card-box-container">
        <div class="stat-name">Shields</div>
        <div class="stat-value">{{ $ship->pivot->shields ?? $ship->shields }}</div>
    </div>
    <div class="stat-box card-box-container">
        <div class="stat-name">Armour</div>
        <div class="stat-value">{{ $ship->pivot->armour_short ??  $ship->armour_short }}</div>
    </div>
    <div class="stat-box card-box-container">
        <div class="stat-name">Turrets</div>
        <div class="stat-value">{{ $ship->pivot->turrets ?? $ship->turrets }}</div>
    </div>
</div>
