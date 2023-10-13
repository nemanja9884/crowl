<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\AnswerDetail;
use App\Models\Sentence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SentencesImport implements ToModel, WithHeadingRow
{
    public int $languageId;

    public function __construct($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
//        dd($row);
        if ($row['sentence']) {
            $sentence = Sentence::create([
                'sentence' => str_replace(['<s> ', ' </s>'], ['', ''], $row['sentence']),
                'language_id' => $this->languageId,
                'word_reliability' => $row['gdex_score'],
                'source_toknum' => $row['source_toknum'],
                'source_id' => $row['source_id']
            ]);

            if($row['problematic']) {
                $this->insertAnswer($sentence->id, $row);
            }
        }
    }

    public function insertAnswer($sentenceId, $row)
    {
        $answer = Answer::create([
            'language_id' => $this->languageId,
            'sentence_id' => $sentenceId,
            'user_id' => 7,
            'positive_answer' => $row['problematic'] == 'y' ? 0 : 1,
            'negative_answer' => $row['problematic'] == 'n' ? 0 : 1,
        ]);



        if (isset($row['offensive']) && $row['offensive'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'offensive');
        }

        if (isset($row['vulgar']) && $row['vulgar'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'vulgar');
        }

        if (isset($row['sensitive_content']) && $row['sensitive_content'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'sensitiveContent');
        }

        if (isset($row['spelling_problem']) && $row['spelling_problem'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'spellingProblem');
        }

        if (isset($row['spellinggrammar_problems']) && $row['spellinggrammar_problems'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'spelling and/or grammar problems');
        }

        if (isset($row['wrong_grammar']) && $row['wrong_grammar'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'wrongGrammar');
        }

        if (isset($row['lack_of_contextincomprehensible']) && $row['lack_of_contextincomprehensible'] == 'x') {
            $this->insertReason($sentenceId, $answer->id, 'lack of context and/or incomprehensible');
        }
    }

    public function insertReason($sentenceId, $answerId, $reason)
    {
        AnswerDetail::create([
            'sentence_id' => $sentenceId,
            'language_id' => $this->languageId,
            'answer_id' => $answerId,
            'reason' => $reason
        ]);
    }
}
