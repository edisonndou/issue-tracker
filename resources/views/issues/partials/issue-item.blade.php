<div class="card mb-2 issue-card">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="mb-2">
                    <a href="{{ route('issues.show', $issue) }}" class="text-decoration-none">
                        {{ $issue->title }}
                    </a>
                </h6>
                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                    {{ Str::limit($issue->description, 100) }}
                </p>
                <div>
                    <span class="status-badge status-{{ $issue->status }}">
                        {{ ucfirst(str_replace('_', ' ', $issue->status)) }}
                    </span>
                    <span class="priority-{{ $issue->priority }} ms-2">
                        Priority: {{ ucfirst($issue->priority) }}
                    </span>
                    @if($issue->due_date)
                        <small class="text-muted ms-2">
                            Due: {{ $issue->due_date->format('M d, Y') }}
                        </small>
                    @endif
                </div>
                <div class="mt-2">
                    @foreach($issue->tags as $tag)
                        <span class="tag-badge" style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="col-md-2 text-end">
                <div class="mb-2">
                    @foreach($issue->assignees as $assignee)
                        <div class="assignee-avatar" title="{{ $assignee->name }}">
                            {{ $assignee->name[0] }}
                        </div>
                    @endforeach
                </div>
                <small class="text-muted">{{ $issue->comments->count() }} comments</small>
            </div>
        </div>
    </div>
</div>
