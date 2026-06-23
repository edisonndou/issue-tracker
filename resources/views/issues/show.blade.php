@extends('layouts.app')

@section('title', $issue->title)

@section('content')

    {{-- Issues Show --}}
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2">{{ $issue->title }}</h1>
                    <p class="text-muted">
                        <a href="{{ route('projects.show', $project) }}" class="text-decoration-none">{{ $project->name }}</a>
                    </p>
                </div>
                <div>
                    <a href="{{ route('issues.edit', $issue) }}" class="btn btn-outline-primary btn-sm mb-1">
                        <i class="bi bi-pencil"></i> <span class="d-none d-md-inline">Edit</span>
                    </a>
                    <form action="{{ route('issues.destroy', $issue) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this issue?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm mb-1">
                            <i class="bi bi-trash"></i> <span class="d-none d-md-inline">Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Description</h5>
                        <p>{{ $issue->description ?: 'No description provided' }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Comments</h5>
                    </div>
                    <div class="card-body">
                        <div class="comments-section mb-3" id="commentsList">
                            @forelse($comments as $comment)
                                <div class="comment">
                                    <div class="comment-header">{{ $comment->author_name }}</div>
                                    <div class="comment-time">{{ $comment->created_at->diffForHumans() }}</div>
                                    <div class="comment-body">{{ $comment->body }}</div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-4">No comments yet</p>
                            @endforelse
                        </div>

                        <form id="commentForm" action="{{ route('comments.store', $issue) }}" method="POST"
                            onsubmit="addComment(event)">
                            @csrf
                            <div class="mb-3">
                                <label for="author_name" class="form-label">Your Name</label>
                                <input type="text" name="author_name" id="author_name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Comment</label>
                                <textarea name="body" id="body" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-chat-dots"></i> Add Comment
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0">Status & Priority</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Status</small>
                            <span class="status-badge status-{{ $issue->status }}">
                                {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block mb-2">Priority</small>
                            <span class="priority-{{ $issue->priority }} fw-bold">
                                {{ ucfirst($issue->priority) }}
                            </span>
                        </div>
                        <div>
                            <small class="text-muted d-block mb-2">Due Date</small>
                            <p class="mb-0">{{ $issue->due_date?->format('M d, Y') ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Tags</h6>
                        <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="modal"
                            data-bs-target="#addTagModal">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body" id="tagsList">
                        @forelse($issue->tags as $tag)
                            <div class="tag-badge d-inline-block mb-2"
                                style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                                {{ $tag->name }}
                                <button type="button" class="btn-close btn-sm ms-1"
                                    onclick="detachTag({{ $tag->id }})" style="font-size: 0.75rem;"></button>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No tags</p>
                        @endforelse
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Assigned To</h6>
                        <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            <i class="bi bi-plus-circle"></i>
                        </button>
                    </div>
                    <div class="card-body" id="assigneesList">
                        @forelse($issue->assignees as $user)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>{{ $user->name }}</span>
                                <button type="button" class="btn btn-link btn-sm p-0 text-danger"
                                    onclick="detachUser({{ $user->id }})">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No assignees</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <select id="tagSelect" class="form-select">
                        <option value="">Select a tag</option>
                        @foreach ($tags as $tag)
                            @if (!$issue->tags->contains($tag->id))
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="attachTag()">Add Tag</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign To</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <select id="userSelect" class="form-select">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            @if (!$issue->assignees->contains($user->id))
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="attachUser()">Assign</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- AJAX --}}
@section('scripts')
    <script>
        function attachTag() {
            const tagId = $('#tagSelect').val();
            if (!tagId) return;

            $.post('{{ route('issues.attachTag', [$project, $issue]) }}', {
                tag_id: tagId
            }, function(response) {
                $('#tagSelect').val('');
                $('#addTagModal').modal('hide');
                loadTags();
            });
        }

        function detachTag(tagId) {
            $.post('{{ route('issues.detachTag', [$project, $issue]) }}', {
                tag_id: tagId
            }, function() {
                loadTags();
            });
        }

        function attachUser() {
            const userId = $('#userSelect').val();
            if (!userId) return;

            $.post('{{ route('issues.attachUser', [$project, $issue]) }}', {
                user_id: userId
            }, function() {
                $('#userSelect').val('');
                $('#addUserModal').modal('hide');
                loadAssignees();
            });
        }

        function detachUser(userId) {
            $.post('{{ route('issues.detachUser', [$project, $issue]) }}', {
                user_id: userId
            }, function() {
                loadAssignees();
            });
        }

        function loadTags() {
            location.reload();
        }

        function loadAssignees() {
            location.reload();
        }

        function addComment(event) {
            event.preventDefault();
            const form = $('#commentForm');
            const action = form.attr('action');
            const data = {
                author_name: form.find('input[name="author_name"]').val(),
                body: form.find('textarea[name="body"]').val(),
            };

            $.ajax({
                url: action,
                method: 'POST',
                data: data,
                dataType: 'json',
                headers: {
                    Accept: 'application/json',
                },
                success(response) {
                    const comment = response.comment;
                    const html = `
                        <div class="comment">
                            <div class="comment-header">${comment.author_name}</div>
                            <div class="comment-time">just now</div>
                            <div class="comment-body">${comment.body}</div>
                        </div>
                    `;
                    $('#commentsList').prepend(html);
                    form[0].reset();
                },
                error(xhr) {
                    console.error('Comment submission failed', xhr.responseJSON || xhr.responseText);
                }
            });
        }
    </script>
@endsection
