<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InterviewController extends Controller
{
    /**
     * Generate an AI interview question based on role and level
     */
    public function generateQuestion(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'level' => 'required|string',
        ]);

        $role = $request->input('role');
        $level = $request->input('level');

        // Map role to readable format
        $roleMap = [
            'frontend' => 'Frontend Engineer',
            'backend' => 'Backend Engineer',
            'datascience' => 'Data Scientist',
            'product' => 'Product Manager',
        ];

        $roleName = $roleMap[$role] ?? $role;

        // Create prompt for Gemini
        $prompt = "You are an expert technical interviewer. Generate ONE interview question for a {$level} level {$roleName} position. The question should be appropriate for the experience level and test practical knowledge. Return ONLY the question text, nothing else.";

        try {
            $response = $this->callGeminiAPI($prompt);
            
            return response()->json([
                'success' => true,
                'question' => $response,
            ]);
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Evaluate user's answer using AI
     */
    public function evaluateAnswer(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'role' => 'required|string',
            'level' => 'required|string',
        ]);

        $question = $request->input('question');
        $answer = $request->input('answer');
        $role = $request->input('role');
        $level = $request->input('level');

        // Create evaluation prompt
        $prompt = "You are an expert technical interviewer evaluating a {$level} level candidate's answer.

Question: {$question}

Candidate's Answer: {$answer}

Evaluate this answer and provide:
1. A score (Excellent/Good/Fair/Poor)
2. Brief feedback (2-3 sentences max)
3. One specific improvement tip

Format your response as:
Score: [score]
Feedback: [feedback]
Tip: [tip]";

        try {
            $response = $this->callGeminiAPI($prompt);
            
            // Parse the response
            $evaluation = $this->parseEvaluation($response);
            
            return response()->json([
                'success' => true,
                'evaluation' => $evaluation,
            ]);
        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Generate final interview feedback based on full history
     */
    public function generateFeedback(Request $request)
    {
        $request->validate([
            'history' => 'required|array',
            'role' => 'required|string',
            'level' => 'required|string',
        ]);

        $history = $request->input('history');
        $role = $request->input('role');
        $level = $request->input('level');

        // Construct the conversation history for the prompt
        $conversationText = "";
        foreach ($history as $index => $item) {
            $num = $index + 1;
            $conversationText .= "Q{$num}: {$item['question']}\nA{$num}: {$item['answer']}\nEvaluation: {$item['evaluation']['score']}\n\n";
        }

        $prompt = "You are an expert technical interviewer who just finished interviewing a {$level} level {$role} candidate.
        
Here is the transcript involves {$count} questions:
{$conversationText}

Based on this session, provide a comprehensive summary in the following structure (keep it professional but encouraging):
1. **Strengths**: What did the candidate do well? (Bullet points)
2. **Areas for Improvement**: What specific technical concepts or soft skills need work? (Bullet points)
3. **Final Verdict**: A 2-sentence summary of their readiness for this role.

Return ONLY the formatting text.";
        
        try {
            $response = $this->callGeminiAPI($prompt);
            
            return response()->json([
                'success' => true,
                'feedback' => $response,
            ]);
        } catch (\Exception $e) {
             return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Call Google Gemini API
     */
    private function callGeminiAPI($prompt)
    {
        $apiKey = env('GEMINI_API_KEY');
        
        if (!$apiKey) {
            throw new \Exception('GEMINI_API_KEY not configured');
        }

        // Switch to gemini-2.5-flash-lite as requested by user (likely better quota)
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}";

        $response = Http::withoutVerifying()->timeout(30)->post($url, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 500,
            ],
            'safetySettings' => [
                [
                    'category' => 'HARM_CATEGORY_HARASSMENT',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category' => 'HARM_CATEGORY_HATE_SPEECH',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                    'threshold' => 'BLOCK_NONE'
                ],
                [
                    'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                    'threshold' => 'BLOCK_NONE'
                ]
            ]
        ]);

        if (!$response->successful()) {
            $errorBody = $response->json();
            $errorMessage = $response->body();
            
            // Check for rate limit error
            if (isset($errorBody['error']['code']) && $errorBody['error']['code'] == 429) {
                throw new \Exception('API rate limit exceeded. Please wait 30 seconds and try again.');
            }
            
            throw new \Exception('API request failed: ' . $errorMessage);
        }

        $data = $response->json();
        
        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            $errorMsg = 'Invalid API response format';
            if (isset($data['candidates'][0]['finishReason'])) {
                $errorMsg .= '. Finish Reason: ' . $data['candidates'][0]['finishReason'];
            }
            throw new \Exception($errorMsg);
        }

        return trim($data['candidates'][0]['content']['parts'][0]['text']);
    }

    /**
     * Parse AI evaluation response
     */
    private function parseEvaluation($response)
    {
        // Default values
        $score = 'Fair';
        $feedback = $response;
        $tip = 'Keep practicing to improve your interview skills.';

        // Try to parse structured response
        if (preg_match('/Score:\s*(.+?)(?:\n|$)/i', $response, $scoreMatch)) {
            $score = trim($scoreMatch[1]);
        }

        if (preg_match('/Feedback:\s*(.+?)(?=Tip:|$)/is', $response, $feedbackMatch)) {
            $feedback = trim($feedbackMatch[1]);
        }

        if (preg_match('/Tip:\s*(.+?)$/is', $response, $tipMatch)) {
            $tip = trim($tipMatch[1]);
        }

        // Determine if answer is correct based on score
        $isCorrect = in_array(strtolower($score), ['excellent', 'good']);

        return [
            'score' => $score,
            'feedback' => $feedback,
            'tip' => $tip,
            'isCorrect' => $isCorrect,
        ];
    }
}
