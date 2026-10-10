<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model{

    protected $table = 'fasilitas';
    protected $fillable = ['name', 'location', 'capacity', 'description', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query){
        return $query->where('is_active', true);
    }

    public function store(FacilityRequest $request){
        Facility::create($request->validated());
        return redirect()->route('admin.facilities.index');
    }

    public function update(FacilityRequest $request, Facility $facility){
        $facility->update($request->validated());
        return redirect()->route('admin.facilities.index');
    }

    public function toggle(Facility $facility){
        $facility->update(['is_active' => ! $facility->is_active]);
        return back();
    }
}
