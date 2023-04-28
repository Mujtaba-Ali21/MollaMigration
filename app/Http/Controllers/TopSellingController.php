<?php

namespace App\Http\Controllers;

use App\Models\Top_selling;

use App\Models\ProductPrice;
use Illuminate\Http\Request;

class TopSellingController extends Controller
{

    // Create

    public function create(Request $req)
    {
        $validated = $req->validate([
            "productName" => "required",
            "image" => "required|mimes:jpeg,png,jpg,gif|max:2048",
            "price" => "required",
        ]);

        // Get the file object from the image input field
        $image = $req->file("image");

        $top_selling = new Top_selling();
        $top_selling->image = $image->getClientOriginalName();
        $top_selling->name = $validated["productName"];
        $top_selling->price = $validated["price"];
        $top_selling->save();

        $productPrice = new ProductPrice();
        $productPrice->price = $validated["price"];
        $productPrice->top_selling_id = $top_selling->id;
        $productPrice->save();

        // Move the uploaded file to public directory
        $image->move(
            public_path("top_sellingImages"),
            $image->getClientOriginalName()
        );

        $req->session()->flash("success", "Product Created Successfully!");
        return redirect("/topSellingsTable");
    }

    // Read

    public function read()
    {
        $data = Top_selling::all();

        return view("tables/top_sellingsTable", ["data" => $data]);
    }

    // Update

    public function showUpdate($id)
{
    $data = Top_selling::find($id);

    $productPrice = $data->prices()->first();
    
    return view("tables/editProduct", ["product" => $data, "price" => $productPrice->price]);
}

    public function update(Request $req, $id)
    {
        $validated = $req->validate([
            "productName" => "required",
            "image" => "required|mimes:jpeg,png,jpg,gif|max:2048",
            "price" => "required",
        ]);

        // Get the file object from the image input field
        $image = $req->file("image");

        $top_selling = Top_selling::find($req->id);
        $top_selling->image = $image->getClientOriginalName();
        $top_selling->name = $validated["productName"];
        $top_selling->price = $validated["price"];
        $top_selling->save();

        $productPrice = $top_selling->prices()->first();
        $productPrice->price = $validated["price"];
        $productPrice->save();

        // Move the uploaded file to public directory
        $image->move(
            public_path("top_sellingImages"),
            $image->getClientOriginalName()
        );

        $req->session()->flash("success", "Product Updated Successfully!");
        return redirect("/topSellingsTable");
    }

    // Delete
    
    public function delete(Request $req, $id)
    {
        $top_selling = Top_selling::find($req->id);
        $top_selling->delete();
        session()->flash("success", "Product Deleted successfully!");
        return redirect("/topSellingsTable");
    }
}
