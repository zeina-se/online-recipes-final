<?php
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request, $recipeId)
    {
        $userId = $request->user()->id;
        $content = $request->input('content');

        $comment = Comment::create([
            'recipe_id' => $recipeId,
            'user_id' => $userId,
            'content' => $content,
        ]);

        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ]);
    }

    public function deleteComment(Request $request, $commentId)
    {
        $userId = $request->user()->id;

        $comment = Comment::where('id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found or unauthorized.',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully.',
        ]);
    }
}