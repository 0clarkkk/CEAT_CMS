<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

$items = \App\Models\ResearchCenter::where(function ($q) {
    $q->whereNull('published_at')->orWhere('published_at', '<=', now());
})->orderByRaw('COALESCE(published_at, created_at) DESC')->get(['name', 'id', 'published_at', 'is_featured', 'deleted_at']);

echo "All published research items:\n";
foreach ($items as $item) {
    echo "- {$item->name} (ID: {$item->id}) | Published: {$item->published_at} | Featured: {$item->is_featured} | Deleted: {$item->deleted_at}\n";
}

echo "\n\ntest4 and test6 specifically:\n";
$test = \App\Models\ResearchCenter::whereIn('name', ['test4', 'test6'])->get(['name', 'id', 'published_at', 'is_featured', 'deleted_at']);
foreach ($test as $item) {
    echo "- {$item->name}: published_at={$item->published_at}, is_featured={$item->is_featured}, deleted_at={$item->deleted_at}\n";
}
