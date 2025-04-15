<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Product $product)
    {
        $this->middleware('role:buyer');
        
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->route('products.show', $comment->product)
            ->with('success', 'Comment deleted successfully.');
    }
} 