@extends('layouts.main')

@section('content')
<style>
    .ai-interview-layout {
        min-height: 100vh;
        padding: 6rem 1rem 4rem;
        background: linear-gradient(180deg, #f9fafc 0%, #ffffff 60%);
        font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .ai-interview-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .ai-hero {
        text-align: center;
        margin-bottom: 2rem;
    }

    .ai-hero h1 {
        font-size: 2.5rem;
        color: #1f2933;
        margin-bottom: 0.5rem;
    }

    .ai-hero p {
        color: #5f6c7b;
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .ai-panels {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .panel {
        background: #fff;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        border: 1px solid #eef2f7;
    }

    .panel h2 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: #111827;
    }

    label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    select,
    textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        font-size: 1rem;
        background-color: #f9fafb;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    select:focus,
    textarea:focus {
        outline: none;
        border-color: #fb923c;
        box-shadow: 0 0 0 3px rgba(251, 146, 60, 0.25);
        background-color: #fff;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .controls {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 999px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #fb923c, #f97316);
        color: #fff;
        box-shadow: 0 10px 30px rgba(249, 115, 22, 0.35);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #e5e7eb;
        color: #111827;
    }

    .btn:active {
        transform: scale(0.98);
    }

    .question-number {
        font-size: 0.95rem;
        font-weight: 600;
        color: #fb923c;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .question-text {
        font-size: 1.35rem;
        font-weight: 600;
        color: #0f172a;
        margin: 0.75rem 0 1rem;
    }

    .ai-hint {
        background: #fff7ed;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #9a3412;
        margin-bottom: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .stat-card {
        border-radius: 1rem;
        padding: 1rem;
        text-align: center;
        background: #111827;
        color: #fff;
    }

    .stat-card.correct {
        background: #16a34a;
    }

    .stat-card.wrong {
        background: #dc2626;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
    }

    .progress-track {
        height: 8px;
        border-radius: 999px;
        background: #e5e7eb;
        margin-top: 1rem;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        width: 0%;
        background: linear-gradient(90deg, #fb923c, #f97316);
        transition: width 0.3s ease;
    }

    .summary-card ul {
        padding-left: 1rem;
        margin-top: 0.75rem;
        color: #374151;
        line-height: 1.5;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
        background: #eef2ff;
        color: #4338ca;
        margin-bottom: 0.75rem;
    }

    .hidden {
        display: none !important;
    }
</style>

<div class="ai-interview-layout">
    <div class="ai-interview-container">
        <div class="ai-hero">
            <p class="badge">MockMate AI Lab</p>
            <h1>AI-Powered Mock Interviews</h1>
            <p>Select your dream role, set the level, and practice with smart, adaptive questions.</p>
        </div>

        <div class="ai-panels">
            <section class="panel">
                <h2>Choose Interview Track</h2>
                <div>
                    <label for="roleSelect">Role</label>
                    <select id="roleSelect">
                        <option value="frontend">Frontend Engineer</option>
                        <option value="backend">Backend Engineer</option>
                        <option value="datascience">Data Scientist</option>
                        <option value="product">Product Manager</option>
                    </select>
                </div>
                <div style="margin-top:1rem;">
                    <label for="levelSelect">Level</label>
                    <select id="levelSelect">
                        <option value="junior">Junior</option>
                        <option value="mid">Mid-Level</option>
                        <option value="senior">Senior</option>
                    </select>
                </div>
                <div class="controls">
                    <button class="btn btn-primary" id="startInterview">Start Interview</button>
                    <button class="btn btn-outline" id="resetInterview">Reset</button>
                </div>
            </section>

            <section class="panel" id="questionPanel">
                <div class="question-number" id="questionNumber">Question 1</div>
                <h2 class="question-text" id="questionText">Select a track to generate the first AI question.</h2>
                <div class="ai-hint" id="aiHint">
                    Pick a role and level to let the AI build a tailored interview plan just for you.
                </div>
                <label for="answerInput">Your Answer</label>
                <textarea id="answerInput" placeholder="Type your answer here..."></textarea>
                <div class="controls">
                    <button class="btn btn-primary" id="submitAnswer">Submit Answer</button>
                    <button class="btn btn-outline" id="skipQuestion">Skip</button>
                </div>
            </section>
        </div>

        <section class="panel summary-card">
            <h2>Interview Summary & Insights</h2>
            <div class="stats-grid">
                <div class="stat-card">
                    <div>Total</div>
                    <div class="stat-value" id="totalQuestions">0</div>
                    <small>questions asked</small>
                </div>
                <div class="stat-card correct">
                    <div>Correct</div>
                    <div class="stat-value" id="correctAnswers">0</div>
                </div>
                <div class="stat-card wrong">
                    <div>Needs Work</div>
                    <div class="stat-value" id="wrongAnswers">0</div>
                </div>
            </div>
            <div class="progress-track">
                <div class="progress-bar" id="progressBar"></div>
            </div>
            <div id="summaryContent" style="margin-top:1.25rem; color:#374151;">
                Complete an interview round to unlock personalized feedback and improvement tips.
            </div>
        </section>
    </div>
</div>

<script>
    const questionBank = {
        frontend: {
            junior: [
                {
                    question: "Explain the CSS box model and why it matters for layout.",
                    keywords: ["content", "padding", "border", "margin"],
                    tip: "Revisit how the box model impacts spacing and layout calculations."
                },
                {
                    question: "How does Flexbox differ from CSS Grid? When would you choose each?",
                    keywords: ["one-dimensional", "two-dimensional", "layout", "flex"],
                    tip: "Highlight strengths of each system with practical scenarios."
                },
                {
                    question: "Describe how event bubbling works in the DOM.",
                    keywords: ["propagation", "capturing", "bubbling", "stop"],
                    tip: "Outline the propagation phases and how to interrupt them."
                },
                {
                    question: "What problem does React's virtual DOM solve?",
                    keywords: ["diffing", "re-render", "performance", "state"],
                    tip: "Connect the virtual DOM to rendering efficiency."
                },
                {
                    question: "How would you optimize images for the web?",
                    keywords: ["compression", "lazy", "responsive", "formats"],
                    tip: "Mention responsive images, compression, and loading strategies."
                }
            ],
            mid: [
                {
                    question: "Walk through how you would diagnose a layout bug that only appears in Safari.",
                    keywords: ["devtools", "browser", "prefix", "flexbox"],
                    tip: "Talk about browser differences, testing strategy, and polyfills."
                },
                {
                    question: "Describe how you structure a scalable component system.",
                    keywords: ["design system", "tokens", "reusable", "documentation"],
                    tip: "Explain naming, documentation, and shared tokens."
                },
                {
                    question: "What are render props and custom hooks? When would you use them?",
                    keywords: ["reuse", "logic", "React", "hooks"],
                    tip: "Compare both patterns with use cases."
                }
            ],
            senior: [
                {
                    question: "Outline a strategy for progressively migrating a legacy jQuery app to React.",
                    keywords: ["incremental", "dual", "bridge", "rewrite"],
                    tip: "Emphasize risk mitigation and phased rollouts."
                },
                {
                    question: "How do you measure and enforce performance budgets on a large SPA?",
                    keywords: ["LCP", "bundle", "monitoring", "budgets"],
                    tip: "Discuss metrics, tooling, and governance."
                },
                {
                    question: "Explain how you would architect micro frontends for a marketplace.",
                    keywords: ["isolation", "routing", "deployment", "integration"],
                    tip: "Touch on build independence and shared contracts."
                }
            ]
        },
        backend: {
            junior: [
                {
                    question: "What is the difference between authentication and authorization?",
                    keywords: ["identity", "access", "permissions", "login"],
                    tip: "Clarify authN vs authZ with examples."
                },
                {
                    question: "Explain RESTful principles in simple terms.",
                    keywords: ["stateless", "resources", "verbs", "representations"],
                    tip: "Mention HTTP verbs and resource modeling."
                }
            ],
            mid: [
                {
                    question: "How would you design rate limiting for a public API?",
                    keywords: ["throttle", "token bucket", "redis", "quota"],
                    tip: "Cover algorithms, storage, and penalty strategy."
                }
            ],
            senior: [
                {
                    question: "Describe your approach to evolving a monolith into microservices.",
                    keywords: ["decomposition", "boundaries", "data", "observability"],
                    tip: "Focus on slicing strategy and operational maturity."
                }
            ]
        },
        datascience: {
            junior: [
                {
                    question: "Why do we split data into training and test sets?",
                    keywords: ["generalization", "overfitting", "evaluation", "bias"],
                    tip: "Explain how separation protects against overfitting."
                }
            ],
            mid: [
                {
                    question: "Compare precision and recall in classification tasks.",
                    keywords: ["false positives", "false negatives", "sensitivity", "tradeoff"],
                    tip: "Use practical examples such as medical diagnosis."
                }
            ],
            senior: [
                {
                    question: "How do you productionize and monitor ML models?",
                    keywords: ["drift", "pipelines", "metrics", "retraining"],
                    tip: "Discuss deployment, monitoring, and retraining triggers."
                }
            ]
        },
        product: {
            junior: [
                {
                    question: "What makes a good product requirement document?",
                    keywords: ["outcomes", "users", "scope", "success"],
                    tip: "Emphasize clarity, success metrics, and user context."
                }
            ],
            mid: [
                {
                    question: "How do you prioritize roadmap items with conflicting stakeholders?",
                    keywords: ["framework", "RICE", "impact", "alignment"],
                    tip: "Show structured prioritization and communication."
                }
            ],
            senior: [
                {
                    question: "Walk me through scaling a product globally.",
                    keywords: ["localization", "regulation", "operations", "research"],
                    tip: "Highlight research, compliance, and phased rollout."
                }
            ]
        }
    };

    const state = {
        questions: [],
        currentIndex: 0,
        correct: 0,
        wrong: 0,
        activeRole: 'frontend',
        activeLevel: 'junior',
        history: []
    };

    const roleSelect = document.getElementById('roleSelect');
    const levelSelect = document.getElementById('levelSelect');
    const questionNumber = document.getElementById('questionNumber');
    const questionText = document.getElementById('questionText');
    const aiHint = document.getElementById('aiHint');
    const answerInput = document.getElementById('answerInput');
    const totalQuestionsEl = document.getElementById('totalQuestions');
    const correctAnswersEl = document.getElementById('correctAnswers');
    const wrongAnswersEl = document.getElementById('wrongAnswers');
    const progressBar = document.getElementById('progressBar');
    const summaryContent = document.getElementById('summaryContent');

    const startBtn = document.getElementById('startInterview');
    const resetBtn = document.getElementById('resetInterview');
    const submitBtn = document.getElementById('submitAnswer');
    const skipBtn = document.getElementById('skipQuestion');

    const getQuestionSet = (role, level) => {
        const bank = questionBank[role]?.[level] || [];
        return bank
            .map(item => ({ ...item }))
            .sort(() => Math.random() - 0.5)
            .slice(0, Math.min(bank.length, 5));
    };

    const updateStats = () => {
        totalQuestionsEl.textContent = state.questions.length;
        correctAnswersEl.textContent = state.correct;
        wrongAnswersEl.textContent = state.wrong;

        const totalAnswered = state.correct + state.wrong;
        const progress = state.questions.length
            ? (totalAnswered / state.questions.length) * 100
            : 0;
        progressBar.style.width = progress + '%';
    };

    const updateQuestionView = () => {
        if (!state.questions.length) {
            questionNumber.textContent = 'Question 0';
            questionText.textContent = 'Select a track to generate the first AI question.';
            aiHint.textContent = 'Pick a role and level to let the AI build a tailored interview plan just for you.';
            answerInput.value = '';
            return;
        }

        const current = state.questions[state.currentIndex];
        questionNumber.textContent = `Question ${state.currentIndex + 1} of ${state.questions.length}`;
        questionText.textContent = current.question;
        aiHint.textContent = `AI focus: ${current.tip}`;
        answerInput.value = '';
        answerInput.focus();
    };

    const evaluateAnswer = () => {
        if (!state.questions.length) {
            alert('Start an interview first.');
            return;
        }

        const response = answerInput.value.trim().toLowerCase();
        if (!response) {
            alert('Type your answer before submitting.');
            return;
        }

        const currentQuestion = state.questions[state.currentIndex];
        const keywords = currentQuestion.keywords;
        const matches = keywords.filter(word => response.includes(word));
        const threshold = Math.max(1, Math.ceil(keywords.length * 0.6));
        const isCorrect = matches.length >= threshold;

        if (isCorrect) {
            state.correct += 1;
        } else {
            state.wrong += 1;
        }

        state.history.push({ question: currentQuestion, correct: isCorrect });
        summaryContent.innerHTML = buildSummary(isCorrect, currentQuestion, matches.length, keywords.length);
        moveToNextQuestion();
    };

    const skipQuestion = () => {
        if (!state.questions.length) {
            alert('Start an interview first.');
            return;
        }

        state.wrong += 1;
        state.history.push({ question: state.questions[state.currentIndex], correct: false });
        summaryContent.innerHTML = `
            <p style="font-weight:600;color:#b91c1c;">Question skipped.</p>
            <p>Skipping counts as a missed opportunity. Try to attempt each question to build real interview stamina.</p>
        `;
        moveToNextQuestion();
    };

    const moveToNextQuestion = () => {
        updateStats();
        const isLast = state.currentIndex >= state.questions.length - 1;
        if (isLast) {
            summarizeInterview();
            return;
        }
        state.currentIndex += 1;
        updateQuestionView();
    };

    const summarizeInterview = () => {
        const total = state.questions.length;
        const scorePercent = total ? Math.round((state.correct / total) * 100) : 0;
        let tone = 'Keep practicing to improve consistency.';
        if (scorePercent >= 80) {
            tone = 'Outstanding work! You are interview ready.';
        } else if (scorePercent >= 60) {
            tone = 'Solid performance. Polish a few weak spots to stand out.';
        } else if (scorePercent >= 40) {
            tone = 'Decent effort. Focus on reinforcing fundamentals.';
        }

        const uniqueTips = new Set(
            state.history
                .filter(entry => !entry.correct)
                .map(entry => entry.question.tip)
        );
        const missedTips = Array.from(uniqueTips)
            .map(tip => `<li>${tip}</li>`)
            .join('');

        summaryContent.innerHTML = `
            <p style="font-size:1.1rem;font-weight:600;">Final Score: ${scorePercent}%</p>
            <p>${tone}</p>
            ${missedTips ? `<p>Suggested focus areas:</p><ul>${missedTips}</ul>` : '<p>Great coverage across all topics. Keep the momentum!</p>'}
        `;

        questionNumber.textContent = 'Interview complete';
        questionText.textContent = 'Reset or choose another track to keep practicing.';
        aiHint.textContent = 'Use your summary insights to decide what to rehearse next.';
    };

    const buildSummary = (isCorrect, question, matches, totalKeywords) => {
        if (isCorrect) {
            return `
                <p style="font-weight:600;color:#15803d;">Strong answer!</p>
                <p>You covered ${matches}/${totalKeywords} high-signal concepts for this question.</p>
            `;
        }

        return `
            <p style="font-weight:600;color:#b91c1c;">Partial answer detected.</p>
            <p>Touch on: <strong>${question.keywords.join(', ')}</strong></p>
            <p>Tip: ${question.tip}</p>
        `;
    };

    const resetInterview = () => {
        state.questions = [];
        state.currentIndex = 0;
        state.correct = 0;
        state.wrong = 0;
        state.history = [];
        updateStats();
        updateQuestionView();
        summaryContent.textContent = 'Complete an interview round to unlock personalized feedback and improvement tips.';
    };

    startBtn.addEventListener('click', () => {
        const role = roleSelect.value;
        const level = levelSelect.value;
        state.activeRole = role;
        state.activeLevel = level;
        const questionSet = getQuestionSet(role, level);

        if (!questionSet.length) {
            summaryContent.innerHTML = `
                <p style="color:#b91c1c;font-weight:600;">No data yet for this track.</p>
                <p>Try another role/level combination while we train more AI prompts.</p>
            `;
            return;
        }

        state.questions = questionSet;
        state.currentIndex = 0;
        state.correct = 0;
        state.wrong = 0;
        state.history = [];
        updateStats();
        updateQuestionView();
        summaryContent.innerHTML = `
            <p style="font-weight:600;">New interview started: ${role.replace(/^[a-z]/, c => c.toUpperCase())} - ${level}</p>
            <p>Answer thoughtfully. The AI will auto-score and share targeted advice.</p>
        `;
    });

    submitBtn.addEventListener('click', evaluateAnswer);
    skipBtn.addEventListener('click', skipQuestion);
    resetBtn.addEventListener('click', resetInterview);
</script>
@endsection

