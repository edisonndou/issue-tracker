<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Issue Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .hero-container {
            width: 100%;
            max-width: 1100px;
            text-align: center;
            color: white;
        }

        .hero-container h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-container p.hero-text {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .btn-lg-custom {
            padding: 0.85rem 2.5rem;
            font-size: 1.05rem;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom {
            background: white;
            color: #0d6efd;
        }

        .btn-primary-custom:hover {
            background: #f8f9fa;
            color: #0d6efd;
            transform: translateY(-3px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.25);
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid white;
        }

        .btn-secondary-custom:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .feature {
            text-align: center;
            padding: 1rem;
        }

        .feature-icon {
            font-size: 2.7rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }

        .feature h3 {
            color: #0d6efd;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .feature p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }

        @media (max-width: 768px) {
            .hero-container h1 {
                font-size: 2.5rem;
            }

            .hero-container p.hero-text {
                font-size: 1rem;
            }

            .features {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="hero-container">
            <h1>
                <i class="bi bi-check2-square" style="margin-right: 0.5rem;"></i>
                Issue Tracker
            </h1>

            <p class="hero-text">Manage projects, track issues, collaborate with your team, and stay organized in one
                place.</p>

            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn-lg-custom btn-primary-custom">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn-lg-custom btn-secondary-custom">
                    <i class="bi bi-person-plus"></i>
                    Register
                </a>
            </div>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-folder"></i></div>
                    <h3>Projects</h3>
                    <p>Organize work into projects and keep everything structured in one place.</p>
                </div>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-list-check"></i></div>
                    <h3>Issues</h3>
                    <p>Create, track, and manage issues with statuses, priorities, and deadlines.</p>
                </div>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-tags"></i></div>
                    <h3>Tags</h3>
                    <p>Group and categorize issues using custom tags for easier filtering.</p>
                </div>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-chat-dots"></i></div>
                    <h3>Comments</h3>
                    <p>Collaborate with your team through issue discussions and updates.</p>
                </div>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-person-check"></i></div>
                    <h3>Assignments</h3>
                    <p>Assign tasks to team members and improve accountability across the project.</p>
                </div>

                <div class="feature">
                    <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                    <h3>Fast Actions</h3>
                    <p>Perform actions quickly with smooth interactions and responsive updates.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
