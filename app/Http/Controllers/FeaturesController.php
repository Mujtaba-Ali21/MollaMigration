<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Feature;
use App\Models\FeaturesPrice;

class FeaturesController extends Controller
{

    // Create

    public function create(Request $req)
    {
        $validated = $req->validate([
            "featureText" => "required",
            "image" => "required|mimes:jpeg,png,jpg,gif|max:2048",
            "price" => "required",
        ]);

        // Get the file object from the image input field
        $image = $req->file("image");

        $feature = new Feature();
        $feature->image = $image->getClientOriginalName();
        $feature->name = $validated["featureText"];
        $feature->price = $validated["price"];
        $feature->save();

        // Create FeaturesPrice record
        $featuresPrice = new FeaturesPrice();
        $featuresPrice->price = $validated["price"];
        $featuresPrice->feature_id = $feature->id;
        $featuresPrice->save();

        // Move the uploaded file to public directory
        $image->move(
            public_path("featureImages"),
            $image->getClientOriginalName()
        );

        $req->session()->flash("success", "Feature Created Successfully!");
        return redirect("/featuresTable");
    }

    // Read

    public function read()
    {
        $data = Feature::all();

        return view("tables/featuresTable", ["data" => $data]);
    }

    // Update

    public function showUpdate($id)
    {
        $feature = Feature::find($id);
        $featuresPrice = $feature->prices()->first();

        return view("tables/editFeature", ["feature" => $feature, "price" => $featuresPrice->price]);
    }

    public function update(Request $req, $id)
    {
        $validated = $req->validate([
            "featureText" => "required",
            "image" => "required|mimes:jpeg,png,jpg,gif|max:2048",
            "price" => "required",
        ]);

        // Get the file object from the image input field
        $image = $req->file("image");

        $feature = Feature::find($id);
        $feature->image = $image->getClientOriginalName();
        $feature->name = $validated["featureText"];
        $feature->price = $validated["price"];
        $feature->save();

        // Update FeaturesPrice record
        $featuresPrice = $feature->prices()->first();
        $featuresPrice->price = $validated["price"];
        $featuresPrice->save();

        // Move the uploaded file to public directory
        $image->move(
            public_path("featureImages"),
            $image->getClientOriginalName()
        );

        $req->session()->flash("success", "Feature Updated Successfully!");
        return redirect("/featuresTable");
    }

    // Delete

   public function delete(Request $request, $id)
   {
       $feature = Feature::find($id);
       $feature->delete();

       $request->session()->flash('success', 'Feature Deleted successfully!');
       return redirect('/featuresTable');
   }
}

