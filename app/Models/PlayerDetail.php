<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $player_id
 * @property int $market_value
 * @property string $market_value_currency
 * @property Player $player
 */
class PlayerDetail extends BaseModel
{
    protected $fillable = [
        'player_id',
        'market_value',
        'market_value_currency',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function setPlayer(Player $player): self
    {
        $this->player()->associate($player);
        return $this;
    }

    public function setMarketValue(?int $marketValue): self
    {
        $this->market_value = $marketValue;
        return $this;
    }

    public function setMarketValueCurrency(?string $marketValueCurrency): self
    {
        $this->market_value_currency = $marketValueCurrency;
        return $this;
    }
}
