<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    //----------
    public function index(Project $project)
    {
        $query = $project->issues();
        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('priority')) {
            $query->where('priority', request('priority'));
        }

        if (request()->filled('tag')) {
            $tagId = request('tag');

            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        if (request('search')) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        $issues = $query->with('tags', 'assignees', 'comments')->latest()->get();
        $tags = Tag::all();

        return response()->json(['issues' => $issues->map(fn($i) => [
            'id' => $i->id,
            'title' => $i->title,
            'description' => $i->description,
            'status' => $i->status,
            'priority' => $i->priority,
            'due_date' => $i->due_date?->format('Y-m-d'),
            'tags' => $i->tags,
            'assignees' => $i->assignees,
            'comments_count' => $i->comments->count(),
        ])]);
    }
    //----------
    public function create(Project $project)
    {
        $tags = Tag::all();
        $users = \App\Models\User::all();
        return view('issues.create', compact('project', 'tags', 'users'));
    }
    //----------
    public function store(StoreIssueRequest $request, Project $project)
    {
        $issue = $project->issues()->create($request->validated());

        if ($request->tags) {
            $issue->tags()->sync($request->tags);
        }

        if ($request->assignees) {
            $issue->assignees()->sync($request->assignees);
        }

        return redirect()->route('issues.show', $issue)->with('success', 'Issue created!');
    }
    //----------
    public function show(Project $project, Issue $issue)
    {
        $project = $issue->project;
        $issue->load('tags', 'assignees', 'comments');
        $tags = Tag::all();
        $users = \App\Models\User::all();
        $comments = $issue->comments()->latest()->paginate(5);

        return view('issues.show', compact('project', 'issue', 'tags', 'users', 'comments'));
    }
    //----------
    public function edit(Project $project, Issue $issue)
    {
        $tags = Tag::all();
        $users = \App\Models\User::all();
        return view('issues.edit', compact('project', 'issue', 'tags', 'users'));
    }
    //----------
    public function update(UpdateIssueRequest $request, Project $project, Issue $issue)
    {
        $issue->update($request->validated());

        if ($request->tags) {
            $issue->tags()->sync($request->tags);
        }

        if ($request->assignees) {
            $issue->assignees()->sync($request->assignees);
        }

        return redirect()->route('issues.show', $issue)->with('success', 'Issue updated!');
    }
    //----------
    public function destroy(Project $project, Issue $issue)
    {
        $issue->delete();
        return redirect()->route('projects.show', $project)->with('success', 'Issue deleted!');
    }
    //----------
    // AJAX endpoints
    public function attachTag(Project $project, Issue $issue, Request $request)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        $issue->tags()->syncWithoutDetaching([$request->tag_id]);

        return response()->json([
            'tag' => Tag::find($request->tag_id),
            'message' => 'Tag attached!',
        ]);
    }
    //----------
    public function detachTag(Project $project, Issue $issue, Request $request)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        $issue->tags()->detach($request->tag_id);

        return response()->json(['message' => 'Tag detached!']);
    }
    //----------
    public function attachUser(Project $project, Issue $issue, Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $issue->assignees()->syncWithoutDetaching([$request->user_id]);

        return response()->json([
            'user' => \App\Models\User::find($request->user_id),
            'message' => 'User assigned!',
        ]);
    }
    //----------
    public function detachUser(Project $project, Issue $issue, Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $issue->assignees()->detach($request->user_id);

        return response()->json(['message' => 'User unassigned!']);
    }
    //----------
    public function loadComments(Project $project, Issue $issue)
    {
        $comments = $issue->comments()->latest()->paginate(5);
        return response()->json(['comments' => $comments->items(), 'total' => $comments->total()]);
    }
    //----------
    public function storeComment(Request $request, Project $project, Issue $issue)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $comment = $issue->comments()->create($request->validated());

        return response()->json([
            'comment' => $comment,
            'message' => 'Comment added!',
        ]);
    }
    //----------
    public function deleteComment(Project $project, Issue $issue, int $commentId)
    {
        $comment = $issue->comments()->findOrFail($commentId);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted!']);
    }
}

