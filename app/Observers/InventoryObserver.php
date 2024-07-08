<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class InventoryObserver
{
    /**
     * Handle the Inventory "created" event.
     */
    public function created(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "updated" event.
     */
    public function updated(Inventory $inventory)
    {
        Log::info('Inventory updated: ' . $inventory->id);

        if ($inventory->stock < $inventory->minimum_stock) {
            Log::info('Stock is below minimum threshold for inventory: ' . $inventory->name);

            Notification::create([
                'title' => 'Stock Alert',
                'content' => "The stock for {$inventory->name} is below the minimum threshold.",
                'ingredient_id' => $inventory->id,
            ]);

            Log::info('Notification created for inventory: ' . $inventory->name);
        }
        elseif (Notification::where('ingredient_id', $inventory->id)->exists()) {
            Notification::where('ingredient_id', $inventory->id)->delete();
            Log::info('Notification deleted for inventory: ' . $inventory->name);
        }
    }

    /**
     * Handle the Inventory "deleted" event.
     */
    public function deleted(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "restored" event.
     */
    public function restored(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "force deleted" event.
     */
    public function forceDeleted(Inventory $inventory): void
    {
        //
    }

    /**
     * Handle the Inventory "retrieved" event.
     */
    public function retrieved(Inventory $inventory): void
    {
        if ($inventory->stock < $inventory->minimum_stock && !Notification::where('ingredient_id', $inventory->id)->exists()) {
            Log::info('Stock is below minimum threshold for inventory: ' . $inventory->name);

            Notification::create([
                'title' => 'Stock Alert',
                'content' => "The stock for {$inventory->name} is below the minimum threshold.",
                'ingredient_id' => $inventory->id,
            ]);

            Log::info('Notification created for inventory: ' . $inventory->name);
        }
    }
}
