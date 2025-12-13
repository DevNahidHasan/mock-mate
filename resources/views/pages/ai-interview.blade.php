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

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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

    .btn:active:not(:disabled) {
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
                <div class="question-number" id="questionNumber">Question 0</div>
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
    const state = {
        currentQuestion: null,
        currentIndex: 0,
        totalQuestions: 5,
        correct: 0,
        wrong: 0,
        activeRole: 'frontend',
        activeLevel: 'junior',
        history: [],
        isLoading: false
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

    // Get CSRF token for Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    const updateStats = () => {
        totalQuestionsEl.textContent = state.currentIndex;
        correctAnswersEl.textContent = state.correct;
        wrongAnswersEl.textContent = state.wrong;

        const progress = state.totalQuestions
            ? (state.currentIndex / state.totalQuestions) * 100
            : 0;
        progressBar.style.width = progress + '%';
    };

    const setLoading = (loading) => {
        state.isLoading = loading;
        startBtn.disabled = loading;
        submitBtn.disabled = loading;
        skipBtn.disabled = loading;
        
        if (loading) {
            submitBtn.textContent = 'Loading...';
        } else {
            submitBtn.textContent = 'Submit Answer';
        }
    };

    const generateQuestion = async () => {
        setLoading(true);
        
        try {
            const response = await fetch('/api/interview/generate-question', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    role: state.activeRole,
                    level: state.activeLevel
                })
            });

            const data = await response.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to generate question');
            }

            state.currentQuestion = data.question;
            state.currentIndex += 1;
            
            updateQuestionView();
            updateStats();
        } catch (error) {
            alert('Error generating question: ' + error.message);
            console.error(error);
        } finally {
            setLoading(false);
        }
    };

    const updateQuestionView = () => {
        if (!state.currentQuestion) {
            questionNumber.textContent = 'Question 0';
            questionText.textContent = 'Select a track to generate the first AI question.';
            aiHint.textContent = 'Pick a role and level to let the AI build a tailored interview plan just for you.';
            answerInput.value = '';
            return;
        }

        questionNumber.textContent = `Question ${state.currentIndex} of ${state.totalQuestions}`;
        questionText.textContent = state.currentQuestion;
        aiHint.textContent = `AI will evaluate your answer and provide personalized feedback.`;
        answerInput.value = '';
        answerInput.focus();
    };

    const evaluateAnswer = async () => {
        if (!state.currentQuestion) {
            alert('Start an interview first.');
            return;
        }

        const response = answerInput.value.trim();
        if (!response) {
            alert('Type your answer before submitting.');
            return;
        }

        setLoading(true);

        try {
            const apiResponse = await fetch('/api/interview/evaluate-answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    question: state.currentQuestion,
                    answer: response,
                    role: state.activeRole,
                    level: state.activeLevel
                })
            });

            const data = await apiResponse.json();

            if (!data.success) {
                throw new Error(data.error || 'Failed to evaluate answer');
            }

            const evaluation = data.evaluation;
            
            if (evaluation.isCorrect) {
                state.correct += 1;
            } else {
                state.wrong += 1;
            }

            state.history.push({
                question: state.currentQuestion,
                answer: response,
                evaluation: evaluation
            });

            displayEvaluation(evaluation);
            moveToNextQuestion();
        } catch (error) {
            alert('Error evaluating answer: ' + error.message);
            console.error(error);
            setLoading(false);
        }
    };

    const displayEvaluation = (evaluation) => {
        const scoreColor = evaluation.isCorrect ? '#15803d' : '#b91c1c';
        
        summaryContent.innerHTML = `
            <p style="font-weight:600;color:${scoreColor};">Score: ${evaluation.score}</p>
            <p><strong>Feedback:</strong> ${evaluation.feedback}</p>
            <p><strong>Tip:</strong> ${evaluation.tip}</p>
        `;
    };

    const skipQuestion = () => {
        if (!state.currentQuestion) {
            alert('Start an interview first.');
            return;
        }

        state.wrong += 1;
        state.history.push({
            question: state.currentQuestion,
            answer: 'Skipped',
            evaluation: { score: 'Skipped', isCorrect: false }
        });

        summaryContent.innerHTML = `
            <p style="font-weight:600;color:#b91c1c;">Question skipped.</p>
            <p>Skipping counts as a missed opportunity. Try to attempt each question to build real interview stamina.</p>
        `;
        
        moveToNextQuestion();
    };

    const moveToNextQuestion = () => {
        updateStats();
        
        const isLast = state.currentIndex >= state.totalQuestions;
        if (isLast) {
            summarizeInterview();
            return;
        }
        
        // Generate next question
        setTimeout(() => {
            generateQuestion();
        }, 1000);
    };

    const summarizeInterview = async () => {
        const total = state.currentIndex;
        const scorePercent = total ? Math.round((state.correct / total) * 100) : 0;
        let tone = 'Keep practicing to improve consistency.';
        
        if (scorePercent >= 80) {
            tone = 'Outstanding work! You are interview ready.';
        } else if (scorePercent >= 60) {
            tone = 'Solid performance. Polish a few weak spots to stand out.';
        } else if (scorePercent >= 40) {
            tone = 'Decent effort. Focus on reinforcing fundamentals.';
        }

        const historyList = state.history
            .map((item, i) => `
                <li style="margin-bottom:0.5rem;">
                    <strong>Q${i+1}:</strong> ${item.evaluation.score}
                </li>
            `)
            .join('');

        summaryContent.innerHTML = `
            <p style="font-size:1.1rem;font-weight:600;">Final Score: ${scorePercent}%</p>
            <p>${tone}</p>
            <p>Questions answered: ${total}</p>
            
            <div id="ai-feedback-section" style="margin-top:20px; padding:15px; background:#f3f4f6; border-radius:8px; border:1px solid #e5e7eb;">
                <p style="font-weight:600; color:#4b5563; display:flex; align-items:center; gap:10px;">
                    Generating comprehensive AI feedback...
                    <span style="display:inline-block; width:16px; height:16px; border:2px solid #ddd; border-top-color:#fb923c; border-radius:50%; animation: spin 1s linear infinite;"></span>
                </p>
                <style>@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }</style>
            </div>

            <ul style="margin-top:20px;">${historyList}</ul>
        `;

        questionNumber.textContent = 'Interview complete';
        questionText.textContent = 'Reset or choose another track to keep practicing.';
        aiHint.textContent = 'Use your summary insights to decide what to rehearse next.';
        state.currentQuestion = null;

        // Call API for detailed feedback
        try {
            const response = await fetch('/api/interview/generate-feedback', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    history: state.history,
                    role: state.activeRole,
                    level: state.activeLevel
                })
            });

            const data = await response.json();
            
            if (data.success) {
                // Formatting markdown-style bold and newlines
                let htmlFeedback = data.feedback
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\n/g, '<br>');

                document.getElementById('ai-feedback-section').innerHTML = `
                    <h3 style="font-size:1.1rem; color:#1f2933; margin-bottom:10px; border-bottom:1px solid #ddd; padding-bottom:5px;">AI Performance Analysis</h3>
                    <div style="font-size:0.95rem; line-height:1.6; color:#374151;">${htmlFeedback}</div>
                `;
            } else {
                document.getElementById('ai-feedback-section').innerHTML = `<p style="color:#b91c1c;">Could not generate detailed feedback. (${data.error || 'Unknown error'})</p>`;
            }
        } catch (error) {
            console.error(error);
            document.getElementById('ai-feedback-section').innerHTML = `<p style="color:#b91c1c;">Error retrieving feedback. Please check your connection.</p>`;
        }
    };

    const resetInterview = () => {
        state.currentQuestion = null;
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
        state.currentIndex = 0;
        state.correct = 0;
        state.wrong = 0;
        state.history = [];
        
        updateStats();
        summaryContent.innerHTML = `
            <p style="font-weight:600;">New AI interview started: ${role.replace(/^[a-z]/, c => c.toUpperCase())} - ${level}</p>
            <p>Answer thoughtfully. The AI will evaluate and share targeted advice.</p>
        `;
        
        generateQuestion();
    });

    submitBtn.addEventListener('click', evaluateAnswer);
    skipBtn.addEventListener('click', skipQuestion);
    resetBtn.addEventListener('click', resetInterview);
</script>
@endsection
