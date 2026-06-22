@extends('layouts.app')

@section('title', $project->name)

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h2">{{ $project->name }}</h1>
                <p class="text-muted">{{ $project->description }}</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('projects.issues.create', $project) }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> New Issue
                </a>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-secondary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-2">
                                <small class="text-muted">Start Date</small>
                                <p class="mb-0 fw-bold">{{ $project->start_date?->format('M d, Y') ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Deadline</small>
                                <p class="mb-0 fw-bold">{{ $project->deadline?->format('M d, Y') ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Total Issues</small>
                                <p class="mb-0 fw-bold">{{ $issues->count() }}</p>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Open</small>
                                <p class="mb-0 fw-bold text-danger">{{ $issues->where('status', 'open')->count() }}</p>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">In Progress</small>
                                <p class="mb-0 fw-bold text-warning">{{ $issues->where('status', 'in_progress')->count() }}</p>
                            </div>
                            <div class="col-md-2">
                                <small class="text-muted">Closed</small>
                                <p class="mb-0 fw-bold text-success">{{ $issues->where('status', 'closed')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-3">Issues</h5>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select id="statusFilter" class="form-select form-select-sm">
                                    <option value="">All Status</option>
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="priorityFilter" class="form-select form-select-sm">
                                    <option value="">All Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="tagFilter" class="form-select form-select-sm">
                                    <option value="">All Tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="searchFilter" class="form-control form-control-sm" placeholder="Search issues...">
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="issuesContainer">
                        @if($issues->isEmpty())
                            <div class="text-center py-5">
                                <i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.5;"></i>
                                <p class="text-muted mt-2">No issues yet</p>
                            </div>
                        @else
                            <div id="issuesList">
                                @foreach($issues as $issue)
                                    @include('issues.partials.issue-item', ['issue' => $issue, 'project' => $project])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let debounceTimer;

        function loadIssues() {
            const params = {
                status: $('#statusFilter').val(),
                priority: $('#priorityFilter').val(),
                tag: $('#tagFilter').val(),
                search: $('#searchFilter').val(),
            };

            $.get('{{ route("projects.issues.index", $project) }}', params, function(response) {
                if (response.issues.length === 0) {
                    $('#issuesList').html('<div class="text-center py-5"><i class="bi bi-inbox" style="font-size: 3rem; opacity: 0.5;"></i><p class="text-muted mt-2">No issues found</p></div>');
                } else {
                    let html = '';
                    response.issues.forEach(issue => {
                        const statusClass = 'status-' + issue.status;
                        const priorityClass = 'priority-' + issue.priority;
                        const tagsHtml = issue.tags.map(tag => `<span class="tag-badge" style="background-color: ${tag.color}20; color: ${tag.color}">${tag.name}</span>`).join('');
                        const assigneesHtml = issue.assignees.map(user => `<div class="assignee-avatar" title="${user.name}">${user.name.charAt(0)}</div>`).join('');

                        html += `
                            <div class="card mb-2 issue-card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="mb-2"><a href="/issues/${issue.id}" class="text-decoration-none">${issue.title}</a></h6>
                                            <p class="text-muted mb-2" style="font-size: 0.9rem;">${issue.description ? issue.description.substring(0, 100) + '...' : ''}</p>
                                            <div>
                                                <span class="status-badge ${statusClass}">${issue.status.replace('_', ' ')}</span>
                                                <span class="priority-${issue.priority} ms-2">Priority: ${issue.priority}</span>
                                                ${issue.due_date ? '<small class="text-muted ms-2">Due: ' + issue.due_date + '</small>' : ''}
                                            </div>
                                            <div class="mt-2">${tagsHtml}</div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <div class="mb-2">${assigneesHtml}</div>
                                            <small class="text-muted">${issue.comments_count} comments</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#issuesList').html(html);
                }
            });
        }

        $('#statusFilter, #priorityFilter, #tagFilter').on('change', loadIssues);
        $('#searchFilter').on('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(loadIssues, 300);
        });
    </script>
@endsection
