<?php

namespace App\Policies;

use Laravelista\Comments\Comment;

class CommentPolicy
{
    public function create($user) : bool
    {
        return $user->can('create comment');
    }

    public function delete($user, Comment $comment) : bool
    {
        if ($user->can('delete comment')) {
            return $user->getKey() === $comment->commenter_id;
        }

        return false;
    }

    public function update($user, Comment $comment) : bool
    {
        if ($user->can('edit comment')) {
            return $user->getKey() === $comment->commenter_id;
        }

        return false;
    }

    public function reply($user, Comment $comment) : bool
    {
        return $user->can('replyto comment');
    }
}
