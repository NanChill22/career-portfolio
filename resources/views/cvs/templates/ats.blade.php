<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $cv->title }} - {{ $user->name }}</title>
    <style>
        @page {
            size: a4 portrait;
            margin: 12mm 15mm 12mm 15mm;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 9.5pt;
            line-height: 1.45;
            color: #1a1a1a;
            background-color: #ffffff;
        }

        /* Header / Contact Info */
        .header {
            text-align: center;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1.5pt solid #222222;
        }

        .header h1 {
            font-size: 19pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #111111;
            margin-bottom: 4px;
        }

        .header .subtitle {
            font-size: 11pt;
            font-weight: 600;
            color: #333333;
            margin-bottom: 4px;
        }

        .header .contact-info {
            font-size: 9pt;
            color: #444444;
        }

        .header .contact-info span {
            margin: 0 4px;
        }

        /* Section Styling */
        .section {
            margin-bottom: 12px;
            page-break-inside: auto;
        }

        .section-title {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #111111;
            border-bottom: 1pt solid #444444;
            padding-bottom: 2px;
            margin-bottom: 7px;
        }

        /* Items / Entry */
        .entry {
            margin-bottom: 8px;
            page-break-inside: avoid;
        }

        .entry-header {
            width: 100%;
            margin-bottom: 2px;
        }

        .entry-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #111111;
            float: left;
            width: 70%;
        }

        .entry-date {
            font-size: 8.5pt;
            font-weight: bold;
            color: #444444;
            text-align: right;
            float: right;
            width: 30%;
        }

        .entry-subtitle {
            font-size: 9pt;
            font-style: italic;
            color: #333333;
            clear: both;
            margin-bottom: 3px;
        }

        .entry-description {
            font-size: 9pt;
            color: #2b2b2b;
            text-align: justify;
            line-height: 1.4;
            margin-top: 2px;
        }

        .clear {
            clear: both;
        }

        /* Skills Format */
        .skills-list {
            margin-top: 2px;
        }

        .skill-group {
            margin-bottom: 4px;
            font-size: 9pt;
        }

        .skill-category {
            font-weight: bold;
            color: #111111;
        }

        /* List Bullet points */
        ul.bullet-list {
            margin-left: 16px;
            margin-top: 2px;
        }

        ul.bullet-list li {
            margin-bottom: 2px;
            font-size: 9pt;
            line-height: 1.35;
        }

        .link-text {
            color: #111111;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    {{-- HEADER / CONTACT DETAILS --}}
    <div class="header">
        <h1>{{ $user->name }}</h1>
        <div class="subtitle">{{ $cv->title }}</div>
        <div class="contact-info">
            <span>Email: {{ $user->email }}</span>
        </div>
    </div>

    {{-- WORK EXPERIENCES --}}
    @if ($experiences->count())
        <div class="section">
            <div class="section-title">Work Experience</div>

            @foreach ($experiences as $exp)
                <div class="entry">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1px;">
                        <tr>
                            <td style="text-align: left; font-weight: bold; font-size: 9.5pt; color: #111;">
                                {{ $exp->position }}
                            </td>
                            <td style="text-align: right; font-weight: bold; font-size: 8.5pt; color: #444;">
                                {{ $exp->start_date ? $exp->start_date->format('M Y') : '' }} -
                                {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : 'Present') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-style: italic; font-size: 9pt; color: #333; padding-top: 1px;">
                                {{ $exp->company }}
                            </td>
                        </tr>
                    </table>

                    @if ($exp->description)
                        <div class="entry-description">
                            {!! nl2br(e($exp->description)) !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- EDUCATION --}}
    @if ($educations->count())
        <div class="section">
            <div class="section-title">Education</div>

            @foreach ($educations as $edu)
                <div class="entry">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1px;">
                        <tr>
                            <td style="text-align: left; font-weight: bold; font-size: 9.5pt; color: #111;">
                                {{ $edu->institution }}
                            </td>
                            <td style="text-align: right; font-weight: bold; font-size: 8.5pt; color: #444;">
                                {{ $edu->start_date ? $edu->start_date->format('M Y') : '' }} -
                                {{ $edu->is_current ? 'Present' : ($edu->end_date ? $edu->end_date->format('M Y') : 'Present') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-style: italic; font-size: 9pt; color: #333; padding-top: 1px;">
                                {{ $edu->degree }}{{ $edu->field_of_study ? ' in ' . $edu->field_of_study : '' }}
                            </td>
                        </tr>
                    </table>

                    @if ($edu->description)
                        <div class="entry-description">
                            {!! nl2br(e($edu->description)) !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- SKILLS --}}
    @if ($skills->count())
        <div class="section">
            <div class="section-title">Skills & Competencies</div>
            <div class="skills-list">
                @php
                    $groupedSkills = $skills->groupBy(function($item) {
                        return $item->category ?: 'General / Technical Skills';
                    });
                @endphp

                @foreach ($groupedSkills as $category => $categorySkills)
                    <div class="skill-group">
                        <span class="skill-category">{{ $category }}:</span>
                        <span>
                            {{ $categorySkills->pluck('name')->implode(', ') }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- PROJECTS --}}
    @if ($projects->count())
        <div class="section">
            <div class="section-title">Key Projects</div>

            @foreach ($projects as $proj)
                <div class="entry">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1px;">
                        <tr>
                            <td style="text-align: left; font-weight: bold; font-size: 9.5pt; color: #111;">
                                {{ $proj->title }}
                                @if ($proj->technologies)
                                    <span style="font-weight: normal; font-size: 8.5pt; color: #555;">
                                        | {{ $proj->technologies }}
                                    </span>
                                @endif
                            </td>
                            <td style="text-align: right; font-weight: bold; font-size: 8.5pt; color: #444;">
                                @if ($proj->start_date || $proj->end_date)
                                    {{ $proj->start_date ? $proj->start_date->format('M Y') : '' }}
                                    @if ($proj->start_date && $proj->end_date) - @endif
                                    {{ $proj->end_date ? $proj->end_date->format('M Y') : '' }}
                                @endif
                            </td>
                        </tr>
                        @if ($proj->project_url || $proj->repository_url)
                            <tr>
                                <td colspan="2" style="font-size: 8.5pt; color: #444; padding-top: 1px;">
                                    @if ($proj->project_url)
                                        <span>Demo: {{ $proj->project_url }}</span>
                                    @endif
                                    @if ($proj->project_url && $proj->repository_url) | @endif
                                    @if ($proj->repository_url)
                                        <span>Repo: {{ $proj->repository_url }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </table>

                    @if ($proj->description)
                        <div class="entry-description">
                            {!! nl2br(e($proj->description)) !!}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- CERTIFICATIONS --}}
    @if ($certifications->count())
        <div class="section">
            <div class="section-title">Certifications & Licenses</div>

            @foreach ($certifications as $cert)
                <div class="entry">
                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 1px;">
                        <tr>
                            <td style="text-align: left; font-weight: bold; font-size: 9.5pt; color: #111;">
                                {{ $cert->name }} - <span style="font-weight: normal; font-style: italic;">{{ $cert->issuer }}</span>
                            </td>
                            <td style="text-align: right; font-weight: bold; font-size: 8.5pt; color: #444;">
                                {{ $cert->issue_date ? $cert->issue_date->format('M Y') : '' }}
                                @if ($cert->expiration_date)
                                    - {{ $cert->expiration_date->format('M Y') }}
                                @endif
                            </td>
                        </tr>
                        @if ($cert->credential_id)
                            <tr>
                                <td colspan="2" style="font-size: 8.5pt; color: #555;">
                                    Credential ID: {{ $cert->credential_id }}
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            @endforeach
        </div>
    @endif

</body>
</html>
